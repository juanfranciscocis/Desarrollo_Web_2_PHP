<?php
	echo '<script>
		const goHome = () => {
			window.location.href = "../index.php";
		}


		function checkout(total,user){
			// get values
			const address = document.getElementById("address").value;
			const city = document.getElementById("city").value;
			const country = document.getElementById("country").value;
			
			//validate values
			if(address == "" || city == "" || country == ""){
				alert("Please fill all the fields");
				return;
			}
			
			//api call
			const url = "http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/orden.php?id_usuario=" + user + "&direccion=" + address + "&ciudad=" + city + "&pais=" + country + "&total=" + total;
			console.log(url);
			const xhttp = new XMLHttpRequest();
			xhttp.open("GET", url, true);
			xhttp.send();
			
			//save id_orden as a session variable
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 201) {
					const data = JSON.parse(this.responseText);
					console.log(data);
					const id_orden = data.id_orden;
					console.log(id_orden);
					window.location.href = "confirmation.php?id_orden=" + id_orden;
				}
			};
			
		}
	</script>';

	session_start();
	$id_sesion = $_SESSION['id_sesion'];
	$user = $_SESSION['usuario'];

	function debug_to_console($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
	}
	//api call
	$url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/ver_carrito.php?id=' . $id_sesion;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$data = json_decode($response, true);

	//if no data redirect to error page
	if($data['success'] == 0){
		header("Location: error_cart.php");
	}

	//debug_to_console($data['message'][0]['img_principal']);

	function calc_total($data){
		$total = 0;
		$products = count($data['message']);
		for ($i=0; $i< $products; $i++) {
			$total = $total + $data['message'][$i]['precio'];
		}
		return $total;
	}
	$total = calc_total($data);
	$_SESSION['total'] = $total;








?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MacResaleHub</title>
	<link rel="stylesheet" href="../style/cart/header.css">
	<link rel="stylesheet" href="../style/cart/cart.css">
	<link rel="stylesheet" href="../style/cart/checkout.css">
</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger" onclick="goHome()">
			<img src="../images/cart/header/icon-return.png" alt="">
		</div>
	</div>
</div>
<div class="content">


    <?php
    //Dynamic content based on the amount of products from the api $data
    $products = count($data['message']);
    for ($i=0; $i< $products; $i++) {
        echo '<section id= "' . $i . '">
		<div class="product">
			<div class="img-product">
				<img src="../' . $data['message'][$i]['img_principal'] . '" alt="">
			</div>
			<div class="descrip-product">
				<h1>' . $data['message'][$i]['nombre'] . '</h1>
				<p>$ ' . $data['message'][$i]['precio'] . '</p>
				<p class="free">Free Shipping</p>
			</div>
		</div>
		</section>
		<br>';
		//on click remove from cart
        		echo '<script>
							//on click remove from cart
							document.getElementById("' . $i . '").addEventListener("click", function(){
								//api call
								const url = "http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/eliminar_item.php?id_producto=' . $data['message'][$i]['id_producto'] . '&id=' . $id_sesion . '";
								console.log(url);
								const xhttp = new XMLHttpRequest();
								xhttp.open("GET", url, true);
								xhttp.send();
								
								//reload page
								xhttp.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										window.location.reload();
									}
								};
								
							});
							
						</script>';
					}

    ?>
</div>

<div class="summary">
	<div class="total">
		<h1>Total</h1>
		<p class="price">$ <?php echo $total ?></p>
	</div>
</div>

<div class="summary">
	<div class="direction">
		<h1>Shipping Address</h1>
		<label>
			<input type="text" name="address" placeholder="Address" id="address">
		</label>
		<label>
			<input type="text" name="city" placeholder="City" id="city">
		</label>
		<label>
			<input type="text" name="country" placeholder="Country" id="country">
		</label>
	</div>
</div>



<div class="summary">
	<div class="checkout">
			<h1 onclick="checkout(<?php echo $total ?>, <?php echo $user ?>)">Checkout</h1>
	</div>
</div>




</body>
</html>

