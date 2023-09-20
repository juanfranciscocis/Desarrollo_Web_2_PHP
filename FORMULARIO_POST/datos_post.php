<?php

    // $_GET is a global variable that stores the data sent by the form getting the url parameters
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    echo "Bienvenido:" . $nombre . " " . $apellido;

?>
