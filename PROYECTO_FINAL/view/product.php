<?php
	session_start();
	//start cookies
	$_SESSION["usuario"] =1;
	if (isset($_SESSION["usuario"])) {
		$usuario = $_SESSION["usuario"];
		if (isset($_SESSION["session"])){
			$session = $_SESSION["session"];
		}else{
			$session = rand(100000, 999999);
            $_SESSION["session"] = $session;
			setcookie("session", $session, time() + (86400 * 30));

			//create cart
			$url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/crear_carrito.php?id_sesion=' . $session . '&id=' . $usuario;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			$data = json_decode($response, true);
			//echo response
			echo '<script>console.log(' . $data['message'] . ')</script>';
		}
	}   else{
		//redirect login
		header("Location: ../view/login.php");
	}

	// js scripts
	echo '<script >
		function goHome(){
			window.location.href = "../index.php";
		}
	</script>';

	echo '<script>
		function addToCart(id){
			window.location.href = "../controller/cart.php?id=" + id;
		}
	</script>';




	$id = $_GET['id'];
	//Dynamic content based on the amount of products from the api
	//Api call
	$url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/productos.php?id=' . $id;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($response, true);



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MacResaleHub</title>
	<link rel="stylesheet" href="../style/products/header.css">
	<link rel="stylesheet" href="../style/products/products.css">

</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger" onclick="goHome()">
			<img src="../images/product/header/icon-return.png" alt="">
		</div>
		<div class="cart">
			<img src="../images/product/header/icon-shopping-cart.png" alt="">
		</div>
		<div class="person">
			<img src="../images/product/header/icon-control-person.png" alt="">
		</div>
	</div>
</div>

<div class="imagen-producto">
	<img class="imagen" src="../<?php echo $data['message']['img_principal'] ?>" alt="">
</div>

<div class="descrip-card">
	<div class="descrip">
		<h1> <?php echo $data['message']['nombre'] ?> </h1>
		<h2> $ <?php echo $data['message']['precio'] ?> </h2>
		<br>
		<div class="add-to-cart">
			<h1 onclick="addToCart(<?php echo $data['message']['id_producto'] ?>)">🛒 ADD TO CART</h1>
		</div>
	</div>
</div>
</body>
</html>
