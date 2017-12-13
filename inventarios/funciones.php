<?php 
function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}
	
}
function agregar_stock($id_producto,$quantity, $usuario){
	global $con;
	$update=mysqli_query($con,"update inv set inv.cantidad_inventario = inv.cantidad_inventario +'$quantity' from inventarios inv inner join productos pro on inv.id_inventario = pro.id_inventario where id_producto='$id_producto'");
	if ($update){
			return 1;
	} else {
		return 0;
	}	
		
}

function eliminar_stock($id_producto,$quantity){
	global $con;
	$update=mysqli_query($con,"update inv set inv.cantidad_inventario = inv.cantidad_inventario -'$quantity' from inventarios inv inner join productos pro on inv.id_inventario = pro.id_inventario where id_producto='$id_producto'");
	if ($update){
			return 1;
	} else {
		return 0;
	}	
		
}

?>