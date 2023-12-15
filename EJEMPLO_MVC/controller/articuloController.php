<?php
    require '../model/articulo.php';
    require '../model/articuloModel.php';
    require '../config.php';

    session_start();

    class ArticuloController{

        function __construct(){
            $this -> objConfig = new Config();
            $this -> objsm = new ArticuloModel($this -> objConfig);
        }


        public function mvcHandler(){
            $act = isset($_GET['act']) ? $_GET['act'] : null;
            switch ($act) {
                case 'add':
                    $this -> insert();
                    break;
                case 'update':
                    $this -> update();
                    break;
                case 'delete':
                    $this -> delete();
                    break;
                default:
                    $this -> lista();
                    break;
            }

        }

        public function pageRedirect($url){
            header('Location: '.$url);
        }

        //funcion para guardar
        public function insert(){
            try {
                $articuloObj = new Articulo();
                if (isset($_POST['addbtn'])) {
                    $articuloObj->nombre = trim($_POST['nombre']);
                    $articuloObj->categoria = trim($_POST['categoria']);
                    $this -> objsm -> insert_articulo($articuloObj);
                    $_SESSION['articuloObj'] = serialize($articuloObj);
                    $this -> pageRedirect("view/list.php");
                }
            }catch (Exception $e) {
                throw $e;
            }
        }

        public function update(){
            try {
                if (isset($_POST['updatebtn'])) {
                    $articuloObj = unserialize($_SESSION['articuloObj']);
                    $articuloObj->id = trim($_POST['id']);
                    $articuloObj->nombre = trim($_POST['nombre']);
                    $articuloObj->categoria = trim($_POST['categoria']);
                    $this -> objsm -> update_articulo($articuloObj);
                    $_SESSION['articuloObj'] = serialize($articuloObj);
                    $this -> pageRedirect("view/list.php");
                }
            }catch (Exception $e) {
                throw $e;
            }

        }

        public function delete(){
            try {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $this -> objsm -> delete_articulo($id);
                    $this -> pageRedirect("view/list.php");
                }
            }catch (Exception $e) {
                throw $e;
            }
        }

        public function lista(){
            try {
                $result = $this -> objsm -> selectArticulo(0);
                include '../view/list.php';
                return $result;
            }catch (Exception $e) {
                throw $e;
            }
        }

    }





?>
