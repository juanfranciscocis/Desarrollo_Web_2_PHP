<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: PUT");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405);
        echo json_encode([
            'success' => 0,
            'message' => 'Peticion invalida. Esta ruta solo soporta PUT'
        ]);
        exit;
    }

    require 'bdd.php';
    $db = new Basedatos();
    $conexion = $db->conectar();

    $data = json_decode(file_get_contents("php://input")); // Se convierte el JSON a un array asociativo de PHP

    if (!isset($data->id)){
        echo json_encode([
            'success' => 0,
            'message' => 'Se debe enviar el campo: id'
        ]);
        exit;
    }

    try {
        $sql = "SELECT * FROM publicacion WHERE id_publicacion = :id";
        $query = $conexion->prepare($sql);
        $query->bindValue(':id', $data->id, PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount()>0){
            $row = $query->fetch(PDO::FETCH_ASSOC); // Se obtiene una fila y se convierte a un array asociativo
            //QUIERO SOLO ACTUALIZAR LOS VALORES QUE ME MANDA EL USUARIO
            //ACTUALIZAR TITULO
            if(isset($data->titulo)){
                $publicacion_titulo = $data->titulo;
            }else{
                $publicacion_titulo = $row['titulo'];
            }
            //ACTUALIZAR CONTENIDO
            if(isset($data->contenido)){
                $publicacion_contenido = $data->contenido;
            }else{
                $publicacion_contenido = $row['contenido'];
            }
            //ACTUALIZAR AUTOR
            if(isset($data->autor)){
                $publicacion_autor = $data->autor;
            }else{
                $publicacion_autor = $row['autor'];
            }

            $sql = "UPDATE publicacion SET titulo = :titulo, contenido = :contenido, autor = :autor WHERE id_publicacion = :id";
            $query = $conexion->prepare($sql);
            $query->bindValue(':titulo', htmlspecialchars(trim($publicacion_titulo)), PDO::PARAM_STR);
            $query->bindValue(':contenido', htmlspecialchars(trim($publicacion_contenido)), PDO::PARAM_STR);
            $query->bindValue(':autor', htmlspecialchars(trim($publicacion_autor)), PDO::PARAM_STR);
            $query->bindValue(':id', $data->id, PDO::PARAM_INT);
            if($query->execute()){
                http_response_code(200);
                echo json_encode([
                    'success' => 1,
                    'message' => 'Registro actualizado exitosamente'
                ]);
            }else{
                http_response_code(500);
                echo json_encode([
                    'success' => 0,
                    'message' => 'Ocurrio un error, los datos no fueron actualizados'
                ]);
            }
        }else{
            http_response_code(404);
            echo json_encode([
                'success' => 0,
                'message' => 'No se encontro ningun registro'
            ]);
        }
    }catch (PDOException $e){
        http_response_code(500);
        echo json_encode([
            'success' => 0,
            'message' => $e->getMessage()
        ]);
        exit;
    }
?>
