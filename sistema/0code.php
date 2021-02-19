<?php
	require_once($rut.'constant.php');

	$url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	if (isset($_REQUEST['p'])){ $pid=$_REQUEST['p']; }else{ $pid=0; }