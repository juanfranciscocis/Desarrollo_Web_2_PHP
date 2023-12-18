<?php

    //go to home
    echo '<script>
        function goHome(){
            window.location.href = "../index.php";
        }
    </script>';

	//on login -> controller login
	echo '<script>
		function goToLogin(){
			//get values
			const email = document.getElementById("email-login").value;
			const password = document.getElementById("password-login").value;	
			//post values to controller login
			const data = {usuario: email, password: password};
			//post data
			fetch("http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/validar.php", {
				method: "POST",
				body: JSON.stringify(data),
				headers: {"Content-type": "application/json; charset=UTF-8"}
			}).then(response => response.json())
			.then(data => {
				console.log(data);
				if(data.success == 1){
					//set session
					const id = data.usuario.id_usuario;
					window.location.href = "../controller/login_controller.php?id=" + id;
				}else{
					alert("Usuario o contraseña incorrectos");
				}
			})
		
		}
	</script>';

	//on register -> controller register
	echo '<script>
		function goToRegister(){
			//get values
			const name = document.getElementById("name-register").value;
			const lastname = document.getElementById("lastname-register").value;
			const email = document.getElementById("email-register").value;
			const password = document.getElementById("password-register").value;
			const phone = document.getElementById("phone-register").value;
			//post data
			const data = {usuario: email, password: password, nombre: name, apellido: lastname, telefono: phone};
			fetch("http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/crear_usuario.php", {
				method: "POST",
				body: JSON.stringify(data),
				headers: {"Content-type": "application/json; charset=UTF-8"}
			}).then(response => response.json())
			.then(data => {
				console.log(data);
				if(data.success == 1){
					alert("Usuario creado exitosamente, por favor inicie sesión");
				}else{
					alert("Ocurrió un error, por favor intente de nuevo");
				}
			})
		}
	</script>';




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacResaleHub</title>
    <link rel="stylesheet" href="../style/login/header.css">
	<link rel="stylesheet" href="../style/login/content.css">

</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger" onclick="goHome()">
			<img src="../images/product/header/icon-return.png" alt="">
		</div>
	</div>
</div>

<div>
	<div class="login-logo">
		<img src="../images/login/content/logo.png" alt="">
	</div>
	<div class="login">
		<h1>Login</h1>
		<div class="login-div">
			<label for="email-login">
			<input type="text" name="email-login" id="email-login" placeholder="Email">
			</label>
			<label for="password-login">
			<input type="password" name="password-login" id="password-login" placeholder="Password">
			</label>
		</div>
		<div class="log">
			<div class="login-button" onclick="goToLogin()">
				<h2>Log in</h2>
			</div>
		</div>
	</div>
	<div class="register">
		<h1>Register</h1>
		<div class="register-div1">
			<label for="name-register" class="small">
			<input type="text" name="name-register" id="name-register" placeholder="Name" class="small-inpl">
			</label>
			<label for="lastname-register" class="small">
			<input type="text" name="lastname-register" id="lastname-register" placeholder="Lastname" class="small-inpl">
			</label>
		</div>
		<div class="register-div">
			<label for="email-register">
			<input type="text" name="email-register" id="email-register" placeholder="Email">
			</label>
			<label for="password-register">
			<input type="password" name="password-register" id="password-register" placeholder="Password">
			</label>
			<label for="phone-register">
			<input type="text" name="phone-register" id="phone-register" placeholder="Phone">
			</label>
		</div>
		<div class="reg">
			<div class="register-button" onclick="goToRegister()">
				<h2>Register</h2>
			</div>
		</div>
	</div>
</div>

</body>
</html>

