<?php

	/**
	 * FormWidet
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
	class FormWidet {
		/**
		 * Serializes an array of key=>value pairs as an HTML attributes string.
		 * @author Andric Villanueva
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize_attributes(array $attributes=array()) {
			$attr = array();

			foreach ($attributes as $key => $val) {
				$attr[] = sprintf('%s="%s"', $key, $val);
			}

			return implode(' ', $attr);
		}

		/**
		 * Serializes the widget as an HTML form input.
		 * @author Andric Villanueva
		 * @param string $value the form widget's value
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		protected function serialize($value, array $attributes = array()) {
			return sprintf('<input value="%s" %s />', $value, $this->serialize_attributes($attributes));
		}

		/**
		 * Casts a value to a string and encodes it for HTML output.
		 * @author Andric Villanueva
		 * @param mixed $str
		 * @return a decoded string
		 **/
		protected function clean_string($str) {
			return htmlentities((string)$str);
		}

		/**
		 * Returns the field as serialized HTML.
		 * @author Andric Villanueva
		 * @param mixed $value the form widget's value attribute
		 * @param array $attributes key=>value pairs corresponding to HTML attributes' name=>value
		 * @return string the serialized HTML
		 **/
		public function html($value, array $attributes = array()) {
			$value = htmlentities((string)$value);

			foreach ($attributes as $key => $val) {
				$attributes[htmlentities((string)$key)] = htmlentities((string)$val);
			}
			
			return $this->serialize($value, $attributes);
		}
	}

