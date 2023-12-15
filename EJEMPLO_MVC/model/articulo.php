<?php
    class Articulo {

        //campos de la tabla articulo
        public $id_articulo;
        public $categoria;
        public $nombre;

        //string por campo
        public $id_msg;
        public $categoria_msg;
        public $nombre_msg;


        //constructor con valores por defecto
        public function __construct(){
            $this -> id_articulo = 0;
            $this -> categoria = "";
            $this -> nombre = "";

            $this -> id_msg = "";
            $this -> categoria_msg = "";
            $this -> nombre_msg = "";
        }







    }

?>