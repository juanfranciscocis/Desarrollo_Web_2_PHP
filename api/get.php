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

require 'bdd.php';
$db = new Basedatos();
$conexion = $db->conectar();
$id_publicacion = '';

if (isset($_GET['id'])) {
    $id_publicacion = $_GET['id'];
}

try {
    if (is_numeric($id_publicacion)) {
        $sql = "SELECT * FROM publicacion WHERE id_publicacion = " . $id_publicacion;
    } else {
        $sql = "SELECT * FROM publicacion";
    }
    $query = $conexion->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $data = null;
        if (is_numeric($id_publicacion)) {
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