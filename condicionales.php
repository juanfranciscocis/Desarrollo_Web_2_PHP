<?php

    //CONDICIONAL IF
    $perfil = "admin";

    if($perfil == "admin"){
        echo "Bienvenido Administrador";
    }else if ($perfil == "editor"){
        echo "Bienvenido Usuario";
    } else {
        echo "Bienvenido Invitado";
    }

    echo "<br>";

    //CONDICIONAL SWITCH
    $color = "azul";
    switch ($color){
        case "azul":
            echo "El color es azul";
            break;
        case "rojo":
            echo "El color es rojo";
            break;
        case "verde":
            echo "El color es verde";
            break;
        default:
            echo "El color es desconocido";
            break;
    }






?>
