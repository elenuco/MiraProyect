<?php
	/**
	 * 
	 */
	class productos extends database
	{
		private $table ='productos';
		private $table_id='id_producto';
		
		function listar($c1){
			$inf=null;$n=1;
			$sql = "SELECT * FROM ".$this->table.";";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			$inf.='[';
				if ($res) {
					if ($res->num_rows > 0) {
						while ($row = mysqli_fetch_array($res)) {
							$inf.='{';
								$inf.='"id_producto": '.$row['id_producto'].',';
								$inf.='"nombre_produto": "'.$row['nombre_produto'].'",';
								$inf.='"descripcion_producto": "'.$row['descripcion_producto'].'",';
								$inf.='"imagen_precio": "'.$row['imagen_precio'].'",';
								$inf.='"precio_producto": '.$row['precio_producto'].',';
							$inf = substr($inf, 0, -1).'},';
						}
						mysqli_free_result($res);
						$row=null;
					}else{
						$inf.='{';
							$inf.='"id_producto": 0,';
							$inf.='"nombre_produto": "NULL",';
							$inf.='"descripcion_producto": "NULL",';
							$inf.='"imagen_precio": "NULL",';
							$inf.='"precio_producto": "NULL"';
						$inf.='},';
					}
				}else{
					$inf.='{';
						$inf.='"id_producto": 0,';
						$inf.='"nombre_produto": "ERROR",';
						$inf.='"descripcion_producto": "ERROR: '.$_SESSION['Mysqli_Error'].'",';
						$inf.='"imagen_precio": "ERROR",';
						$inf.='"precio_producto": "ERROR"';
					$inf.='},';
				}
			$inf = substr($inf, 0, -1).']';

			mysqli_close($c1);
			return $inf;
		}
	}