<?php
    session_unset();
    require_once 'controller/home.php';
    //crear controlador
    $controllerHome = new HomeController();
    //iniciar la aplicacion
    $controllerHome->mvcHandler();
?>