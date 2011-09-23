<?php

	/**
	 * BooleanField
	 *
	 * A field representing a boolean choice using a checkbox field.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class SubmitField extends ButtonField {
		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $attributes=array()) {
			$validators = array();
			parent::__construct($label, $validators, $attributes);
		}

		/**
		 * Returns a new CheckboxWidget.
		 * @author Andric Villanueva
		 * @return CheckboxWidget
		 **/
		public function render() {
			return new ButtonWidget('submit', $this->label, $this->getMachineName());
		}
	}

	