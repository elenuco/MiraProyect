<?php
	session_start();
	$rut='../';
	require_once($rut.'0code.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body onload="listar()">

	<div class="container pt-4">
		<div class="row pt-4 pb-4">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<h3 class="title">Productos</h3>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Nuevo Producto
				</button>
			</div>
		</div>
		<div class="row pt-4">
			<div class="col-sm-12 pt-4">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Imagen</th>
							<th>Precio</th>
						</tr>
					</thead>
					<tbody id="result"></tbody>
				</table>
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<!--<form id="formUpload" method="POST" action="https://localhost/MiraProyect/api/productos/new/index.php" enctype="multipart/form-data">-->
	    	<form id="formUpload" method="POST" enctype="multipart/form-data">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<div class="form-group">
		      		<label class="form-control-label">Nombre del Producto:</label>
		      		<input type="text" class="form-control" id="nombre_produto" name="nombre_produto">
		      	</div>
		      	<div class="form-group">
		      		<label class="form-control-label">Descripción:</label>
		      		<textarea class="form-control" id="descripcion_producto" name="descripcion_producto"></textarea>
		      	</div>
		      	<div class="form-group">
		      		<label class="form-control-label">Imagen:</label>
		      		<input type="file" class="form-control" id="imagen_precio" name="imagen_precio">
		      	</div>
		      	<div class="form-group">
		      		<label class="form-control-label">Precio:</label>
		      		<input type="number" class="form-control" step="0.01" id="precio_producto" name="precio_producto">
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <input type="hidden" name="url" value="<?= $url; ?>">
		        <button type="submit" id="nuevo" name="nuevo" class="btn btn-primary">Guardar</button>
		      </div>
	    	</form>
	    </div>
	  </div>
	</div>

	<script>
		function listar(){
			let html;
			let count=1;

			$.ajax({
				url: "https://localhost/MiraProyect/api/productos/",
				type: "json",
			}).done(function(data) {
				//console.log(data);
				$.each(data, function( index, value ) {
					html += '<tr>';
						$.each(value, function( index2, value2 ) {
							//console.log( index2 + ": " + value2 );

							if (count==1) {
								html += '<td>';
								html += '<a href="detalle/?p='+ value2+'" class="btn btn-outline-warning">Detalle</a></td> ';
								html += '</td>';
							}
							if (index2 == 'imagen_precio') {
								html += '<td><img src="../<?= $rut; ?>img/'+value2+'" alt="'+value2+'" class="img-thumbnail" style="height: 90px !important;"></td>';
							}else if(index2 == 'id_producto'){
								html += '<td>';
									html += value2+' ';
									html += '<a href="#" id="btnEliminar" onclick="eliminar('+value2+')" class="btn btn-outline-danger">Eliminar</a>';
								html += '</td>';
							}else if(index2 == 'descripcion_producto'){
								html += '<td>'+atob(value2)+'</td>';
							}else{
								html += '<td>'+ value2+'</td>';
							}
							count++;
						});
						count=1;
					html += '</tr>';
				});
				$("#result").html(html);
			});
		}
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$("#formUpload").on('submit', function(e){
			$("#exampleModal").modal('hide');
			e.preventDefault();
			$.ajax({
				url: "https://localhost/MiraProyect/api/productos/new/index.php",
				type: 'POST',
				//type: 'multipart/form-data',
				//method: "POST",
				data: new FormData(this),
            	contentType: false,
				cache: false,
				processData:false,
			}).done(function(data) {
				console.log(data);
				listar();

				$("#nombre_produto").val('');
				$("#descripcion_producto").val('');
				$("#imagen_precio").val('');
				$("#precio_producto").val('');
				return false;
			});
			return false;
		});
	</script>
	<script>
		function eliminar(id){
			$.ajax({
				type: 'POST',
				url: "https://localhost/MiraProyect/api/productos/delete/index.php",
				data: { drop: "drop", id_producto: id },
			}).done(function(data) {
				console.log(data);
				listar();
				return false;
			});
			return false;
		};
	</script>
</body>
</html>