<?php
    //MODELO DEL ARTICULO
    class ArticuloModel {
        // conectar con la base de datos
        public function __construct($config){
            $this -> host = $config -> host;
            $this -> user = $config -> user;
            $this -> pass = $config -> pass;
            $this -> db = $config -> db;
        }

        //abrir la conexión con la base de datos
        public function open_db () {
            $this -> condb = new mysqli($this -> host, $this -> user, $this -> pass, $this -> db);
            if ($this -> condb -> connect_errno) {
                echo "Fallo al conectar a MySQL: " . $this -> condb -> connect_error;
            }
        }

        //cerrar la conexión con la base de datos
        public function close_db () {
            $this -> condb -> close();
        }

        // insertar un nuevo artículo
        public function insert_articulo ($articulo) {
            try {
                $this -> open_db();
                $query = $this -> condb -> prepare("INSERT INTO articulo (nombre, categoria) VALUES (?, ?)");
                $query -> bind_param("ss", $articulo -> nombre, $articulo -> categoria);
                $query -> execute();
                $query -> close();
                $this -> close_db();
            }catch (Exception $e) {
                throw $e;

            }
        }

        // actualizar un artículo
        public function update_articulo ($articulo) {
            try {
                $this -> open_db();
                $query = $this -> condb -> prepare("UPDATE articulo SET nombre = ?, categoria = ? WHERE id_articulo = ?");
                $query -> bind_param("ssi", $articulo -> nombre, $articulo -> categoria, $articulo -> id_articulo);
                $query -> execute();
                $query -> close();
                $this -> close_db();
            }catch (Exception $e) {
                throw $e;
            }
        }

        // eliminar un artículo
        public function delete_articulo ($id) {
            try {
                $this -> open_db();
                $query = $this -> condb -> prepare("DELETE FROM articulo WHERE id_articulo = ?");
                $query -> bind_param("i", $id -> id_articulo);
                $query -> execute();
                $query -> close();
                $this -> close_db();
            }catch (Exception $e) {
                throw $e;
            }
        }

        // seleccionar registro
        public function selectArticulo ($id) {
            try {
                $this -> open_db();
                if ($id > 0){
                    $query = $this -> condb -> prepare("SELECT * FROM articulo WHERE id_articulo = ?");
                    $query -> bind_param("i", $id -> id_articulo);
                }else{
                    $query = $this -> condb -> prepare("SELECT * FROM articulo");
                }
                $query -> execute();
                $res = $query -> get_result();
                $query -> close();
                $this -> close_db();
                return $res;
            }catch (Exception $e) {
                throw $e;
            }
        }


    }







?>