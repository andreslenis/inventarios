<?php
include ("../seguridad.php");
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['nombres'])){
			$errors[] = "Nombres vacíos";
		} elseif (empty($_POST['apellidos'])){
			$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['nombre_usuario'])) {
            $errors[] = "Nombre de usuario vacío";
        } elseif (empty($_POST['contraseña']) || empty($_POST['repetir_contraseña'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['contraseña'] !== $_POST['repetir_contraseña']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        } elseif (strlen($_POST['contraseña']) < 6) {
            $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
        } elseif (strlen($_POST['nombre_usuario']) > 64 || strlen($_POST['nombre_usuario']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['nombre_usuario'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        } elseif (empty($_POST['correo'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['correo']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['nombre_usuario'])
			&& !empty($_POST['nombres'])
			&& !empty($_POST['apellidos'])
            && strlen($_POST['nombre_usuario']) <= 64
            && strlen($_POST['nombre_usuario']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['nombre_usuario'])
            && !empty($_POST['correo'])
            && strlen($_POST['correo']) <= 64
            && filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['contraseña'])
            && !empty($_POST['repetir_contraseña'])
            && ($_POST['contraseña'] === $_POST['repetir_contraseña'])
        ) {
            require_once ("../config/db.php");
			require_once ("../config/conexion.php");
			
                $nombres = mysqli_real_escape_string($con,(strip_tags($_POST["nombres"],ENT_QUOTES)));
				$apellidos = mysqli_real_escape_string($con,(strip_tags($_POST["apellidos"],ENT_QUOTES)));
				$nombre_usuario = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_usuario"],ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
				$contraseña = $_POST['contraseña'];
                $rol = mysqli_real_escape_string($con,(strip_tags($_POST["rol"],ENT_QUOTES)));
				$user_password_hash = password_hash($contraseña, PASSWORD_DEFAULT);
                $estado_usuario = 1;					

                $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '" . $nombre_usuario . "' OR correo = '" . $correo . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , el nombre de usuario ó la dirección de correo electrónico ya está en uso.";
                } else {
					
                    $sql = "INSERT INTO usuarios (nombres, apellidos, nombre_usuario, contraseña, correo, id_rol, estado_usuario)
                            VALUES('".$nombres."','".$apellidos."','" . $nombre_usuario . "', '" . $contraseña . "', '" . $correo . "','".$rol."','".$estado_usuario."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    if ($query_new_user_insert) {
                        $messages[] = "La cuenta ha sido creada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                }
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>