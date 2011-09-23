<?php

	/**
	 * CharWidget
	 *
	 * A basic text input field.
	 * @author Andric Villanueva
	 * @package Widgets
	 **/
	class CharWidget extends FormWidet {
		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array()) {
			//var_dump($attributes);
			$attributes['type'] = 'text';
			return parent::serialize($value, $attributes);
		}
	}

