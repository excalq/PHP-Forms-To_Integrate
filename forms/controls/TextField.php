<?php

	/**
	 * TextField
	 *
	 * A simple text field.
	 * @package Fields
	 **/
	class TextField extends FormField {
		/**
		 * Stores the maximum value length in characters.
		 **/
		protected $intMaxLength = 255; // Defaults
		protected $size = 25; // Defaults

		/**
		 * @param string $label the field's text label
		 * @param int $size the field's size attribute
		 * @param int $max_length the maximum size in characters
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $attributes = array(), array $validators = array()) {
			$attributes['size'] = (!isset($attributes['size'])) ? $this->size : $attributes['size'];
			parent::__construct($label, $attributes, $validators);
		}

		/**
		 * Set the maximum length
		 * @param integer $intMaxLength
		 */
		public function setMaxLength($intMaxLength) {
			$this->attributes['maxlength'] = $this->intMaxLength = $intMaxLength;
		}

		/**
		 * Get the max length
		 * @return integer
		 */
		public function getMaxLength() {
			return $this->intMaxLength;
		}

		/**
		 * Returns a new CharWidget.
		 * @return CharWidget
		 **/
		protected function render() {
			return new CharWidget();
		}

		/**
		 * Imports the value by decoding HTML entities.
		 * @param string $value
		 * @return string the decoded value
		 **/
		public function import_value($value) {
			return html_entity_decode((string)$value);
		}
	}

