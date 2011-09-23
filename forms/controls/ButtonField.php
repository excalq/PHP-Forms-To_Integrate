<?php

	/**
	 * BooleanField
	 *
	 * A field representing a boolean choice using a checkbox field.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class ButtonField extends FormField {
		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $attributes = array()) {
			$validators = array();
			parent::__construct($label, $validators, $attributes);
		}

		/**
		 * Does not print out a label.
		 * @author Andric Villanueva
		 * @return string an empty string
		 **/
		public function label() {
			return '';
		}

		/**
		 * Returns a new CheckboxWidget.
		 * @author Andric Villanueva
		 * @return CheckboxWidget
		 **/
		public function render() {
			return new ButtonWidget('button', $this->label, $this->getMachineName());
		}

		/**
		 * Returns null.
		 * @author Andric Villanueva
		 * @return null
		 **/
		public function validate($value) {
			return null;
		}

		/**
		 * Returns true if the field was checked in the user-submitted data, false
		 * otherwise.
		 * @author Andric Villanueva
		 * @return boolean
		 **/
		public function import_value($value) {
			return $this->value;
		}

		/**
		 * Do nothing validation field for this hidden control
		 */
		public function doValidateField() {
			$this->imported = $this->import_value($this->value);
			return true;
		}
	}

	