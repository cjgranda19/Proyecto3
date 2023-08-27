<?php
session_start();

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}


$alert = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $cedula = $_POST['cedula'];
    $proveedor = $_POST['proveedor'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $usuario_id = $_SESSION['idUser'];

    if (empty($cedula) || empty($proveedor) || empty($contacto) || empty($telefono) || empty($correo) || empty($direccion)) {
        $alert = '<p class="msg_error">Por favor complete todos los campos.</p>';
    } else {
        $query_insert = mysqli_query($conection, "INSERT INTO proveedor(cedula, proveedor,contacto,correo,telefono,direccion,usuario_id) VALUES('$cedula','$proveedor','$contacto','$correo','$telefono','$direccion','$usuario_id')");
        $result = mysqli_query($conection, $query_insert);

        if ($result) {
            $_SESSION['popup_message'] = 'Inserción exitosa.';
        } else {
            $_SESSION['popup_message'] = 'Error al guardar producto: ' . mysqli_error($conection);
        }
        header("location: ../lista_proveedor.php");
        mysqli_close($conection);
    }
}

echo $alert;
?>