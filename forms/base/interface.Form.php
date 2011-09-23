<?php

	interface FormInterface {
		const GET = 0;
		const POST = 1;

		/**
		 * @param Form::GET|Form::POST $method whether to use GET or POST
		 * @param boolean $multi_part true if this form accepts files
		 * @param array $data initial/default data for form fields (e.g. array('first_name'=>'enter your name'))
		 * @return void
		 * @author Andric Villanueva
		 **/
		public function __construct($strName, $method = Form::POST);

		/**
		 * Pre-processes user submitted data by checking that each field has a
		 * corresponding value. This prevents the default data from being used with
		 * a "missing" field value, such as is the case with a checkbox or radio
		 * field that is unchecked.
		 * @author Andric Villanueva
		 * @param array $data a superglobal data array (e.g. $_GET or $_POST)
		 * @return array the processed data
		 **/
		// private function pre_process_data(array $data)
		// {
		// 	foreach(array_keys($this->fields) as $name)
		// 		if ( !array_key_exists($name, $data) )
		// 			$data[$name] = '';
		// 	return $data;
		// }
		
		/**
		 * Internal method used by the constructor to find all of the fields in the
		 * class after the child's 'define_fields' is called. Returns an array of
		 * the field instances.
		 * @return array the field instances
		 * @author Andric Villanueva
		 **/
		public function getFields();

		/**
		 * Returns an associative array of the imported form data on a bound, valid
		 * form. Returns null if the form is not yet bound or if the form is not
		 * valid.
		 * @return array|null
		 * @author Andric Villanueva
		 **/
		public function cleaned_data();

		/**
		 * Returns true if the form is bound (i.e., there is data in the appropriate
		 * superglobal array.)
		 * @return boolean
		 * @author Andric Villanueva
		 **/
		public function is_bound();

		/**
		 * Returns true if the form has errors.
		 * @author Andric Villanueva
		 * @return boolean
		 **/
		public function has_errors();

		/**
		 * Returns the list of errors.
		 * @author Andric Villanueva
		 * @return array error messages
		 **/
		public function get_errors();

		/**
		 * Returns the list of errors.
		 * @author Andric Villanueva
		 * @return string error messages
		 **/
		public function getErrorHTML();

		/**
		 * Returns true if all fields' data pass validation tests.
		 * @return boolean
		 * @author Andric Villanueva
		 **/
		public function validate();

		/**
		 * Returns the form's opening HTML tag.
		 * @param string $target the form target ($_SERVER['PHP_SELF'] by default)
		 * @return string the form's opening tag
		 * @author Andric Villanueva
		 **/
		public function open($target = null);

		/**
		 * Returns the form's closing HTML tag.
		 * @return string the form's closing tag
		 * @author Andric Villanueva
		 **/
		public function close();

		/**
		 * Returns a string of all of the form's fields' HTML tags as a table.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 * @see Phorm::as_table()
		 **/
		public function __toString();

		/**
		 * Returns the form fields as a series of HTML table rows. Does not include
		 * the table's opening and closing tags, nor the table's tbody tags.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 **/
		public function as_table();

		/**
		 * Returns the form fields as a series of list items. Does not include the
		 * list's opening and closing tags.
		 * @return string the HTML form
		 * @author Andric Villanueva
		 **/
		public function getUnformattedOutput();
	}

