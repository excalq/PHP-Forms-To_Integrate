<?php

	/**
	 *
	 */
	class Length extends Validation {
		protected $strErrorMessage = 'This field is too short';
		protected $intMaxLength = 10;

		public function __construct($default = 10) {
			$this->intMaxLength = $default;
		}

		/**
		 * Validate this thing
		 * @return boolean
		 */
		public function validate($value) {
			return (strlen($value) < $this->intMaxLength) ? false : true;
		}
	}