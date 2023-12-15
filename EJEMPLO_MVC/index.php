<?php
    session_unset();
    require_once 'controller/articuloController.php';
    $controller = new ArticuloController();
    $controller -> mvcHandler();
?>