<?php
    //iniciar session
    session_start();

    // existe el usuario? entra, si no error
    if (array_key_exists('autenticado', $_SESSION)) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Privada</title>
            </head>
            <body>
                <h1>Bienvenido <?php echo $_SESSION["usuario"]; echo $_SESSION["autorizado"];?></h1>
                <a href="logout.php">Cerrar Session</a>
            </body>
            </html>
        <?php
    } else {
        header("Location: login.php");
        exit();
    }


?>
