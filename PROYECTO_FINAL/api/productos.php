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
$id_producto = '';
$categoria = '';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
}
if (isset($_GET['cat'])) {
    $categoria = $_GET['cat'];
}

try {
    if (is_numeric($id_producto)) {
        $sql = "SELECT * FROM producto WHERE id_producto = " . $id_producto;
    } elseif (is_numeric($categoria)) {
        $sql = "SELECT * FROM producto WHERE id_categoria = " . $categoria;
    }
    else {
        $sql = "SELECT * FROM producto";
    }
    $query = $conexion->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $data = null;
        if (is_numeric($id_producto)) {
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