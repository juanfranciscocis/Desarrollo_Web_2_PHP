<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Peticion invalida. Esta ruta solo soporta POST'
    ]);
    exit;
}

require 'bdd.php';
$db = new Basedatos();
$conexion = $db->conectar();

$data = json_decode(file_get_contents("php://input")); // Se convierte el JSON a un array asociativo de PHP

if (!isset($data->titulo) OR !isset($data->contenido) OR !isset($data->autor)) {
    echo json_encode([
        'success' => 0,
        'message' => 'Se debe enviar los campos: titulo, contenido y autor'
    ]);
    exit;
} elseif (empty(trim($data->titulo)) OR empty(trim($data->contenido)) OR empty(trim($data->autor))) {
    echo json_encode([
        'success' => 0,
        'message' => 'Los campos no pueden estar vacios'
    ]);
    exit;
}

try{
    // Se prepara la sentencia SQL
    $titulo = htmlspecialchars(trim($data->titulo));
    $contenido = htmlspecialchars(trim($data->contenido));
    $autor = htmlspecialchars(trim($data->autor));
    $sql = "INSERT INTO publicacion (titulo, contenido, autor) VALUES (:titulo, :contenido, :autor)";
    $query = $conexion->prepare($sql);
    $query->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $query->bindValue(':contenido', $contenido, PDO::PARAM_STR);
    $query->bindValue(':autor', $autor, PDO::PARAM_STR);
    if ($query->execute()){
        http_response_code(201);
        echo json_encode([
            'success' => 1,
            'message' => 'Registro creado exitosamente'
        ]);
        exit;
    }else{
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => 'Ocurrio un error, los datos no fueron registrados'
        ]);
        exit;
    }


}catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}
?>