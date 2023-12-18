<?php
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
    }

    //start session
    session_start();
    //delete all session variables
    session_unset();

    //go to login
    header("Location: ../view/login.php");




