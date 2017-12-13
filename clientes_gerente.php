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
	include("navbar_gerente.php");
	?>

	<div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<!--<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Agregar</button>-->
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Distribuidores</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/registro_productos_distri.php");
			include("modal/editar_productos_distri.php");
			include("footer.php");
			?>
</body>
</html>