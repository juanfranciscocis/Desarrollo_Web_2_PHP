<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DEBER 3</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap" rel="stylesheet">

</head>
<body>

	<?php
		require "script.php"
	?>
	<table class="table table-striped table-hover table-dark table-bordered pad">
		<thead class="thead-dark">
		<tr>
			<th class="text-center fonts" scope="col">#</th>
			<th class="text-center fonts" scope="col">PALABRA</th>
			<th class="text-center fonts" scope="col">FRECUENCIA</th>
		</tr>
		</thead>
		<tbody>
		<?php
		imprimir_palabras(); //DEL ARCHIVO SCRIPT DE PHP SE LLAMA A LA FUNCION IMPRIMIR PALABRAS, GENERA LOS VALORES DE LA TABLA
		?>
		</tbody>
	</table>

</body>
</html>