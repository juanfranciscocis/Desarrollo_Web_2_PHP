<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Peticion invalida. Esta ruta solo soporta GET'
    ]);
    exit;
}

require 'database.php';
$db = new Database();
$conexion = $db->conectar();
$id_usuario = '';
$id_sesion = '';

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
}
if (isset($_GET['id_sesion'])) {
    $id_sesion = $_GET['id_sesion'];
}

try {
    if (isset($id_usuario) && isset($id_sesion)) {
        $sql = "INSERT INTO sesion (session_id, id_usuario,fecha_creacion) VALUES (:id_sesion, :id_usuario,:fecha_creacion)";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id_sesion', $id_sesion, PDO::PARAM_STR);
        $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $query->bindValue(':fecha_creacion', date("Y-m-d H:i:s"), PDO::PARAM_STR);


        if ($query->execute()) {
            // get id_sesion
            $sql = "SELECT id_sesion FROM sesion WHERE session_id = :id_sesion";
            $query = $conexion->prepare($sql);
            $query->bindValue(':id_sesion', $id_sesion, PDO::PARAM_STR);
            if ($query->execute()){
                $id_sesion = $query->fetch(PDO::FETCH_ASSOC)['id_sesion'];
                http_response_code(201);
                echo json_encode([
                    'success' => 1,
                    'message' => 'El registro fue creado exitosamente.',
                    'id_sesion' => $id_sesion
                ]);
                exit;
            }else{
                echo json_encode([
                    'success' => 0,
                    'message' => 'Ocurrió un error. Los datos no fueron guardados.'
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'success' => 0,
                'message' => 'Ocurrió un error. Los datos no fueron guardados.'
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar los datos: id_sesion y id_usuario.'
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