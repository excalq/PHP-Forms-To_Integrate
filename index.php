<?php

	//$guid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	//var_dump($guid);
	set_include_path(get_include_path()	. PATH_SEPARATOR .
					'forms'				. PATH_SEPARATOR .
					'forms/base'		. PATH_SEPARATOR .
					'forms/controls'	. PATH_SEPARATOR .
					'forms/misc'		. PATH_SEPARATOR .
					'forms/types'		. PATH_SEPARATOR .
					'forms/widgets'		. PATH_SEPARATOR .
					'forms/validators'	. PATH_SEPARATOR .
					'examples'			. PATH_SEPARATOR);
	
	require_once 'includes.php';
	require_once 'CommentForm.php';
	
	$form = new CommentForm('Test Comment Form', Form::POST);
	/*var_dump(array_keys($form->getFields()));
	exit(); //*/
	
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="examples/comment-form.css" />
	</head>
	
	<body>
		<? // HEADER OF ERRORS ?>
		<?php if ($form->has_errors()): ?>
		<p><b><u>There are errors</u></b></p>
		<?php endif ?>

		<?= $form->getUnformattedOutput() ?>
		<?= $form->report() ?>
	</body>
</html>
