<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: PUT");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405);
        echo json_encode([
            'success' => 0,
            'message' => 'Peticion invalida. Esta ruta solo soporta PUT'
        ]);
        exit;
    }

    require 'bdd.php';
    $db = new BasedatosExamen();
    $conexion = $db->conectar();

    $data = json_decode(file_get_contents("php://input")); // Se convierte el JSON a un array asociativo de PHP

    if (!isset($data->id)){
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar el campo: id'
        ]);
        exit;
    }

    try {
        $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = :id";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id', $data->id, PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount()>0){
            $row = $query->fetch(PDO::FETCH_ASSOC); // Se obtiene una fila y se convierte a un array asociativo
            //QUIERO SOLO ACTUALIZAR LOS VALORES QUE ME MANDA EL USUARIO
            //ACTUALIZAR MARCA
            if(isset($data->marca)){
                $marca = $data->marca;
            }else{
                $marca = $row['marca'];
            }
            //ACTUALIZAR MODELO
            if(isset($data->modelo)){
                $modelo = $data->modelo;
            }else{
                $modelo = $row['modelo'];
            }
            //ACTUALIZAR PLACa
            if(isset($data->placa)){
                $placa = $data->placa;
            }else{
                $placa = $row['placa'];
            }
            //ACTUALIZAR CILINDRAJE
            if(isset($data->cilindraje)){
                $cilindraje = $data->cilindraje;
            }else{
                $cilindraje = $row['cilindraje'];
            }
            if ($cilindraje <= 0 OR is_string($cilindraje)){
                echo json_encode([
                    'success' => 0,
                    'message' => 'El cilindraje no puede ser <=0 o String'
                ]);
                exit;
            }
            $sql = "UPDATE vehiculo SET marca = :marca, modelo = :modelo, placa = :placa, cilindraje = :cilindraje WHERE id_vehiculo = :id";
            $query = $conexion->prepare($sql);
            $query->bindValue(':marca', htmlspecialchars(trim($marca)), PDO::PARAM_STR);
            $query->bindValue(':modelo', htmlspecialchars(trim($modelo)), PDO::PARAM_STR);
            $query->bindValue(':placa', htmlspecialchars(trim($placa)), PDO::PARAM_STR);
            $query->bindValue(':cilindraje', htmlspecialchars(trim($cilindraje)), PDO::PARAM_INT);
            $query->bindValue(':id', $data->id, PDO::PARAM_INT);
            if($query->execute()){
                http_response_code(200);
                echo json_encode([
                    'success' => 1,
                    'message' => 'Registro actualizado exitosamente'
                ]);
            }else{
                http_response_code(500);
                echo json_encode([
                    'success' => 0,
                    'message' => 'Ocurrio un error, los datos no fueron actualizados'
                ]);
            }
        }else{
            http_response_code(404);
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontro ningun registro'
            ]);
        }
    }catch (PDOException $e){
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }
?>
