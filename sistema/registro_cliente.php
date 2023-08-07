<?php
session_start();

include "../conexion.php";

if (!empty($_POST)) {

    $alert = '';

    if (empty($_POST['nit']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $usuario_id = $_SESSION['idUser'];

        if (!isValidCI($nit)) {
            $alert = '<p class="msg_error">El número de cédula no es válido. Debe ser un número real</p>';
        } else {

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE nit = '$nit' ");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<p class="msg_error">El número de cédula ya existe.</p>';
            } else {
                $query_insert = mysqli_query($conection, "INSERT INTO cliente(nit,nombre,telefono,direccion,usuario_id) VALUES('$nit','$nombre','$telefono','$direccion','$usuario_id')");

                if ($query_insert) {
                    $alert = '<p class="msg_save">Cliente guardado correctamente.</p>';
                } else {
                    $alert = '<p class="msg_error">Error al guardar cliente.</p>';
                }
            }
        }
    }
    mysqli_close($conection);
}

// Función para validar cédula
function isValidCI($ci) {
    if (!is_numeric($ci)) {
        return false;
    }

    if (strlen($ci) !== 10) {
        return false;
    }

    $total = 0;
    $coeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);

    for ($i = 0; $i < 9; $i++) {
        $temp = $ci[$i] * $coeficientes[$i];
        if ($temp > 9) {
            $temp -= 9;
        }
        $total += $temp;
    }

    $verificador = 10 - ($total % 10);
    if ($verificador === 10) {
        $verificador = 0;
    }

    return $ci[9] == $verificador;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Destinatario</title>
</head>

<style>
	.form_register{
		width: 450px;
		margin: auto;
	}

	.form_register h1{
		color: #3c93b0;
	}

	hr{
		border: 0;
		background: #ccc;
		height: 1px;
		margin: 10px 0;
		display: block;
	}

	form{
		background: #fff;
		margin: auto;
		padding: 20px 50px;
		border: 1px solid #d1d1d1;
	}

	label{
		display: block;
		font-size: 12pt;
		font-family: 'GothamBook';
		margin: 15px auto 5px auto;
	}

	input, select{
		display: block;
		width: 100%;
		font-size: 13pt;
		padding: 5px;
		border: 1px solid #85929e;
		border-radius: 5px;
	}

	.notItemOne option:first-child{
		display: none;
	}

	.btn_save{
		font-size: 12pt;
		background: #12a4c6;
		padding: 10px;
		letter-spacing: 1px;
		border: 0;
		cursor: pointer;
		margin: 15px auto;
	}

	.alert{
		width: 100%;
		background: #66e07d66;
		border-radius: 6px;
		margin: 20px auto;
	}

	.msg_error{
		color: #e65656;
	}

	.msg_save{
		color: #126e00;
	}

	.alert p{
		padding: 10px;
	}
</style>



<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro destinatario</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nit">Cédula: </label>
				<input type="text" name="nit" id="nit" placeholder="Número de CI">
				<div id="cedula" style="color: red;"></div>
				<label for="nombre">Nombre: </label>
				<input type="text" name="nombre" placeholder="Nombre Apellido">
				<div id="mensajeErrorNombre" style="color: red;"></div>			
				<label for="telefono">Teléfono: </label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono">
				<div id="mensajeErrorTelefono" style="color: red;"></div>			
				<label for="direccion">Dirección: </label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa">
				<input type="submit" value="Guardar destinatario" class="btn_save" id="btn_sb">
			</form>
		</div>
		<script src="js/validacion.js"></script>
		<script src="../js/validacion.js"></script>
	</section>
	<?php include "includes/footer.php"; ?>
	
	
</body>
</html>