<?php

	/**
	 * BooleanField
	 *
	 * A field representing a boolean choice using a checkbox field.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class BooleanField extends FormField
	{
		/**
		 * True when the field is checked (true).
		 **/
		private $checked;

		/**
		 * @author Andric Villanueva
		 * @param string $label the field's text label
		 * @param array $validators a list of callbacks to validate the field data
		 * @param array $attributes a list of key/value pairs representing HTML attributes
		 **/
		public function __construct($label, array $validators=array(), array $attributes=array())
		{
			parent::__construct($label, $validators, $attributes);
			parent::set_value('on');
			$this->checked = false;
		}

		/**
		 * Sets the value of the field.
		 * @author Andric Villanueva
		 * @param boolean $value
		 * @return null
		 **/
		public function setValue($value)
		{
			$this->checked = (boolean)$value;
		}

		/**
		 * Returns true if the field is checked.
		 * @author Andric Villanueva
		 * @return boolean
		 **/
		public function getValue()
		{
			return $this->checked;
		}

		/**
		 * Returns a new CheckboxWidget.
		 * @author Andric Villanueva
		 * @return CheckboxWidget
		 **/
		public function render()
		{
			return new CheckboxWidget($this->checked);
		}

		/**
		 * Returns null.
		 * @author Andric Villanueva
		 * @return null
		 **/
		public function validate($value)
		{
			return null;
		}

		/**
		 * Returns true if the field was checked in the user-submitted data, false
		 * otherwise.
		 * @author Andric Villanueva
		 * @return boolean
		 **/
		public function import_value($value)
		{
			return $this->checked;
		}

		/**
		 * Returns the value.
		 * @author Andric Villanueva
		 * @param string $value
		 * @param string
		 **/
		public function prepare_value($value) {
			return $value;
		}
	}

	