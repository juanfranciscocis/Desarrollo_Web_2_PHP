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
$direccion = '';
$ciudad = '';
$pais = '';
$total = '';

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];
}

if (isset($_GET['direccion'])) {
    $direccion = $_GET['direccion'];
}

if (isset($_GET['ciudad'])) {
    $ciudad = $_GET['ciudad'];
}

if (isset($_GET['pais'])) {
    $pais = $_GET['pais'];
}

if (isset($_GET['total'])) {
    $total = $_GET['total'];
}

try {
    if (isset($id_usuario) && isset($direccion) && isset($ciudad) && isset($pais) && isset($total)) {
        $sql = "INSERT INTO orden (id_usuario, direccion, ciudad, pais, total) VALUES (:id_usuario, :direccion, :ciudad, :pais, :total)";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $query->bindValue(':direccion', $direccion, PDO::PARAM_STR);
        $query->bindValue(':ciudad', $ciudad, PDO::PARAM_STR);
        $query->bindValue(':pais', $pais, PDO::PARAM_STR);
        $query->bindValue(':total', $total, PDO::PARAM_STR);

        if ($query->execute()) {
            http_response_code(201);
            //select order id
            $sql = "SELECT id_orden FROM orden WHERE id_usuario = :id_usuario ORDER BY id_orden DESC LIMIT 1";
            $query = $conexion->prepare($sql);
            $query->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
            if ($query->execute()) {
                $id_orden = $query->fetch(PDO::FETCH_ASSOC);
                $id_orden = $id_orden['id_orden'];
                echo json_encode([
                    'success' => 1,
                    'message' => 'Orden creada exitosamente.',
                    'id_orden' => $id_orden
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
            'message' => 'Se debe enviar los datos: id_usuario, direccion, ciudad, pais y total.'
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