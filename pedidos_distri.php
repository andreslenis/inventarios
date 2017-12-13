<?php

	include ("seguridad.php");
	require_once ("config/db.php");
	require_once ("config/conexion.php");

	$active_hacer_pedidos="active";
	$title="Inventario | Simple Stock";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar_distri.php");
	?>

	<div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<!--<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Agregar</button>-->
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Hacer Pedido</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/registro_productos_distri.php");
			include("modal/editar_productos_distri.php");
			?>
			<!--<form class="form-horizontal" role="form" id="datos">
				
						
				<div class="row">
					<div class='col-md-4'>
						<label>Filtrar por código o nombre</label>
						<input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
					</div>
					
					<div class='col-md-4'>
						<label>Filtrar por categoría</label>
						<select class='form-control' name='id_categoria' id='id_categoria' onchange="load(1);">
							<option value="">Selecciona una categoría</option>-->
							<?php/*
							$query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
							while($rw=mysqli_fetch_array($query_categoria))	{
								?>
							<option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option>			
								<?php*/
							}
							?>
						<!--</select>
					</div>
					<div class='col-md-12 text-center'>
						<span id="loader1"></span>
					</div>
				</div>
				<hr>
				<div class='row-fluid'>
					<div id="resultados"></div>--><!-- Carga los datos ajax -->
				<!--</div>	
				<div class='row'>
					<div class='outer_div'></div>--><!-- Carga los datos ajax -->
				<!--</div>
			</form>	
			
  </div>
</div>
		 
	</div>
	<hr>-->
	<?php
	include("footer.php");
	?>
	<!--<script type="text/javascript" src="js/pedidos.js"></script>
  </body>
</html>
<script>
function eliminar (id){
		var q= $("#q").val();
		var id_categoria= $("#id_categoria").val();
		$.ajax({
			type: "GET",
			url: "./ajax/buscar_productos_pedidos.php",
			data: "id="+id,"q":q+"id_categoria="+id_categoria,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			load(1);
			}
		});
	}
		
	$(document).ready(function(){-->
			
		<?php/*
			if (isset($_GET['delete'])){
		*/?><!--
			eliminar(<?php echo intval($_GET['delete'])?>);	
		<?php/*
			}
		
		?>	
	});
		
$( "#guardar_producto_pedidos" ).submit(function( event ) {
  $('#guardar_datos_pedidos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_producto_pedido.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos_pedidos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

</script>