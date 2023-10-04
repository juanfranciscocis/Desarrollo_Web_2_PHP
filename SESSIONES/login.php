
<?php

	session_start(); // Habilitamos la Session

	//variable para validar el usuario
	$autenticado = false;

	//validar varibale de session de autenticacion
	if(array_key_exists("autenticado", $_SESSION)){
		$autenticado = true;
	} else {
		if(isset($_POST["submit"])){
			$user = '';
			$password = '';
			if (array_key_exists('usuario', $_POST)) {
				$user = $_POST['usuario'];
			}
			if (array_key_exists('password', $_POST)) {
				$password = $_POST['password'];
			}
			//validar usuario y password
 			if($user == "abc" && $password == "123"){
				//guardar las variables de session
				$_SESSION["autenticado"] = true;
				$autenticado = true;
				$_SESSION["usuario"] = $user;
				$_SESSION["autorizado"] = "si";
			} else {
				echo "Usuario o Password Incorrectos";
			}
		}
	}

	//redireccionar si el usuario esta autenticado (PAGINA PRIVADA)
	if($autenticado){
		header("Location: privada.php");
		exit();
	}else{


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login con PHP</title>
</head>
<body>
	<h1>Iniciar Session</h1>
	<form method="post">

		<input type="text" name="usuario" id="usuario" placeholder="ingresa tu usuario">
		<input type="password" name="password" id="password" placeholder="ingresa tu password">
		<input type="submit" name="submit" value="Iniciar Session">

	</form>

</body>
</html>
<?php
	}
?>