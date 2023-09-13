
<?php
	//variables
	$nombre = "Juan"; //string
	$apellido = "Perez"; //string
	$edad = 21; //int
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Variables con PHP</title>
</head>
<body>
	<h1>Bienvenido</h1>
	<h2>
		<?php
			echo $nombre;
		?>
	</h2>
	<h2>
		<?php
			echo $apellido;
		?>
	</h2>
	<h3>
		Tu edad es:
		<?php
			echo $edad;
		?>
	</h3>
	<p>
		<?php
			echo "Tu nombre es: ".$nombre." ".$apellido." y tu edad es: ".$edad;
			echo "<br>";
			echo "Mi edad es: ".$edad." años";
		?>
	</p>
</body>
</html>