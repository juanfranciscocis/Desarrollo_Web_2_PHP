<?php
    //crear variables para los campos del formulario
    $nombre = "";
    $apellido = "";
    $correo = "";
    $pais = "";
    $lenguajes = "";
    $password = "";
    $rep_password = "";

    //variables de control del formulario
    $error = 0;
    $formulario_valido = 0;

    if (isset($_POST['registrar'])) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $correo = trim($_POST['correo']);
        $password = $_POST['password'];
        $rep_password = $_POST['password2'];

        if (empty($_POST['nombre']) OR strlen($_POST['nombre']) < 3) {
            $nombreError = "Nombre requerido, debe tener al menos 3 caracteres.";
            $nombreValido = 1;
            $error = 1;
        }
        if (empty($_POST['apellido']) OR strlen($_POST['apellido']) < 3) {
            $apellidoError = "Apellido requerido, debe tener al menos 3 caracteres.";
            $apellidoValido = 1;
            $error = 1;
        }
        if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $correoError = "El correo electrónico no es válido.";
            $correoValido = 1;
            $error = 1;
        }
        if (strlen($_POST['password']) < 5 OR strlen($_POST['password2']) < 5) {
            $pwdError = "El password debe tener al menos 5 caracteres.";
            $pwdValido = 1;
            $error = 1;
        }
        if ($_POST['password'] != $_POST['password2']) {
            $pwdError = "El password y la repitición no coinciden.";
            $pwdValido = 1;
            $error = 1;
        }
    }
    if ($error == 0 AND isset($_POST['registrar'])) {
      $form_ok = "Formulario validado correctamente";
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Formulario de registro con PHP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/pricing/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>
  <body>
    
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">Features</a>
    <a class="p-2 text-dark" href="#">Enterprise</a>
    <a class="p-2 text-dark" href="#">Support</a>
    <a class="p-2 text-dark" href="#">Pricing</a>
  </nav>
  <a class="btn btn-outline-primary" href="#">Sign up</a>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Formulario de registro</h1>
  <p class="lead">Llena el siguiente formulario para registrarte.</p>
</div>

<div class="container">
  <form method="post" action="form.php">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nombre">Nombre</label>
        <input class="form-control
        <?php 
            if ($nombreValido == 1) {
              echo " is-invalid";
            }
        ?>" type="text" name="nombre" id="nombre" placeholder="Pedro" value="<?php echo $nombre; ?>">
        <div class="invalid-feedback">
            <?php
            if ($nombreValido == 1) {
              echo $nombreError;
            }
            ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="apellido">Apellido</label>
        <input class="form-control
        <?php
            if ($apellidoValido == 1) {
              echo " is-invalid";
            }
        ?>
        " type="text" name="apellido" id="apellido" placeholder="Pérez" value="<?php echo $apellido; ?>">
        <div class="invalid-feedback">
            <?php
            if ($apellidoValido == 1) {
              echo $apellidoError;
            }
            ?>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="correo">Correo electrónico</label>
      <input class="form-control
      <?php
            if ($correoValido == 1) {
              echo " is-invalid";
            }
      ?>
      " type="email" name="correo" id="correo" placeholder="hola@gmail.com" value="<?php echo $correo; ?>">
      <div class="invalid-feedback">
            <?php
            if ($correoValido == 1) {
              echo $correoError;
            }
            ?>
      </div>
    </div>
    <div class="form-group">
      <label for="pais">País</label>
      <select name="pais" id="pais" class="form-control">
        <option value="">Selecciona...</option>
        <option value="ec">Ecuador</option>
        <option value="co">Colombia</option>
        <option value="pe">Perú</option>
      </select>
    </div>
    <div class="form-group">
      <label for="lenguajes">Lenguajes</label>
      <div class="form-check">
        <input type="checkbox" name="lenguajes" id="check1" class="form-check-input" value="javascript">
        <label for="check1" class="form-check-label">JavaScript</label>
      </div>
      <div class="form-check">
        <input type="checkbox" name="lenguajes" id="check2" class="form-check-input" value="python">
        <label for="check2" class="form-check-label">Python</label>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input class="form-control
        <?php
          if ($pwdValido == 1) {
            echo " is-invalid";
          }
        ?>
        " type="password" name="password" id="password" placeholder="password" value="<?php echo $password; ?>">
        <div class="invalid-feedback">
            <?php
            if ($pwdValido == 1) {
              echo $pwdError;
            }
            ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="password2">Repetir password</label>
        <input class="form-control" type="password" name="password2" id="password2" placeholder="password" value="<?php echo $rep_password; ?>">
      </div>
    </div>
    <button type="submit" class="btn btn-success" name="registrar">Registrar</button>
    <?php
      if (isset($form_ok)) {
        echo $form_ok;
      }
    ?>
  </form>
</div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
        <small class="d-block mb-3 text-muted">&copy; 2017-2022</small>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Cool stuff</a></li>
          <li><a class="text-muted" href="#">Random feature</a></li>
          <li><a class="text-muted" href="#">Team feature</a></li>
          <li><a class="text-muted" href="#">Stuff for developers</a></li>
          <li><a class="text-muted" href="#">Another one</a></li>
          <li><a class="text-muted" href="#">Last time</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Resource</a></li>
          <li><a class="text-muted" href="#">Resource name</a></li>
          <li><a class="text-muted" href="#">Another resource</a></li>
          <li><a class="text-muted" href="#">Final resource</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Team</a></li>
          <li><a class="text-muted" href="#">Locations</a></li>
          <li><a class="text-muted" href="#">Privacy</a></li>
          <li><a class="text-muted" href="#">Terms</a></li>
        </ul>
      </div>
    </div>
  </footer>
</div>


    
  </body>
</html>
