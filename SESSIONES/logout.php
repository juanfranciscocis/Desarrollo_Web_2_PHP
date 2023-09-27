<?php
    //iniciar session
    session_start();

    // existe el usuario? entra, si no error
    if (array_key_exists('autenticado', $_SESSION)) {
        $_SESSION = array();
        session_destroy();
        echo "Session Cerrada";
        ?>
        <br>
        <a href="login.php">Iniciar Session</a>
        <?php
    } else {
        header("Location: login.php");
        exit();
    }

?>
