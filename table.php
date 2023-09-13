<?php

    $numero = 8;

    echo "<table border='1'>";
    for($i=0; $i<=100; $i++){
        echo "<tr><td>$numero X $i</td><td> = ". ($numero*$i) . "</td></tr>";
    }
    echo "</table>";

    echo "<br>";

    $colores = array("rojo", "verde", "azul", "negro", "blanco");
    echo "<select>";
    foreach ($colores as $color){
        echo "<option>$color</option>";
    }
    echo"</select>";

    echo "<br>";

    echo "<select>";
    for ($i=0; $i<count($colores); $i++){
        echo "<option>$colores[$i]</option>";
    }
    echo"</select>";
















?>


