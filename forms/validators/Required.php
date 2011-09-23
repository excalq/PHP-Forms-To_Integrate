<?php

	/**
	 * 
	 */
	class Required extends Validation {
		protected $strErrorMessage = 'This field is required';

		/**
		 * Validate this thing
		 * @return boolean
		 */
		public function validate($value) {
			return ($value == '') ? false : true;
		}
	}