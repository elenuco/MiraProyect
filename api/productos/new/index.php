<?php
	session_start();
	$rut='../../';
	$action='productos.php';
	require_once($rut.'0code.php');

	if (isset($_POST['nuevo'])) {
		function validar($nombre_produto,$precio_producto){
			$er=1;
			if (is_null($nombre_produto)) { $er=0; }
			if (strlen($nombre_produto) <= 3) { $er=0; }
			if (is_null($precio_producto)) { $er=0; }
			if (strlen($precio_producto) <= 1) { $er=0; }
			return $er;
		}

		$url = $_POST['url'];
		$nombre_produto = $_POST['nombre_produto'];
		$descripcion_producto = $_POST['descripcion_producto'];

		$nombfile=$_FILES["imagen_precio"]["name"];
		$taman=$_FILES["imagen_precio"]["size"];
		$type=$_FILES["imagen_precio"]["type"];
		$destino= '../'.$rut."img/";
		$imagen_precio=date("YmdHis").$nombfile;
		move_uploaded_file($_FILES["imagen_precio"]["tmp_name"], $destino.$imagen_precio);

		$precio_producto = $_POST['precio_producto'];

		if (validar($nombre_produto,$precio_producto) == 1) {
			require_once($rut.DIRACT.$action);
			$inf = nuevo($rut,$nombre_produto,$descripcion_producto,$imagen_precio,$precio_producto);

			header("Content-Type: application/json");
			echo $inf;

			header("Location: ".$url);
			exit();
		}else{
			header("Content-Type: application/json");
			echo '[{';
				echo '"code": 404,';
				echo '"code": "Campos Vacios",';
				echo '"nombre_produto": "'.$nombre_produto.'",';
				echo '"descripcion_producto": "'.$descripcion_producto.'",';
				echo '"imagen_precio": "'.$imagen_precio.'",';
				echo '"precio_producto": '.$precio_producto.'4"';
			echo '}]';
		}
	}