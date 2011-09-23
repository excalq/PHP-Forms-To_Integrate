<?php

	/**
	 *
	 */
	class Url extends Validation {
		protected $strErrorMessage = 'This field is ot a valid URL';

		/**
		 * Validate this thing
		 * @return boolean
		 */
		public function validate($value) {
			var_dump(!preg_match('@^(http|ftp)s?://(\w+(:\w+)?\@)?(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+(\w*)@', $value));
			return true;
		}

		/**
		 *
		 * @param <type> $strErrorMessage
		 */
		public function setErrorMessage($strErrorMessage) {
			$this->strErrorMessage = $strErrorMessage;
		}

		/**
		 *
		 * @return <type>
		 */
		public function getErrorMessage() {
			return $this->strErrorMessage;
		}
	}