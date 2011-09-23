 <?php

	/**
	 * 
	 */
	abstract class Form implements FormInterface {
		/**
		 * A copy of the superglobal data array merged with any default field values
		 * provided during class instantiation.
		 * @see Form::__construct()
		 **/
		protected $data;
		protected $method		= Form::GET;	// Method the form uses
		protected $multi_part	= false;		// If true, $_FILES is included in the form data. Makes possible file fields.
		protected $bound		= false;		// True when the form has user-submitted data.
		protected $valid		= false;		// Memoized return value of the initial doValidateField call.
		protected $fields		= array();		// protected field storage.
		protected $errors		= array();		// protected storage to collect error messages. Stored as $field_name => $msg.
		protected $clean;						// protected storage for cleaned field values.
		protected $theme;						// Set the theming function for this thingy
		protected $name;						// Set the theming function for this thingy

		/**
		 * @param Form::GET|Form::POST $method whether to use GET or POST
		 * @param boolean $multi_part true if this form accepts files
		 * @param array $data initial/default data for form fields (e.g. array('first_name'=>'enter your name'))
		 * @return void
		 * @author Andric Villanueva
		 **/
		public function __construct($name, $method = Form::POST) {
			// The form ID 
			$this->name = 'form-' . preg_replace('/[^a-z0-9]/i', '-', strtolower($name));

			// Set up fields
			//------------------------------------------------------------------------
			// We should just set the fields. That would be better
			$this->init();
			$this->fields = $this->prepareFields();
			//------------------------------------------------------------------------

			//$this->setup($method, $data);
			$this->setMethod($method);				// Find submitted data, if any
			$user_data = $this->getSubmittedRaw($method);
			$this->setMultiPart();								// Fix later
			$this->bound = $this->check_if_bound($user_data);	// Determine if this form is bound (depends on defined fields)
			$this->data = $user_data;		// Merge post with superfluous data array
			$this->setControlData(); // Set the fields' data

			if ($this->bound) {
				$this->validate();
			}
		}

		/**
		 * Get form validity
		 * @return bool
		 */
		public function getValid() {
			return $this->valid;
		}

		/**
		 * 
		 */
		public function setMultiPart($multi_part = false) {
			$this->multi_part = $multi_part;

			if ($this->multi_part && $method != Form::POST) {
				$this->method = Form::POST;
				//trigger_error('Multi-part form method changed to POST.', E_USER_WARNING);
				// No error needed.  Just change it.  Maybe log it *later*
			}
		}

		/**
		 * Default to post
		 * @param enum $method
		 * @return array 
		 */
		public function setMethod($method = Form::POST) {
			switch ($method) {
				case Form::GET:
				$this->method = $method;
				break;

				case Form::POST:
				$this->method = $method;
				break;
			}
		}

		/**
		 * Get the raw submitted data to pupulate the fields
		 * @param <type> $actionType
		 * @return <type>
		 */
		public function getSubmittedRaw($actionType = Form::POST) {
			$userData = array();
			if ($actionType == Form::GET) {
				$userData = $_GET;
			}
			else if ($actionType == Form::POST) {
				$userData = $_POST;
			}

			return $userData;
		}

		/**
		 * Pre-processes user submitted data by checking that each field has a
		 * corresponding value. This prevents the default data from being used with
		 * a "missing" field value, such as is the case with a checkbox or radio
		 * field that is unchecked.
		 * @author Andric Villanueva
		 * @param array $data a superglobal data array (e.g. $_GET or $_POST)
		 * @return array the processed data
		 **/
		/*protected function pre_process_data(array $data)
		{
			foreach(array_keys($this->fields) as $name)
			if ( !array_key_exists($name, $data) )
			$data[$name] = '';
			return $data;
		} //*/

		/**
		 * Abstract method that sets the Form's fields as class attributes.
		 * @return null
		 * @author Andric Villanueva
		 **/
		abstract protected function init();

		/**
		 * Submit handler
		 * @return null
		 * @author Andric Villanueva
		 */
		public abstract function submit();

		/**
		 * Returns true if any of the field's names exist in the source data (or
		 * in $_FILES if this is a multi-part form.)
		 * @return boolean
		 * @author Andric Villanueva
		 **/
		protected function check_if_bound(array $data) {
			foreach ($this->fields as $name => $field) {
				if (array_key_exists($name, $data) || ($this->multi_part && array_key_exists($name, $_FILES))) {
					return true;
				}
			}
			
			return false;
		}

		/**
		 * Add a control to the form
		 * @param FormField $control
		 * @author Andric Villanueva
		 */
		public function addControl(FormField $control) {
			$this->fields[$control->getMachineName()] = $control;
		}

		/**
		 * Internal method used by the constructor to find all of the fields in the
		 * class after the child's 'init' is called. Returns an array of
		 * the field instances.
		 * @return array the field instances
		 * @author Andric Villanueva
		 **/
		protected function prepareFields() {
			$found = array();
			foreach ($this->fields as $field) {
				$name = $field->getMachineName();
				$id = 'id-' . $name;

				// These two things should be done in the field parent class.
				$field->setAttribute('id', $id);
				$field->setAttribute('name', ($field->multi_field) ? sprintf('%s[]', $name) : $name);
				$found[$name] = $field;
			} //*/

			return $found;
		}

		/**
		 * Sets the value of each field from the proper superglobal data array.
		 * @return null
		 * @author Andric Villanueva
		 **/
		protected function setControlData() {
			foreach ($this->fields as $name => $field) {
				if (array_key_exists($name, $this->data)) {
					$field->setValue($this->data[$name]);
				}
			}
		}

		/**
		 * Returns an associative array of the imported form data on a bound, valid
		 * form. Returns null if the form is not yet bound or if the form is not
		 * valid.
		 * @return array|null
		 * @author Andric Villanueva
		 **/
		public function cleaned_data() {
			return $this->clean;
		}

		/**
		 * Returns true if the form is bound (i.e., there is data in the appropriate
		 * superglobal array.)
		 * @return boolean
		 * @author Andric Villanueva
		 **/
		public function is_bound() {
			return $this->bound;
		}

		/**
		 * Returns true if the form has errors.
		 * @author Andric Villanueva
		 * @return boolean
		 **/
		public function has_errors() {
			return (count($this->errors) > 0);
		}

		/**
		 * Returns an array of errors.
		 * @author Andric Villanueva
		 * @return array error messages
		 **/
		public function get_errors() {
			return $this->errors;
		}

		/**
		 * Returns the list of errors.
		 * @author Andric Villanueva
		 * @return string error messages
		 **/
		public function getErrorHTML() {
			$elts = array();
			foreach ($this->errors as $field => $error) {
				$elts[] = sprintf('<ul>%s</ul>', $this->fields[$field]->getLabel());
				foreach ($this->fields[$field]->getErrors() as $error) {
					$elts[] = sprintf('<li>%s</li>', $error);
				}
			}

			return implode("\n", $elts);
		}

		/**
		 * Returns true if all fields' data pass validation tests.
		 * @param boolean $reprocess if true (default: false), call all validators again
		 * @return boolean
		 * @author Andric Villanueva
		 **/
		public function validate() {
			$intValid = 0;

			if ($this->is_bound() && $this->valid == false) {
				foreach ($this->fields as $name => $field) {
					if (!$field->doValidateField()) {
						$this->errors[$name] = $field->getErrors();
					}

					if (!empty($this->errors[$name])) {
						$intValid++;
					}
				}
			}

			// Determine if the form is valid by how many
			if ($intValid == 0) {
				$this->valid = true;
			}

			// Form is bound and valid
			if ($this->valid && $this->is_bound()) {
				$this->clean_data();  // Not needed
			}
			
			return $this->valid;
		}

		/**
		 * Processes each field's data in turn, calling it's get_value method to
		 * access its "cleaned" data.
		 * @return null
		 * @author Andric Villanueva
		 **/
		protected function clean_data() {
			$this->clean = array();
			foreach($this->fields as $name => $field) {
				$this->clean[$name] = $field->getValue();
			}
		}

		/**
		 * Returns the form's opening HTML tag.
		 * @param string $target the form target ($_SERVER['PHP_SELF'] by default)
		 * @return string the form's opening tag
		 * @author Andric Villanueva
		 **/
		public function open($target=null) {
			if (is_null($target)) {
				$target = $_SERVER['PHP_SELF'];
			}

			switch ($this->method) {
				case Form::GET:
				$method = "GET";
				break;

				case Form::POST:
				$method = "POST";
				break;

				default:
				$method = "GET";
			}
			
			return sprintf('<form id="%s" method="%s" action="%s" %s>',
					$this->name,
					$method,
					htmlentities((string)$target),
					($this->multi_part) ? 'enctype="multipart/form-data"' : ''
			);
		}

		/**
		 * Returns the form's closing HTML tag.
		 * @return string the form's closing tag
		 * @author Andric Villanueva
		 **/
		public function close() {
			// Perhaps a hidden field or two man
			return '</form>';
		}

		/**
		 * Returns a string of all of the form's fields' HTML tags as a table.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 * @see Phorm::as_table()
		 **/
		public function __toString() {
			return $this->as_table();
		}

		/**
		 * Returns the form fields as a series of HTML table rows. Does not include
		 * the table's opening and closing tags, nor the table's tbody tags.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 **/
		public function as_table() {
			$elts = array();
			foreach ($this->fields as $name => $field) {
				$label = $field->getLabelHTML();
				if ($field->label() !== '') {
					$elts[] = sprintf('<tr><th>%s:</th><td>%s</td></tr>', $label, $field);
				}
				else {
					$elts[] = strval($field);
				}
			}
			return implode($elts);
		}

		/**
		 * Returns the form fields as a series of list items. Does not include the
		 * list's opening and closing tags.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 **/
		public function getUnformattedOutput() {
			$elts = array();
			$elts[] = $this->open();
			foreach ($this->fields as $name => $field) {
				//var_dump($field->getMachineName());
				if ($field->label() !== '') {
					$label = sprintf("<label for=\"id-%s\">%s</label>", $field->getMachineName(), $field->label());
					//$elts[] = sprintf('<li>$label: %s</li>', $label, $field);
					$elts[] = sprintf('%s: %s', $label, $field);
				}
				else {
					$elts[] = strval($field);
				}
			}
			$elts[] = $this->close();
			
			return implode($elts);
		}

		/**
		 * For use to render the fields manually
		 * @return array FormField objects
		 */
		public function getFields() {
			return $this->fields;
		}

		/**
		 * Get the form name
		 * @return <type>
		 */
		public function getFormName() {
			return $this->name;
		}

		/**
		 * Setup the theme to use instead od the default renderer
		 * @param <type> $theme
		 */
		public function setTheme($theme) {
			$this->theme = $theme;
		}
	}
