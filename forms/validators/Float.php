<?php

	/**
	 *
	 */
	class Float extends Validation {
		protected $strErrorMessage = 'Supplied value is not a float/decimal';

		/**
		 * Validate this thing
		 * @return boolean
		 */
		public function validate($value) {
			return (preg_match('/\F/', $value)) ? false : true;
		}
	}