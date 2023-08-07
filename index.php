<?php
$alert = "";
session_start();

if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = "Ingrese su usuario y su contraseña";
    } else {
      require_once(__DIR__ . "/conexion.php");
      global $conection;

      $user = mysqli_real_escape_string($conection, $_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));

      $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
      mysqli_close($conection);
      $result = mysqli_num_rows($query);

      if ($result > 0) {
        $data = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['email'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];

        header('location: sistema/');
      } else {
        $alert = "El usuario o contraseña son incorrectos";
        session_destroy();
      }

    }
  }
}

?>

<!doctype html>
<html lang="es">

<head>
  <title>Webleb</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="img/icono.ico">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center py-5">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-3"><span>Iniciar sesión </span><span>Información</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-4 pb-3">Iniciar sesion</h4>
                      <div class="form-group">
                        <form class="login" action="" method="post">

                          <input type="text" id="name" name="usuario" class="form-style" placeholder="Usuario">
                          <i class="input-icon uil uil-at"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="password" id="apellido" name="clave" class="form-style" placeholder="Contraseña">
                        <i class="input-icon uil uil-lock-alt"></i>
                        <label class="alert" id="alerta">
                        <?php echo isset($alert) ? $alert : ''; ?>
                      </label>
                      </div>
                      
                      <input type="submit" value="INGRESAR" class="btn mt-4" id="ingresar">
                      </form>
                      <p class="mb-0 mt-4 text-center"><a href="sistema/php/recuperar-contraseña.php"
                          class="link">¿Contraseña olvidad?</a></p>
                    </div>
                  </div>
                </div>
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section text-center">
                      <h4 class="mb-3 pb-3">Contactanos para mayor información</h4>
                      
                      <div class="form-group">
                      
                        <input type="text" class="form-style" placeholder="Nombre Apellido">
                        <i class="input-icon uil uil-user"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="tel" class="form-style" placeholder="Número celular">
                        <i class="input-icon uil uil-phone"></i>
                      </div>
                      <div class="form-group mt-2">
                        <input type="email" class="form-style" placeholder="Email">
                        <i class="input-icon uil uil-at"></i>
                      </div>
                      
                      <a href="#" class="btn mt-4">Información</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>