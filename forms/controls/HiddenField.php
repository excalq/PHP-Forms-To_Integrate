<?php

	/**
	 * HiddenField
	 *
	 * A hidden text field that does not print a label.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class HiddenField extends TextField {
		/**
		 * @author Andric Villanueva
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($name) {
			parent::__construct($name);
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
		 * Does not print out the help text.
		 * @author Andric Villanueva
		 * @return string an empty string.
		 **/
		public function help_text() {
			return '';
		}

		/**
		 * Returns a new HiddenWidget.
		 * @author Andric Villanueva
		 * @return HiddenWidget
		 **/
		protected function render() {
			return new HiddenWidget();
		}

		/**
		 * Do nothing validation field for this hidden control
		 */
		public function doValidateField() {
			$this->imported = $this->import_value($this->value);
			return true;
		}
	}
