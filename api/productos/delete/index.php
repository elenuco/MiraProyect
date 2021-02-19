<?php
	session_start();
	$rut='../../';
	$action='productos.php';
	require_once($rut.'0code.php');

	if (isset($_POST['id_producto'])) {
		function validar($id_producto){
			$er=1;
			if (is_null($id_producto)) { $er=0; }
			if ($id_producto <= 0) { $er=0; }
			return $er;
		}

		$id_producto = $_POST['id_producto'];

		if (validar($id_producto) == 1) {
			require_once($rut.DIRACT.$action);
			$inf = eliminar($rut,$id_producto);

			header("Content-Type: application/json");
			echo $inf;
		}else{
			header("Content-Type: application/json");
			echo '[{';
				echo '"code": 404,';
				echo '"code": "Campos Vacios",';
				echo '"id_producto": "'.$id_producto.'"';
			echo '}]';
		}
	}