<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include('../seguridad.php');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_usuario=intval($_GET['id']);
		$query=mysqli_query($con, "select * from usuarios where id_usuario = '".$user_id." inner join roles on usuarios.id_rol = roles.id_rol'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['id_usuario'];
		if ($user_id!=1){
			if ($delete1=mysqli_query($con,"update set estado_usuario = 0 FROM usuarios WHERE id_usuario='".$user_id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos cambiados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede borrar el usuario administrador. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombres', 'apellidos');
		 $sTable = "usuarios";
		 $sTable1 = "roles";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by user_id desc";
		include 'pagination.php';
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		
		$count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './usuarios.php';
	
		$sql="SELECT * FROM  $sTable inner join $sTable1 on $sTable.id_rol = $sTable1.id_rol $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
	
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>ID</th>
					<th>Nombres</th>
					<th>Usuario</th>
					<th>Email</th>
					<th>Rol</th>
					<th>Estado</th>
					<th><span class="pull-right">Acciones</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_usuario = $row['id_usuario'];
						$nombres = $row['nombres']." ".$row["apellidos"];
						$nombre_usuario = $row['nombre_usuario'];
						$correo = $row['correo'];
						$id_rol = $row['descripcion'];
						$estado_usuario = $row['estado_usuario'];
						
					?>
					
					<input type="hidden" value="<?php echo $row['nombres'];?>" id="nombres<?php echo $id_usuario;?>">
					<input type="hidden" value="<?php echo $row['apellidos'];?>" id="apellidos<?php echo $id_usuario;?>">
					<input type="hidden" value="<?php echo $nombre_usuario;?>" id="usuario<?php echo $id_usuario;?>">
					<input type="hidden" value="<?php echo $correo;?>" id="email<?php echo $id_usuario;?>">
					<input type="hidden" value="<?php echo $id_rol;?>" id="descripcion<?php echo $id_usuario;?>">
				
					<tr>
						<td><?php echo $id_usuario; ?></td>
						<td><?php echo $nombres; ?></td>
						<td ><?php echo $nombre_usuario; ?></td>
						<td ><?php echo $correo; ?></td>
						<td><?php echo $id_rol; ?></td>
						<td><?php echo $estado_usuario; ?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?php echo $id_usuario;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?php echo $id_usuario;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class='btn btn-default' title='Borrar usuario' onclick="cambiar estado('<? echo $id_usuario; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>