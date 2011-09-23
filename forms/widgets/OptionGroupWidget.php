<?php

	/**
	 * OptionGroupWidget
	 *
	 * A compound widget made up of multiple CheckboxWidgets.
	 * @author Andric Villanueva
	 * @package Widgets
	 * @see CheckboxWidget
	 **/
	class OptionGroupWidget extends FormWidet {
		/**
		 * The options for this field as an array of actual=>display values.
		 **/
		private $options;

		/**
		 * @author Andric Villanueva
		 * @param array $options the options as an array of actual=>display values
		 * @return null
		 **/
		public function __construct(array $options) {
			$this->options = $options;
		}

		/**
		 * @author Andric Villanueva
		 * @param array $value an array of the field's values
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 **/
		public function html($value, array $attributes=array()) {
			if (is_null($value)) {
				$value = array();
			}

			foreach ($attributes as $key => $val) {
				$attributes[htmlentities((string)$key)] = htmlentities((string)$val);
			}

			return $this->serialize($value, $attributes);
		}

		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes=array()) {
			$html = "";
			foreach ($this->options as $actual => $display) {
				$option = new CheckboxWidget( in_array($actual, $value) );
				$html .= sprintf('%s %s', htmlentities($display), $option->html($actual, $attributes));
			}

			return $html;
		}
	}
