<?php

	/**
	 * DateTimeField
	 *
	 * A text field that accepts a variety of date/time formats (those accepted by
	 * PHP's built-in strtotime.) Note that due to the reliance on strtotime, this
	 * class has a serious memory leak in PHP 5.2.8 (I am unsure if it is present
	 * as well in 5.2.9+.)
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class DateTimeField extends TextField {
		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $validators=array(), array $attributes = array()) {
			parent::__construct($label, $validators, $attributes);
		}

		/**
		 * Validates that the value is parsable as a date/time value.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return null
		 * @throws ValidationError
		 **/
		public function validate($value) {
			parent::validate($value);
			if (!strtotime($value)) {
				throw new ValidationError("Date/time format not recognized.");
			}
		}

		/**
		 * Imports the value and returns a unix timestamp (the number of seconds
		 * since the epoch.)
		 * @author Andric Villanueva
		 * @param string $value
		 * @return int the date/time as a unix timestamp
		 **/
		public function import_value($value) {
			$value = parent::import_value($value);
			return strtotime($value);
		}
	}

	