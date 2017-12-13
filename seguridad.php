<?PHP
	//Inicio la sesión
	session_start();

	//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
	if ($_SESSION["user_login_status"] = 0 ) {
		//si no existe, se dirige a la Página de Inicio
		header("Location: login.php");
		//salimos del script
		exit();
	}	
	
?>