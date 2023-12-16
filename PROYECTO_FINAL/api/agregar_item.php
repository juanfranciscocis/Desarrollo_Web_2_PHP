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
$cantidad = '';

if (isset($_GET['id'])) {
    $id_sesion = $_GET['id'];
}
if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
}
if (isset($_GET['c'])) {
    $cantidad = $_GET['c'];
}else{
    $cantidad = 1;
}

try {

    if(isset($id_sesion)){
        $sql = "SELECT * FROM sesion WHERE session_id = :id_sesion";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id_sesion', $id_sesion, PDO::PARAM_STR);
        $query->execute();
        $sesion = $query->fetch(PDO::FETCH_ASSOC);
        if ($sesion === false) {
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontraron registros'
            ]);
            exit;
        }
    }

    if (isset($sesion) && isset($id_producto) && isset($cantidad)) {
        $sql = "INSERT INTO item_sesion (id_sesion, id_producto, cantidad) VALUES (:id_sesion, :id_producto, :cantidad)";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id_sesion', $sesion['id_sesion'], PDO::PARAM_INT);
        $query->bindValue(':id_producto', $id_producto, PDO::PARAM_INT);
        $query->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        if ($query->execute()) {
            http_response_code(201);
            echo json_encode([
                'success' => 1,
                'message' => 'Se agregó el producto al carrito',
                'id_sesion' => $sesion['id_sesion'],
            ]);
            exit;
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
            'message' => 'Se debe enviar los datos: id_sesion, id_producto y cantidad.'
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