<?php

	/**
	 * BooleanField
	 *
	 * A field representing a boolean choice using a checkbox field.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class GroupField implements FormControlGroup {
		protected $name = '';
		protected $fields = array();

		/**
		 *
		 * @param <type> $name
		 */
		public function  __construct($name) {
			$this->name = preg_replace('/[^a-z0-9]/i', '-', strtolower($name));
		}

		/**
		 *
		 * @param FormControl $field
		 */
		public function addField(FormControl $field) {
			$this->fields['group-' . $field->getMachineName()] = $field;
		}

		/**
		 * Take the name/label and turn it into a machine name
		 * @return <type>
		 */
		public function getMachineName() {
			return $this->name;
		}

		/**
		 * Get the group's fields as an array
		 * @return array
		 */
		public function getFields() {
			return $this->fields;
		}
	}

	