<?php

	/**
	 *
	 */
	abstract class Validation implements Validatable
	{
		protected $strErrorMessage = 'Generic error message';

		public function __construct() {
		}

		/**
		 *
		 * @param <type> $strErrorMessage
		 */
		public function setErrorMessage($strErrorMessage)
		{
			$this->strErrorMessage = $strErrorMessage;
		}

		/**
		 *
		 * @return <type>
		 */
		public function getErrorMessage()
		{
			return $this->strErrorMessage;
		}
	}