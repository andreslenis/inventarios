<?PHP
	
		session_start();

		if (isset($_GET['logout'])) {
		$_SESSION = array();
			if (ini_get("session.use_cookies")) {
    			$params = session_get_cookie_params();
    			setcookie(session_name(), '', time() - 4,
        		$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]);
			}
        session_destroy();
        header("Location: ../login.php");
		} 

		if (!empty($_POST['usuario']) && !empty($_POST['pass'])) {

		mysql_connect('localhost', 'root', '');
		mysql_select_db('simple_stock');

		$user_name = mysql_real_escape_string($_POST['usuario']);

		$sql1 = "SELECT * FROM users 
				WHERE user_name = '".$user_name."';";

				$respuesta = mysql_query($sql1);

				if (mysql_num_rows($respuesta) == 0) {

					header("Location: ../login.php?error=si");

				} else {
					
					$resultado = mysql_fetch_array($respuesta);

						if (password_verify($_POST['pass'], $resultado['user_password_hash'])) {
								
								$_SESSION["autentificado"] = 'si';
								$_SESSION["user"] = $_POST['usuario'];
							
						}

						if ($resultado['id_rol'] == 3) {
										
							header("Location: stock_gerente.php");
									
						} elseif ($resultado['id_rol'] == 2) {
										
							header("Location: stock_distri.php");
									
						} elseif ($resultado['id_rol'] == 1) {
							
							header("Location: dashboard.php");
						}
						
				}

	
	}

?>