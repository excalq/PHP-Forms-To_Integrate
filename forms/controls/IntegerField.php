<?php

	/**
	 * IntegerField
	 *
	 * A field that accepts only integers.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class IntegerField extends FormField
	{
		/**
		 * Stores the max number of digits permitted.
		 **/
		private $max_digits;

		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param int $max_digits the maximum number of digits permitted
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, $max_digits, array $validators=array(), array $attributes=array())
		{
			$attributes['size'] = 20;
			parent::__construct($label, $attributes, $validators);
			$this->max_digits = $max_digits;
		}

		/**
		 * Returns a new CharWidget.
		 * @author Andric Villanueva
		 * @return CharWidget
		 **/
		public function render()
		{
			return new CharWidget();
		}

		/**
		 * Validates that the value is parsable as an integer and that it is fewer
		 * than $this->max_digits digits.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return null
		 * @throws ValidationError
		 **/
		public function validate($value)
		{
			if (preg_match('/\D/', $value) || strlen((string)$value) > $this->max_digits)
				throw new ValidationError("Must be a number with fewer than {$this->max_digits} digits.");
		}

		/**
		 * Parses the value as an integer.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return int
		 **/
		public function import_value($value)
		{
			return (int)(html_entity_decode((string)$value));
		}
	}

	