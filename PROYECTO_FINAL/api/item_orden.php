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
$id_orden = "";

if (isset($_GET['id_sesion'])) {
    $id_sesion = $_GET['id_sesion'];
}

if (isset($_GET['id_orden'])) {
    $id_orden = $_GET['id_orden'];
}

try {
    if ($id_sesion != "" && $id_orden != "") {
        $sql = "SELECT id_producto FROM item_sesion WHERE id_sesion = :id_sesion";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id_sesion', $id_sesion, PDO::PARAM_INT);
        $query->execute();
        if( $query->rowCount() > 0 ){
            $data = null;
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i=0; $i < count($data); $i++) {
                $sql = "INSERT INTO item_orden (id_orden, id_producto,cantidad) VALUES (:id_orden, :id_producto, 1)";
                $query = $conexion->prepare($sql);
                $query->bindValue(':id_orden', $id_orden, PDO::PARAM_INT);
                $query->bindValue(':id_producto', $data[$i]['id_producto'], PDO::PARAM_INT);
                $query->execute();
            }

            $sql = "DELETE FROM item_sesion WHERE id_sesion = :id_sesion";
            $query = $conexion->prepare($sql);
            $query->bindValue(':id_sesion', $id_sesion, PDO::PARAM_INT);
            $query->execute();




            echo json_encode([
                'success' => 1,
                'message' => 'Se agregaron los items a la orden'
            ]);
        }else{
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontraron registros'
            ]);
        }
    }
    else {
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar el datos: id_sesion, id_orden.'
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