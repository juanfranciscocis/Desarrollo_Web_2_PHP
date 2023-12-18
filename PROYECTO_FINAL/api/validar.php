<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Peticion inválida. Esta ruta solo soporta POST'
    ]);
    exit;
}

require 'database.php';
$db = new Database();
$conexion = $db->conectar();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->usuario) OR !isset($data->password)) {
    echo json_encode([
        'success' => 0,
        'message' => 'Se debe enviar los datos: usuario y password'
    ]);
    exit;
} elseif (empty(trim($data->usuario)) OR empty(trim($data->password))) {
    echo json_encode([
        'success' => 0,
        'message' => 'Los campos no pueden estar vacíos'
    ]);
    exit;
}

try {
    $sql = "SELECT * FROM USUARIO WHERE correo = '$data->usuario' AND password = '$data->password'";
    $query = $conexion->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo json_encode([
            'success' => 1,
            'message' => 'OK',
            'usuario' => $query->fetchAll(PDO::FETCH_ASSOC)[0]
        ]);
        exit;
    } else {
        echo json_encode([
            'success' => 0,
            'message' => 'No se encontraron registros'
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