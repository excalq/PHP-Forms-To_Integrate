<?php

	/**
	 * Image
	 *
	 * Adds a few additional properties specific for images to the File class.
	 * @author Andric Villanueva
	 * @see ImageField
	 **/
	class Image extends File
	{
		/**
		 * The image's width in pixels.
		 **/
		public $width;

		/**
		 * The image's height in pixels.
		 **/
		public $height;

		/**
		 * Do something good.
		 * @param <type> $file_data 
		 */
		public function __construct($file_data)
		{
			parent::__construct($file_data);
			list($this->width, $this->height) = getimagesize($this->tmp_name);
		}
	}
