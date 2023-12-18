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
$id_producto = '';

if (isset($_GET['id'])) {
    $id_sesion = $_GET['id'];
}
if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
}


if (!isset($_GET['id']) && !isset($_GET['id_producto'])) {
    echo json_encode([
        'success' => 0,
        'message' => 'Se debe enviar el id de sesión y el id del producto para eliminarlo del carrito'
    ]);
    exit;
}

try {
    $sql = "SELECT * FROM item_sesion WHERE id_sesion = :id AND id_producto = :id_producto";
    $query = $conexion->prepare($sql);
    $query->bindValue(':id', $id_sesion, PDO::PARAM_INT);
    $query->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
    $query->execute();
    if ($query->rowCount() > 0) {
        //delete only one item
        $sql = "DELETE FROM item_sesion WHERE id_sesion = :id AND id_producto = :id_producto LIMIT 1";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id', $id_sesion, PDO::PARAM_INT);
        $query->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
        if ($query->execute()) {
            http_response_code(200);
            echo json_encode([
                'success' => 1,
                'message' => 'El registro fue eliminado exitosamente'
            ]);
            exit;
        } else {
            echo json_encode([
                'success' => 0,
                'message' => 'Ocurrió un error. El registro no fue eliminado.'
            ]);
            exit;
        }
    } else {
        echo json_encode([
            'success' => 0,
            'message' => 'No se encontro un item con el id de sesion y el id del producto enviados'
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