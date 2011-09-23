<?php

	/**
	 * LargeTextField
	 *
	 * A large text field using a textarea tag.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class TextareaField extends FormField {
		protected $rows = 5;
		protected $cols = 15;
		
		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param int $rows the number of rows
		 * @param int $cols the number of columns
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, $rows, $cols, $validators = array(), array $attributes = array()) {
			$attributes['cols'] = $cols;
			$attributes['rows'] = $rows;
			parent::__construct($label, $attributes, $validators);
		}

		/**
		 * Returns a new TextWidget.
		 * @author Andric Villanueva
		 * @return TextWidget
		 **/
		protected function render() {
			return new TextareaWidget();
		}

		/**
		 * Returns null.
		 * @author Andric Villanueva
		 * @return null
		 **/
		protected function validate($value) {
			return true;
		}

		/**
		 * Imports the value by decoding HTML entities.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return string the decoded value
		 **/
		public function import_value($value) {
			return html_entity_decode((string)$value);
		}
	}

	