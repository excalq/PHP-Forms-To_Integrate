<?php

	/**
	 * DecimalField
	 *
	 * A field that accepts only decimals of a specified precision.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class DecimalField extends FormField
	{
		/**
		 * The maximum precision of the field's value.
		 **/
		private $precision;

		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param int $precision the maximum number of decimals permitted
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, $precision, array $validators=array(), array $attributes=array())
		{
			$attributes['size'] = 20;
			parent::__construct($label, $validators, $attributes);
			$this->precision = $precision;
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
		 * Validates that the value is parsable as a float.
		 * @author Andric Villanueva
		 * @param string value
		 * @return null
		 * @throws ValidationError
		 **/
		public function validate($value)
		{
			if (!is_numeric($value))
				throw new ValidationError("Invalid decimal value.");
		}

		/**
		 * Returns the parsed float, rounded to $this->precision digits.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return float the parsed value
		 **/
		public function import_value($value)
		{
			return round((float)(html_entity_decode($value)), $this->precision);
		}
	}

	