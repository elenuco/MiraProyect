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
		function callID($c1,$pid){
			$inf=null;
			$sql = "SELECT * FROM ".$this->table." WHERE id=".$pid." ;";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				if ($res->num_rows > 0) {
					while ($row = mysqli_fetch_array($res)) {
						$_SESSION['nombre'] = $row['nombre'];
						$_SESSION['descrip'] = $row['descrip'];
						$_SESSION['imagen'] = $row['imagen'];
					}
					$inf=true;
					mysqli_free_result($res);//liberar memoria del resultado
				}else{
					$inf=false;
				}
			}else{
				$inf=false;
			}

			mysqli_close($c1);
			return $inf;
		}
		function add($c1,$nombre_produto,$descripcion_producto,$imagen_precio,$precio_producto){
			$inf=null;$er=1;
			$sql="INSERT INTO ".$this->table." (nombre_produto, descripcion_producto, imagen_precio, precio_producto) VALUES ('".$nombre_produto."', '".$descripcion_producto."', '".$imagen_precio."', '".$precio_producto."');";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				$inf='[{"code":202, "mensaje": "Producto Guardado Correctamente."}]';
			}else{
				$inf='[{"code":404, "mensaje": "Error: '.$_SESSION['Mysqli_Error'].'."}]';
			}

			mysqli_close($c1);
			return $inf;
		}
		function edit($c1,$pid,$nombre,$descrip,$imagen,$updated_at){
			$inf=null;$er=1;
			$sql="UPDATE ".$this->table." SET nombre='".$nombre."', descrip='".$descrip."', imagen='".$imagen."', updated_at='".$updated_at."' WHERE ".$this->table_id."=".$pid." ;";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				$inf='edit';
			}else{
				$inf='noedit';
			}

			mysqli_close($c1);
			return $inf;
		}
		function acti($c1,$pid,$updated_at){
			$inf=null;$er=1;
			$sql="UPDATE ".$this->table." SET updated_at='".$updated_at."', status=1 WHERE ".$this->table_id."=".$pid." ;";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				$inf='acti';
			}else{
				$inf='noacti';
			}

			mysqli_close($c1);
			return $inf;
		}
		function desact($c1,$pid,$updated_at){
			$inf=null;$er=1;
			$sql="UPDATE ".$this->table." SET updated_at='".$updated_at."', status=0 WHERE ".$this->table_id."=".$pid." ;";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				$inf='desact';
			}else{
				$inf='nodesact';
			}

			mysqli_close($c1);
			return $inf;
		}
		function drop($c1,$pid,$drop_at){
			$inf=null;$er=1;
			$sql="UPDATE ".$this->table." SET drop_at='".$drop_at."', status=2 WHERE ".$this->table_id."=".$pid." ;";
			$res = mysqli_query($c1,$sql) OR $_SESSION['Mysqli_Error'] = (mysqli_error($c1));
			if ($res) {
				$inf='drop';
			}else{
				$inf='nodrop';
			}

			mysqli_close($c1);
			return $inf;
		}
	}