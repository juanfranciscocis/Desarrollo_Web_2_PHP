<?php

    // $_GET is a global variable that stores the data sent by the form getting the url parameters
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];

    echo "Bienvenido:" . $nombre . " " . $apellido;

?>
