<?php

	/**
	 * ValidationError
	 *
	 * Thrown when a Field.php';'s data fails to validate.
	 * @author Andric Villanueva
	 * @package Field.php';s
	 **/
	class ValidationError extends Exception { }

	// Include the base classes/files
	require_once 'interface.FormControl.php';
	require_once 'interface.validators.php';
	require_once 'interface.Form.php';
	
	require_once 'abstract.form.php';
	require_once 'abstract.FormField.php';
	require_once 'abstract.FormWidget.php';
	require_once 'abstract.validation.php';

	// Include all the fields
	require_once 'TextField.php';
	require_once 'BooleanField.php';
	require_once 'DateTimeField.php';
	require_once 'DecimalField.php';
	require_once 'DropDownField.php';
	require_once 'EmailField.php';
	require_once 'FileField.php';
	require_once 'HiddenField.php';
	require_once 'ImageField.php';
	require_once 'IntegerField.php';
	require_once 'TextareaField.php';
	require_once 'MultipleChoiceField.php';
	require_once 'OptionsField.php';
	require_once 'PasswordField.php';
	require_once 'RegexField.php';
	require_once 'ScanField.php';
	require_once 'URLField.php';
	require_once 'ButtonField.php';
	require_once 'SubmitField.php';

	// Now include all the widgets
	require_once 'TextareaWidget.php';
	require_once 'CharWidget.php';
	require_once 'CheckboxWidget.php';
	require_once 'FileWidget.php';
	require_once 'HiddenWidget.php';
	require_once 'MultiSelectWidget.php';
	require_once 'OptionGroupWidget.php';
	require_once 'PasswordWidget.php';
	require_once 'RadioWidget.php';
	require_once 'SelectWidget.php';
	require_once 'ButtonWidget.php';

	// Include the validators
	require_once 'Required.php';
	require_once 'Url.php';
	require_once 'Integer.php';
	require_once 'Float.php';
	require_once 'Length.php';
	
