<?php
	echo '<script>
		const goHome = () => {
			window.location.href = "/Desarrollo_Web_2_PHP/PROYECTO_FINAL/";
		}
	</script>';







?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MacResaleHub</title>
	<link rel="stylesheet" href="../style/error_cart/header.css">
	<link rel="stylesheet" href="../style/error_cart/error.css">
</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger" onclick="goHome()">
			<img src="../images/error_cart/header/icon-return.png" alt="">
		</div>
	</div>
</div>
<div class="content">
	<div class="confirmation-img">
		<div>
			<img src="../images/error_cart/error/error.png" alt="">
		</div>
	</div>
	<div class="confirmation-text">
		<h2>Please Add</h2>
		<h2>items to your</h2>
		<h2>cart</h2>
	</div>

</div>





</body>
</html>