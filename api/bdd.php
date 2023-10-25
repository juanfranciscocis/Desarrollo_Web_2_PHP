<?php

class Basedatos
{
    private $db_host = 'localhost';
    private $db_name = 'api';
    private $db_username = 'root';
    private $db_password = '';

    public function conectar () {
        try {
            $con = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_username, $this->db_password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            echo "Error de conexion: " . $e->getMessage();
            exit;
        }
    }
}

?>