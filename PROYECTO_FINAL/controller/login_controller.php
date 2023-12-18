<?php
    //get id
    if (isset($_GET['id'])) {
        //delete $_SESSION["usuario"] and $_SESSION["session"]
        session_start();
        session_unset();
        $_SESSION["usuario"]= $_GET['id'];
        //search for last session
        $url = 'http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/retrive_last_session.php?id=' . $_GET['id'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        debug_to_console($data);
        if ($data['success'] == 1) {
            //set session
            $_SESSION["session"] = $data['message']['session_id'];
            $_SESSION["id_sesion"] = $data['message']['id_sesion'];
            debug_to_console($_SESSION["session"]);
        }else{
            $_SESSION["session"] = "";
            $_SESSION["id_sesion"] = "";
        }

        //set user
        debug_to_console($_SESSION["usuario"]);
        //redirect to home
       header("Location: ../index.php");
    } else {
        header("Location: ../index.php");
    }

    function debug_to_console($data) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }




    ?>
