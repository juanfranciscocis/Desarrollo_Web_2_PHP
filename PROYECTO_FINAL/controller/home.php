<?php
    session_start();

    class HomeController
    {

        public function mvcHandler()
        {
            $act = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($act) {
                default:
                    $this->home();
            }
        }

        public function home()
        {
            include "view/home.php";

        }



    }
