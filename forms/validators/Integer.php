<?php

	/**
	 *
	 */
	class Integer extends Validation {
		protected $strErrorMessage = 'Supplied value is not an integer';

		/**
		 * Validate this thing
		 * @return boolean
		 */
		public function validate($value) {
			return (preg_match('/^\d+$/', $value)) ? true : false;
		}
	}