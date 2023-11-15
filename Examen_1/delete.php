<?php


    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        http_response_code(405);
        echo json_encode([
            'success' => 0,
            'message' => 'Peticion invalida. Esta ruta solo soporta DELETE'
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
            $sql = "DELETE FROM vehiculo WHERE id_vehiculo = :id";
            $query = $conexion->prepare($sql);
            $query->bindValue(':id', $data->id, PDO::PARAM_INT);
            if($query->execute()){
                http_response_code(200);
                echo json_encode([
                    'success' => 1,
                    'message' => 'Registro eliminado exitosamente'
                ]);
                exit;
            }else{
                http_response_code(500);
                echo json_encode([
                    'success' => 0,
                    'message' => 'Ocurrio un error, el registro no fue eliminado'
                ]);
                exit;
            }
        }else{
            http_response_code(404);
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontro el registro'
            ]);
            exit;
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }



?>
