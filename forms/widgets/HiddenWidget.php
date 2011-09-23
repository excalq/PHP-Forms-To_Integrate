<?php

	/**
	 * HiddenWidget
	 *
	 * A hidden text field.
	 * @author Andric Villanueva
	 * @package Widgets
	 **/
	class HiddenWidget extends FormWidet {
		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array()) {
			//var_dump(parent::serialize($value, $attributes));
			$attributes['type'] = 'hidden';
			return parent::serialize($value, $attributes);
		}
	}

	