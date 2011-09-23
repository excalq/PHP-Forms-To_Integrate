<?php

	/**
	 * FormField
	 *
	 * Abstract class from which all other field classes are derived.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	abstract class FormField implements FormControl {
		/**
		 * Currently this is worthless but I would like this to be able to get the theming function just fine.
		 * @var <type> 
		 */
		protected $themeing = '';

		/**
		 * Array of callbacks used to validate field data. May be either a string
		 * denoting a function or an array of array(instance, string method) to use
		 * a class instance method.
		 **/
		protected $validators;

		/**
		 * If true, this field uses multiple field widgets.
		 * @see widgets.php
		 **/
		protected $label;			// The field's text label.
		protected $value;			// Store's the field's value. Set during validation.
		protected $attributes;	// Associative array of key/value pairs representing HTML attributes of the field.
		protected $errors = array();		// Array storing errors generated during field validation.
		protected $imported;		// Storage of the "cleaned" field value.
		protected $machineName;			// Stores the machine name
		protected $strValidator = 'Not valid';
		public	  $multi_field	= false;
		protected $valid		= false;			// Stores the result of field validation to prevents double-validation.
		protected $help_text	= "";// Help text for the field. This is printed out with the field HTML.

		/**
		 * @author Andric Villanueva
		 * @param string $label the field's label
		 * @param array $validators callbacks used to validate field data
		 * @param array $attributes an assoc of key/value pairs representing HTML attributes
		 * @return null
		 **/
		public function __construct($label, array $attributes = array(), array $validators = array()) {
			$this->label = (string)$label;
			$this->attributes = $attributes;
			$this->validators = $validators;
			$this->machineName = $this->getMachineName();
		}

		/**
		 * Assigns help text to the field.
		 * @author Andric Villanueva
		 * @param string $text the help text
		 * @return null
		 **/
		public function setHelpText($text) {
			$this->help_text = $text;
		}

		/**
		 * Sets the value of the field.
		 * @author Andric Villanueva
		 * @param mixed $value the field's value
		 * @return null
		 **/
		public function setValue($value) {
			$this->value = $value;
		}

		/**
		 * Returns the "cleaned" value of the field.
		 * @author Andric Villanueva
		 * @return mixed the field's "cleaned" value
		 **/
		public function getValue() {
			return $this->imported;
		}

		/**
		 * Sets an HTML attribute of the field.
		 * @author Andric Villanueva
		 * @param string $key the attribute name
		 * @param string $value the attribute's value
		 * @return null
		 **/
		public function setAttribute($key, $value) {
			$this->attributes[$key] = $value;
		}

		/**
		 * Returns the value of an HTML attribute or null if not set.
		 * @author Andric Villanueva
		 * @param string $key the attribute name to look up
		 * @return string|null the attribute's value or null if not set
		 **/
		public function getAttribute($key) {
			if (array_key_exists($key, $this->attributes)) {
				return $this->attributes[$key];
			}
			
			return null;
		}

		/**
		 * Returns a list of errors generated during validation. If the field is not
		 * yet validated, returns null.
		 * @author Andric Villanueva
		 * @return array|null
		 **/
		public function getErrors() {
			return $this->errors;
		}

		/**
		 * Returns an HTML string containing the field's help text.
		 * @author Andric Villanueva
		 * @return string the HTML help text paragraph
		 **/
		public function getHelpTextHTML() {
			return sprintf('<p class="phorm_help">%s</p>', htmlentities($this->help_text));
		}

		/**
		 * Returns the HTML field label.
		 * @author Andric Villanueva
		 * @return string the HTML label tag
		 **/
		public function getLabelHTML() {
			return sprintf('<label for="%s">%s</label>', (string)$this->getAttribute('id'), $this->label);
		}

		/**
		 * Return field's label.
		 * @author Andric Villanueva
		 * @return string the label
		 **/
		public function getLabel() {
			return $this->label;
		}

		/**
		 * Returns the field's tag as HTML.
		 * @author Andric Villanueva
		 * @return string the field as HTML
		 **/
		public function getControlHTML() {
			$widget = $this->render();
			$attr = $this->attributes;
			return $widget->html($this->value, $this->attributes);
		}

		/**
		 * Returns the field's errors as an unordered list with the class "phorm_error"
		 * @return string the field errors as an unordered list
		 **/
		public function getErrorsHTML() {
			$elts = array();

			if (empty($this->errors)) {
				return '';
			}
			
			if (is_array($this->errors) && count($this->errors) > 0) {
				foreach ($this->errors as $error) {
					$elts[] = sprintf('<li>%s</li>', $error);
				}
			}
			
			return sprintf('<ul class="phorm_error">%s</ul>', implode($elts));
		}

		/**
		 * Serializes the field to HTML.
		 * @author Andric Villanueva
		 * @return string the field's complete HTMl representation.
		 **/
		public function __toString() {
			return $this->getControlHTML() . $this->getHelpTextHTML() . $this->getErrorsHTML();
		}

		/**
		 * On the first call, calls each validator on the field value, and returns
		 * true if each returned successfully, false if any raised a
		 * ValidationError. On subsequent calls, returns the same value as the
		 * initial call. If $reprocess is set to true (default: false), will
		 * call each of the validators again. Stores the "cleaned" value of the
		 * field on success.
		 * 
		 * @author Andric Villanueva
		 * @return boolean true if the field's value is valid
		 * @see FormField::$valid,FormField::$imported,FormField::$validators,FormField::$errors
		 **/
		public function doValidateField() {
			if (!$this->valid) {
				//$value = $this->prepare_value($this->value);
				$value = $this->value;
				$this->errors = array();

				foreach ($this->validators as $validator) {
					if (!$validator->validate($value)) {
						$this->errors[] = $validator->getErrorMessage();
					}
				}

				if (empty($this->errors)) {
					$this->valid = true;
				}
			}

			$this->imported = $this->import_value($this->value);
			return $this->valid;
		}

		/**
		 * Get the machine name of this object
		 * @author Andric Villanueva
		 * @return string The machine name for this object based on the label
		 */
		public function getMachineName() {
			return preg_replace('/[^a-z0-9]/i', '-', strtolower($this->label));
		}

		/**
		 * Get the machine name of this object
		 * @author Andric Villanueva
		 * @return string The machine name for this object based on the label
		 */
		public function setMachineName($name) {
			$this->label = $name;
		}

		/**
		 * Pre-processes a value for validation, handling magic quotes if used.
		 * @author Andric Villanueva
		 * @param string $value the value from the form array
		 * @return string the pre-processed value
		 **/
		protected function prepare_value($value) {
			return (get_magic_quotes_gpc()) ? stripslashes($value) : $value;
		}

		/**
		 * Get the type of form that this is.
		 * @author Andric Villanueva
		 * @return int Group name
		 */
		public function getFieldType() {
			return FormControl::SINGLE;
		}

		/**
		 * Get the label for this form field
		 * @return string
		 */
		public function label() {
			return $this->label;
		}

		/**
		 * Defined in derived classes; must return an instance of FormWidet.
		 * @return FormWidet the field's widget
		 * @see FormWidet
		 **/
		abstract protected function render();

		/**
		 * Raises a ValidationError if $value is invalid.
		 * @param string|mixed $value (may be mixed if prepare_value returns a non-string)
		 * @throws ValidationError
		 * @return boolean
		 * @see ValidationError
		 **/
		//abstract protected function validate($value);

		/**
		 * Returns the field's "imported" value, if any processing is required. For
		 * example, this function may be used to convert a date/time field's string
		 * into a unix timestamp or a numeric string into an integer or float.
		 * @param string|mixed $value the pre-processed string value (or mixed if prepare_value returns a non-string)
		 * @return mixed
		 **/
		abstract public function import_value($value);
	}

	