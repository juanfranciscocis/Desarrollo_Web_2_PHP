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
        $sql = "SELECT * FROM sesion WHERE id_usuario = " . $id_usuario . " ORDER BY id_sesion DESC LIMIT 1";
        //send query
        $query = $conexion->prepare($sql);
        $query->execute();
        //check if query has results
        if ($query->rowCount() > 0) {
            //get results
            $data = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            //send response
            echo json_encode([
                'success' => 1,
                'message' => $data
            ]);
        } else {
            // error
            http_response_code(400);
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontraron registros'
            ]);
        }

    } else{
        // error
        http_response_code(400);
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar el id del usuario'
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