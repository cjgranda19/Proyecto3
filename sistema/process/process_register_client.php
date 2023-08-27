<?php
if (!empty($_POST)) {
    include "../../conexion.php";

$alert = '';

if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
    $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
} else {

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $usuario_id = $_SESSION['idUser'];

    if (!isValidCI($cedula)) {
        $alert = '<p class="msg_error">El número de cédula no es válido. Debe ser un número real</p>';
    } else {

        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE cedula = '$cedula' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El número de cédula ya existe.</p>';
        } else {
            $query_insert = mysqli_query($conection, "INSERT INTO cliente(cedula,nombre,telefono,direccion,usuario_id) VALUES('$cedula','$nombre','$telefono','$direccion','$usuario_id')");

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