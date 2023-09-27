<?php
	session_start(); // Habilitamos la Session
	if(isset($_SESSION["visitas"])) {
        $_SESSION["visitas"]++;
    }else {
		$_SESSION["visitas"] = 1;
	}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contador de Visitas PHP</title>
</head>
<body>
	<h1>Visitas Totales</h1>
	<p>Has visto esta pagina:</p>
	<h2>
		<?php
			echo $_SESSION["visitas"];
		?>
	</h2>

</body>
</html>