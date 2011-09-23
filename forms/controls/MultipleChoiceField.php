<?php

	/**
	 * MultipleChoiceField
	 *
	 * A compound field offering multiple choices as a select multiple tag.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class MultipleChoiceField extends FormField {
		/**
		 * Specifies that this field's name attribute must be post-fixed by [].
		 **/
		public $multi_field = true;
		/**
		 * Stores the field options as actual_value=>display_value.
		 **/
		private $choices;

		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param array $choices a list of choices as actual_value=>display_value
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $choices, array $validators=array(), array $attributes=array()) {
			parent::__construct($label, $validators, $attributes);
			$this->choices = $choices;
		}

		/**
		 * Returns a new MultiSelectWidget.
		 * @author Andric Villanueva
		 * @return MultiSelectWidget
		 **/
		public function render() {
			return new MultiSelectWidget($this->choices);
		}

		/**
		 * Validates that each of the selected choice exists in $this->choices.
		 * @author Andric Villanueva
		 * @param array $value
		 * @return null
		 * @throws ValidationError
		 * @see MultipleChoiceField::$choices
		 **/
		public function validate($value) {
			if (!is_array($value)) {
				throw new ValidationError('Invalid selection');
			}

			foreach ($value as $v) {
				if (!in_array($v, array_keys($this->choices))) {
					throw new ValidationError("Invalid selection.");
				}
			}
		}

		/**
		 * Imports the value as an array of the actual values (from $this->choices.)
		 * @author Andric Villanueva
		 * @param array $value
		 * @return array
		 **/
		public function import_value($value) {
			if (is_array($value)) {
				foreach ($value as $key => &$val) {
					$val = html_entity_decode($val);
				}
			}
			
			return $value;
		}
	}

