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
<html>

<head>
	<meta charset="utf-8">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<title>Login</title>
	<link rel="shortcut icon" href="img/icono.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
</head>

<body>
	<div class="padre">
		<div class="hijo">
			<div class="nieto">
				<form class="login" action="" method="post">


					<label for="name" id="labelxd">Usuario:</label>
					<input type="text" id="name" name="usuario">
					<label for="name" id="labelxd2">Contraseña:</label>
					<input type="password" id="apellido" name="clave">
					<label class="alert" id="alerta">
						<?php echo isset($alert) ? $alert : ''; ?>
					</label>
					<input type="submit" value="INGRESAR" id="ingresar">
				</form>
			</div>
		</div>
	</div>
</body>

</html>