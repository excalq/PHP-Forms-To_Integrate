<?php

	interface FormControl {
		const SINGLE	= 0;
		const GROUP		= 1;

		/**
		 * Assigns help text to the field.
		 * @author Andric Villanueva
		 * @param string $text the help text
		 * @return null
		 **/
		public function setHelpText($text);

		/**
		 * Sets the value of the field.
		 * @author Andric Villanueva
		 * @param mixed $value the field's value
		 * @return null
		 **/
		public function setValue($value);

		/**
		 * Returns the "cleaned" value of the field.
		 * @author Andric Villanueva
		 * @return mixed the field's "cleaned" value
		 **/
		public function getValue();

		/**
		 * Sets an HTML attribute of the field.
		 * @author Andric Villanueva
		 * @param string $key the attribute name
		 * @param string $value the attribute's value
		 * @return null
		 **/
		public function setAttribute($key, $value);

		/**
		 * Returns the value of an HTML attribute or null if not set.
		 * @author Andric Villanueva
		 * @param string $key the attribute name to look up
		 * @return string|null the attribute's value or null if not set
		 **/
		public function getAttribute($key);

		/**
		 * Returns a list of errors generated during validation. If the field is not
		 * yet validated, returns null.
		 * @author Andric Villanueva
		 * @return array|null
		 **/
		public function getErrors();

		/**
		 * Returns an HTML string containing the field's help text.
		 * @author Andric Villanueva
		 * @return string the HTML help text paragraph
		 **/
		public function getHelpTextHTML();

		/**
		 * Returns the HTML field label.
		 * @author Andric Villanueva
		 * @return string the HTML label tag
		 **/
		public function getLabelHTML();

		/**
		 * Returns the field's tag as HTML.
		 * @author Andric Villanueva
		 * @return string the field as HTML
		 **/
		public function getControlHTML();

		/**
		 * Returns the field's errors as an unordered list with the class "phorm_error"
		 * @return string the field errors as an unordered list
		 **/
		public function getErrorsHTML();

		/**
		 * On the first call, calls each validator on the field value, and returns
		 * true if each returned successfully, false if any raised a
		 * ValidationError. On subsequent calls, returns the same value as the
		 * initial call. If $reprocess is set to true (default: false), will
		 * call each of the validators again. Stores the "cleaned" value of the
		 * field on success.
		 *
		 * @author Andric Villanueva
		 * @param boolean $reprocess if true, ignores memoized result of initial call
		 * @return boolean true if the field's value is valid
		 * @see FormField::$valid,FormField::$imported,FormField::$validators,FormField::$errors
		 **/
		public function doValidateField();

		/**
		 * Get the machine name of this object
		 * @author Andric Villanueva
		 * @return string The machine name for this object based on the label
		 */
		public function getMachineName();

		/**
		 * Get the type of form that this is.
		 * @author Andric Villanueva
		 * @return int Group name
		 */
		public function getFieldType();
	}