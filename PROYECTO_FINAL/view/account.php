<?php
//start session
session_start();
$usuario = "";
//user
if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    //get user
    $user = getUser($usuario);


    echo '<script>
        window.onload = function(){
            //set values
            document.getElementById("name-register").value = "' . $user['nombre'] . '";
            document.getElementById("lastname-register").value = "' . $user['lastname'] . '";
            document.getElementById("email-register").value = "' . $user['correo'] . '";
            document.getElementById("password-register").value = "' . $user['password'] . '";
            document.getElementById("phone-register").value = "' . $user['telefono'] . '";
        }
    </script>';



}else{
    //redirect login
    header("Location: ../view/login.php");
}
function getUser($user){
    //get user
    $url = "http://localhost/Desarrollo_Web_2_PHP/PROYECTO_FINAL/api/obtener_usuario.php?id=" . $user;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data =  json_decode($response, true);
    return $data['message'];
}

// js scripts
echo '<script >
        function goHome(){
            window.location.href = "../index.php";
        }
    </script>';

echo '<script>
        function logout(){
            window.location.href = "../controller/logout_controller.php?id=" + ' . $usuario . ';
        }
    </script>';


function debug_to_console($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MacResaleHub</title>
    <link rel="stylesheet" href="../style/account/header.css">
    <link rel="stylesheet" href="../style/account/content.css">

</head>

<body>
<div class="header-div">
    <div class="header-1">
        <div class="burger" onclick="goHome()">
            <img src="../images/product/header/icon-return.png" alt="">
        </div>
    </div>
</div>

<div>
    <div class="login-logo">
        <img src="../images/login/content/logo.png" alt="">
    </div>
    <div class="register">
        <h1>Account</h1>
        <div class="register-div1">
            <label for="name-register" class="small">
                <input type="text" name="name-register" id="name-register" placeholder="Name" class="small-inpl" disabled>
            </label>
            <label for="lastname-register" class="small">
                <input type="text" name="lastname-register" id="lastname-register" placeholder="Lastname" class="small-inpl" disabled>
            </label>
        </div>
        <div class="register-div">
            <label for="email-register">
                <input type="text" name="email-register" id="email-register" placeholder="Email" disabled>
            </label>
            <label for="password-register">
                <input type="text" name="password-register" id="password-register" placeholder="Password" disabled>
            </label>
            <label for="phone-register">
                <input type="text" name="phone-register" id="phone-register" placeholder="Phone" disabled>
            </label>
        </div>
        <div class="reg">
            <div class="register-button" onclick="logout()">
                <h2>Logout</h2>
            </div>
        </div>
    </div>
</div>

</body>
</html>



