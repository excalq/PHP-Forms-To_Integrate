<?php

	/**
	 * URLField
	 *
	 * A text field that only accepts a reasonably-formatted URL. Supports HTTP(S)
	 * and FTP. If a value is missing the HTTP(S)/FTP prefix, adds it to the final
	 * value.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class URLField extends TextField {
		/**
		 * Prepares the value by inserting http:// to the beginning if missing.
		 * @author Andric Villanueva
		 * @param string $value
		 * @return string
		 **/
		public function import_value($value) {
			if (!preg_match('@^(http|ftp)s?://@', $value)) {
				return sprintf('http://%s', $value);
			}
			else {
				return $value;
			}
		}
	}

