<?php

	interface Validatable {
		/**
		 * Validates the the value.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return boolean
		 * @throws ValidationError
		 **/
		public function validate($value);

		/**
		 *
		 * @param <type> $strErrorMessage
		 */
		public function setErrorMessage($strErrorMessage);

		/**
		 *
		 * @return <type>
		 */
		public function getErrorMessage();
	}