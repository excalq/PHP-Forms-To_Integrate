<?php

	/**
	 * SelectWidget
	 *
	 * A select widget (drop-down list.)
	 * @author Andric Villanueva
	 * @package Widgets
	 **/
	class SelectWidget extends FormWidet {
		/**
		 * The choices for this field as an array of actual=>display values.
		 **/
		private $choices;

		/**
		 * @author Andric Villanueva
		 * @param array $choices the choices as an array of actual=>display values
		 * @return null
		 **/
		public function __construct(array $choices) {
			$this->choices = $choices;
		}

		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's selected value
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array()) {
			$options = array();
			foreach($this->choices as $actual => $display) {
				$option_attributes = array('value' => $this->clean_string($actual));
				if ($actual == $value) {
					$option_attributes['selected'] = 'selected';
				}
				
				$options[] = sprintf('<option %s>%s</option>',
					$this->serialize_attributes($option_attributes),
					$this->clean_string($display));
			}

			return sprintf('<select %s>%s</select>',
				$this->serialize_attributes($attributes),
				implode($options));
		}
	}

	