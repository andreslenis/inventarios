	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nombres" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="apellidos" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre_usuario" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="correo" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="Rol" class="col-sm-3 control-label">Rol</label>
				<div class="col-sm-8">
					<select class='form-control' name='rol' id='rol' required>
						<option value="">Selecciona un rol</option>
							<?php 
							$query_rol=mysqli_query($con,"select * from roles order by descripcion");
							while($rw=mysqli_fetch_array($query_rol))	{
								?>
							<option value="<?php echo $rw['id_rol'];?>"><?php echo $rw['descripcion'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
			  <div class="form-group">
				<label for="contraseña" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="repetir_contraseña" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="repetir_contraseña" name="repetir_contraseña" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>
			 
			  

			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>