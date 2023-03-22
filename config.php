<?php
	$ssl ='http';
	$hostname = 'localhost';
	$port = '8056';
	$dashboard_path = 'text_file_manipulate';

	$path = __DIR__.'\data';
	$filename = 'document.txt';

	$menu = array('note');
	$type = array('page', 'action');
	$action = array('read', 'write', 'overwrite', 'list', 'add', 'edit');
	

	$noteActionRead = array(
		'menu' => 0, 
		'type' => 1, 
		'action' => 0
	);
	$noteActionWrite = array(
		'menu' => 0, 
		'type' => 1, 
		'action' => 1
	);
	$noteActionOverwrite = array(
		'menu' => 0, 
		'type' => 1, 
		'action' => 2
	);

	$notePageList = array(
		'menu' => 0, 
		'type' => 0, 
		'action' => 3,
		'view'=> 'views/index.php'
	);
	$notePageAdd = array(
		'menu' => 0, 
		'type' => 0, 
		'action' => 4,
		'view'=> 'views/v_form_add.php'
	);
	$notePageEdit = array(
		'menu' => 0, 
		'type' => 0, 
		'action' => 5,
		'view'=> 'views/v_form_edit.php'
	);

	$menu_action = array($noteActionRead, $noteActionWrite, $noteActionOverwrite, $notePageList, $notePageAdd, $notePageEdit);
?>