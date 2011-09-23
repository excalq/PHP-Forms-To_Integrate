<?php

	/**
	 * OptionsField
	 *
	 * A selection of choices represented as a series of labeled checkboxes.
	 * @author Andric Villanueva
	 * @package Fields
	 **/
	class OptionsField extends MultipleChoiceField {
		/**
		 * Returns a new OptionGroupWidget.
		 * @author Andric Villanueva
		 * @return OptionGroupWidget
		 **/
		public function render() {
			return new OptionGroupWidget($this->options);
		}
	}