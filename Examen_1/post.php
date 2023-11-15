<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => 0,
            'message' => 'Peticion invalida. Esta ruta solo soporta POST'
        ]);
        exit;
    }

    require 'bdd.php';
    $db = new BasedatosExamen();
    $conexion = $db->conectar();

    $data = json_decode(file_get_contents("php://input")); // Se convierte el JSON a un array asociativo de PHP

    if (!isset($data->marca) OR !isset($data->modelo) OR !isset($data->placa) OR !isset($data->cilindraje)) {
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar los campos: marca, modelo ,placa y cilindraje'
        ]);
        exit;
    } elseif (empty(trim($data->marca)) OR empty(trim($data->modelo)) OR empty(trim($data->placa)) OR empty(trim($data->cilindraje))) {
        echo json_encode([
            'success' => 0,
            'message' => 'Los campos no pueden estar vacios'
        ]);
        exit;
    }

    try{
        // Se prepara la sentencia SQL
        $marca = htmlspecialchars(trim($data->marca));
        $modelo = htmlspecialchars(trim($data->modelo));
        $placa = htmlspecialchars(trim($data->placa));
        $cilindraje = htmlspecialchars(trim($data->cilindraje));
        if ($cilindraje <= 0 OR !is_numeric($cilindraje)){
            echo json_encode([
                'success' => 0,
                'message' => 'El cilindraje no puede ser <=0 o String'
            ]);
            exit;
        }
        $sql = "INSERT INTO vehiculo (marca, modelo, placa, cilindraje) VALUES (:marca, :modelo, :placa, :cilindraje)";
        $query = $conexion->prepare($sql);
        $query->bindValue(':marca', $marca, PDO::PARAM_STR);
        $query->bindValue(':modelo', $modelo, PDO::PARAM_STR);
        $query->bindValue(':placa', $placa, PDO::PARAM_STR);
        $query->bindValue(':cilindraje', $cilindraje, PDO::PARAM_INT);
        if ($query->execute()){
            http_response_code(201);
            echo json_encode([
                'success' => 1,
                'message' => 'Registro creado exitosamente'
            ]);
            exit;
        }else{
            http_response_code(500);
            echo json_encode([
                'success' => 0,
                'message' => 'Ocurrio un error, los datos no fueron registrados'
            ]);
            exit;
        }


    }catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }
?>