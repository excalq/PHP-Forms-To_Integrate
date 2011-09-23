<?php

	/**
	 * Widgetable
	 *
	 * The base class of all HTML form widgets.
	 * @author Andric Villanueva
	 * @package Widgets
	 **/

	/**
	 * Description of FormWidet
	 *
	 * @author andric_v
	 */
	interface Widgetable {
		/**
		 * Serializes an array of key=>value pairs as an HTML attributes string.
		 * @author Andric Villanueva
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize_attributes(array $attributes = array());

		/**
		 * Serializes the widget as an HTML form input.
		 * @author Andric Villanueva
		 * @param string $value the form widget's value
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array());

		/**
		 * Casts a value to a string and encodes it for HTML output.
		 * @author Andric Villanueva
		 * @param mixed $str
		 * @return a decoded string
		 **/
		protected function clean_string($str);

		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		public function html($value, array $attributes = array());
	}

