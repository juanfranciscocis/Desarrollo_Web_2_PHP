<?php

    //get session
    session_start();
    $product = $_GET['id'];
    $session = $_SESSION['session'];
    $usuario = $_SESSION['usuario'];

    echo $session;
    echo "<br>";
    echo $product;
    echo "<br>";
    echo $usuario;

function debug_to_console($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}


    //api call
    $url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/agregar_item.php?id=' . $session .'&id_producto=' . $product;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
     debug_to_console($data['id_sesion']);
     $_SESSION['id_sesion'] = $data['id_sesion'];
     debug_to_console($_SESSION['id_sesion']);





    

    //redirect to home
    header("Location: ../index.php");


?>