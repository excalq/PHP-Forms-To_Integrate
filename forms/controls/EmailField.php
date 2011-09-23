<?php

	/**
	 * EmailField
	 *
	 * A text field that only accepts a valid email address.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class EmailField extends TextField {
		/**
		 * Validates that the value is a valid email address.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return null
		 * @throws ValidationError
		 **/
		public function validate($value) {
			parent::validate($value);
			if ( !preg_match('@^([-_\.a-zA-Z0-9]+)\@(([-_\.a-zA-Z0-9]+)\.)+[-_\.a-zA-Z0-9]+$@', $value) )
				throw new ValidationError("Invalid email address.");
		}
	}

	