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
$id_sesion = '';

if (isset($_GET['id'])) {
    $id_sesion = $_GET['id'];
}

try {
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM item_sesion S, producto P WHERE S.id_producto = P.id_producto AND id_sesion = " .$id_sesion;
        $query = $conexion->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            $data = null;
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode([
                'success' => 1,
                'message' => $data
            ]);
        } else {
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontraron registros'
            ]);
        }
    } 
    else {
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar el datos: id_sesion.'
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