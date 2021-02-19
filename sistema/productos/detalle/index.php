<?php
	session_start();
	$rut='../../';
	require_once($rut.'0code.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	
	<?php
		if ($pid > 0) {
		}else{
			header("Location: ../");
			exit();
		}
	?>
</head>
<body onload="callID(<?= $pid; ?>)">

	<div class="container pt-4">
		<div class="row pt-4 pb-4">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<h3 class="title">Deatelle del Producto</h3>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
		<div class="row pt-4">
			<div class="container pt-4">
				<form id="formUpload" class="row" method="POST" enctype="multipart/form-data" >
					<div class="col-sm-12">
						<div class="form-group">
		      				<label class="form-control-label">Nombre del Producto:</label>
		      				<input type="text" class="form-control" id="nombre_produto" name="nombre_produto">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
		      				<label class="form-control-label">Descripción:</label>
		      				<textarea class="form-control" id="descripcion_producto" name="descripcion_producto"></textarea>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
		      				<label class="form-control-label">Imagen:</label>
		      				<input type="file" class="form-control" id="imagen_precio" name="imagen_precio">
		      				<div id="imagen" style="height: 90px;"></div>
		      				<input type="hidden" class="form-control" id="act_imagen_precio" name="act_imagen_precio" readonly="readonly">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
		      				<label class="form-control-label">Precio:</label>
		      				<input type="number" class="form-control" step="0.01" id="precio_producto" name="precio_producto">
						</div>
					</div>
					<div class="col-sm-12 pt-3">
						<div class="form-group">
		        			<a href="../" class="btn btn-secondary">Regresar</a>
		        			<input type="hidden" id="id_producto" name="id_producto" value="<?= $pid; ?>">
		        			<input type="hidden" name="url" value="<?= $url; ?>">
		        			<button type="submit" id="nuevo" name="nuevo" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

	<script>
		function callID(id){
			$.ajax({
				type: "POST",
				url: "https://localhost/MiraProyect/api/productos/callID/index.php",
				data: { callID: "callID", id_producto: id },
			}).done(function(data) {
				//console.log(data);
				$("#nombre_produto").val(data[0].nombre_produto);
				$("#descripcion_producto").val(atob(data[0].descripcion_producto));
				$("#act_imagen_precio").val(data[0].imagen_precio);
				$("#imagen").html('<label class="form-control-label">Imagen Actual:</label><img src="../<?= $rut; ?>img/'+data[0].imagen_precio+'" class="img-thumbnail" style="height: 90px !important;">');
				$("#precio_producto").val(data[0].precio_producto);
				return false;
			});
			return false;
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$("#formUpload").on('submit', function(e){
			$("#exampleModal").modal('hide');
			e.preventDefault();
			$.ajax({
				url: "https://localhost/MiraProyect/api/productos/update/index.php",
				type: 'POST',
				//type: 'multipart/form-data',
				//method: "POST",
				data: new FormData(this),
            	contentType: false,
				cache: false,
				processData:false,
			}).done(function(data) {
				console.log(data);
				callID(<?= $pid; ?>);

				$("#nombre_produto").val('');
				$("#descripcion_producto").val('');
				$("#imagen_precio").val('');
				$("#precio_producto").val('');
				return false;
			});
			return false;
		});
	</script>
</body>
</html>