<?php

	//make api call to get all products
	$url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/productos.php';
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
	<link rel="stylesheet" href="style/home/header.css">
	<link rel="stylesheet" href="style/home/content.css">
</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger">
			<img src="images/home/header/icon-control-menu.png" alt="">
		</div>
		<div class="logo">
			<img src="images/home/header/logo.png" alt="">
		</div>
		<div class="cart">
			<img src="images/home/header/icon-shopping-cart.png" alt="">
		</div>
		<div class="person">
			<img src="images/home/header/icon-control-person.png" alt="">
		</div>
	</div>
	<div>
		<div class="search">
			<label class="search-label">
				<input class="search-input" type="text" placeholder="🔎    Search">
			</label>
		</div>
	</div>
</div>

<div class="content">


<?php
	//Dynamic content based on the amount of products from the api
	$products = count($data['message']);

	for ($i=0; $i< $products; $i++) {
        echo '<section id=' . $data['message'][$i]['id_producto'] . '>
		<div class="product">
			<div class="img-product">
				<img src='.$data['message'][$i]['img_principal'].' alt="">
			</div>
			<div class="descrip-product">
				<h1>' . $data['message'][$i]['nombre'] . '</h1>
				<p>$ ' . $data['message'][$i]['precio'] . '</p>
				<p class="free">Free Shipping</p>
			</div>
		</div>
		</section>
		<br>';
        //if a section is clicked, it will redirect to the product page
        echo '<script>
		document.getElementById("' . $data['message'][$i]['id_producto'] . '").addEventListener("click", function(){
			window.location.href = "view/product.php?id=' . $data['message'][$i]['id_producto'] . '";
		});
		</script>';
    }


?>




</div>
</body>
</html>

