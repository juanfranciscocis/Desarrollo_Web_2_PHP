<?php



	if (!isset($_COOKIE["visita"])) {
		setcookie("visita", "1", time() + 3600);
	} else {
		$visita = $_COOKIE["visita"];
		$visita++;
		setcookie("visita", $visita, time() + 3600);
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
</head>
<body>
	<?php
		if(isset($_COOKIE["visita"]) && $_COOKIE["visita"]>=2){
			?>
			<h1>Tenemos un descuento para ti en nuestros cursos de:</h1>
			<ul>
				<li><a href="./cookies2.php">PHP</a> </li>
				<li>Java</li>
				<li>Python</li>
				<li>C++</li>
			</ul>
			<?php

        }else{
			?>
			<h1>Este es el listado de cursos en linea</h1>
			<ul>
				<li><a href="./cookies2.php">PHP</a> </li>
				<li>Java</li>
				<li>Python</li>
				<li>C++</li>
			</ul>
			<?php

		}
        if(isset($_COOKIE["curso"]) && $_COOKIE["curso"]=="PHP"){
			?>
			<h2>Accede de forma gratiuita a nuestro curso de PHP</h2>
	        <p><a href="cookies2.php">Acceder</a></p>
			<?php
        }


	?>





</body>
</html>