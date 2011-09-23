<?php

	/**
	 * ButtonWidget
	 *
	 * A basic text input field.
	 * @author Andric Villanueva
	 * @package Widgets
	 **/
	class ButtonWidget extends FormWidet {
		protected $label = 'submit';
		protected $value = 'submit';
		protected $type = 'submit';

		public function  __construct($type, $lbl, $val) {
			$this->type = $type;
			$this->value = $val;
			$this->label = $lbl;
		}

		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array()) {
			$attributes['type'] = $this->type;
			return sprintf('<input value="%s" %s />', $this->label, $this->serialize_attributes($attributes));
		}
	}

