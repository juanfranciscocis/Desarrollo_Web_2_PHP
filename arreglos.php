<?php
    $lenguajes = []; //Arreglo vacio
    $lenguajes = array(); //Arreglo vacio
    $lenguajes = array("Java", "Python","PHP","JavaScript");
    $lenguajes[0] = "Java";
    $lenguajes[1] = "Python";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arreglos</title>
</head>
<body>
	<h1><?php echo $lenguajes[0]. "-" . $lenguajes[1] ?></h1>
	<h2><?php echo $lenguajes; ?></h2> <!-- Esto no funciona, no es un String -->
	<pre><?php print_r($lenguajes); ?></pre>
	<h1>Arreglos Asociativos</h1>
	<?php
		$puntajes = array(
			"Juan" => 30,
			"Sara" => 40,
			"Pedro" => 35,
			"Maria" => 40,
		);
		$puntajes["Juan"] = 30;
		$puntajes["Sara"] = 40;
		$puntajes["Pedro"] = 35;
	?>
	<pre><?php print_r($puntajes); ?></pre>
	<h1>Ordenar Arreglos</h1>
	<?php
		$numeros = array(12, 100, 20, 30, 50, 200);
		$marcas = array("Toyota", "Mazda", "Honda", "Ford", "Chevrolet");
		//Ordenar de menor a mayor
		sort($numeros);
		sort($marcas);
	?>
	<pre><?php print_r($numeros); ?></pre>
	<pre><?php print_r($marcas); ?></pre>
	<h3>Ordeno Reverso</h3>
	<pre><?php print_r(rsort($numeros)); ?></pre>
	<pre><?php print_r(rsort($marcas)); ?></pre>
	<h1>Buscar Elementos</h1>
	<p>
		<?php
			if(in_array("PHP", $lenguajes)){
				echo "PHP esta en el arreglo";
			}else {
				echo "PHP no esta en el arreglo";
            }
			$position = array_search("PHP", $lenguajes);
			echo "<br>";
			echo "PHP esta en la posicion: ".$position;
		?>
	</p>
	<h1>Agregar o Quitar Elementos</h1>
	<?php
		array_push($lenguajes, "C#");
		array_push($lenguajes, "C++");
		array_push($lenguajes, "C");

	?>
	<pre><?php print_r($lenguajes); ?></pre>
	<?php
		array_pop($lenguajes);
	?>
	<pre><?php print_r($lenguajes); ?></pre>

</body>
</html>
