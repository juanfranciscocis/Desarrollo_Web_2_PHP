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
    $db = new BasedatosExamen();
    $conexion = $db->conectar();
    $id_vehiculo = '';

    if (isset($_GET['id'])) {
        $id_vehiculo = $_GET['id'];
    }


    try {
        if (is_numeric($id_vehiculo)) {
            $sql = "SELECT * FROM vehiculo WHERE id_vehiculo = " . $id_vehiculo;
        } else {
            $sql = "SELECT * FROM vehiculo";
        }
        $query = $conexion->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            $data = null;
            if (is_numeric($id_vehiculo)) {
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