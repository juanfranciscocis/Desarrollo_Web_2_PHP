<?php
    $cadena  = "Bienvenidos a la clase de Desarrollo Web 2";
    echo $cadena;
    echo "<br>";
    $longitud = strlen($cadena);
    echo $longitud;
    echo "<br>";
    $numeroPalabras = str_word_count($cadena);
    echo $numeroPalabras;
    echo "<br>";
    $reverso = strrev($cadena);
    echo $reverso;
    echo "<br>";
    $posicion = strpos($cadena,"Web");
    echo $posicion;
    echo "<br>";
    $remplazo = str_replace("Bienvenido a", "Hola esta es", $cadena);
    echo $remplazo;
    echo "<br>";
    $subcadena = substr($cadena, 0, 2);
    echo $subcadena;
    echo "<br>";
    //echo subcadena but changing the color of the text
    echo "<span style='color: red'>$subcadena</span>";

	$string_texto = "Bienvenidos-a-la-clase-de-Desarrollo-Web 2";
	$arreglo_texto = explode("-", $string_texto);
	$lista = implode(",", $arreglo_texto);






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Funciones de cadenas</title>
    <style>
        h1{
            color: #054756;
        }
        /*For the div make it look like a card*/
        div{
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(5, 56, 56, 0.09);
        }
    </style>
</head>
<body>
    <div>
        <h1>Cadena: <?php echo $cadena?></h1>
    </div>
    <div>
        <h2>Longitud: <?php echo $longitud?></h2>
        <h2>Número de palabras: <?php echo $numeroPalabras?></h2>
        <h2>Reverso: <?php echo $reverso?></h2>
        <h2>Posición de la palabra web: <?php echo $posicion?></h2>
        <h2>Remplazo: <?php echo $remplazo?></h2>
        <h2>Subcadena: <?php echo $subcadena?></h2>
	    <h2>Explode: <pre><?php print_r($arreglo_texto); ?></pre></h2>
	    <h2>Implode: <?php echo $lista?></h2>
    </div>


</body>
</html>

