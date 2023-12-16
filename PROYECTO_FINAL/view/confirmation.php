<?php
	echo '<script>
		const goHome = () => {
			window.location.href = "/Desarrollo_Web_2_PHP/PROYECTO_FINAL/";
		}
	</script>';

	session_start();
	if (isset($_GET['id_orden'])) {
        $id_orden = $_GET['id_orden'];
	}else{
		header("Location: /Desarrollo_Web_2_PHP/PROYECTO_FINAL/");
	}

	if(isset($_SESSION['id_sesion'])){
		$id_sesion = $_SESSION['id_sesion'];
	}else{
		header("Location: /Desarrollo_Web_2_PHP/PROYECTO_FINAL/");
    }


	function debug_to_console($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
	}

	//api call
	$url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/item_orden.php?id_sesion=' . $id_sesion . '&id_orden=' . $id_orden;
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
	<link rel="stylesheet" href="../style/confirmation/header.css">
	<link rel="stylesheet" href="../style/confirmation/confirmation.css">
</head>

<body>
<div class="header-div">
	<div class="header-1">
		<div class="burger" onclick="goHome()">
			<img src="../images/confirmation/header/icon-return.png" alt="">
		</div>
	</div>
</div>
<div class="content">
	<div class="confirmation-img">
		<div>
			<img src="../images/confirmation/confirmation/confirmation.png" alt="">
		</div>
	</div>
	<div class="confirmation-text">
		<h2>A MacResaleHub</h2>
		<h2>rep will contact you</h2>
		<h2>soon!</h2>
	</div>

</div>





</body>
</html>