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

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
}

try {
    if (is_numeric($id_usuario)) {
        $sql = "SELECT * FROM usuario WHERE id_usuario = " . $id_usuario;
    } else {
        $sql = "SELECT * FROM usuario";
    }
    $query = $conexion->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $data = null;
        if (is_numeric($id_usuario)) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }
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


} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}

?>