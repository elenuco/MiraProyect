<?php
	session_start();
	$rut='../';
	$action='productos.php';
	require_once($rut.'0code.php');
	require_once($rut.DIRACT.$action);
	$inf = index($rut);

	header("Content-Type: application/json");
	echo $inf;