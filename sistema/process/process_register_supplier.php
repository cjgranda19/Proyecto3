<?php
session_start();
include "../../conexion.php";

if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proveedor = $_POST['proveedor'];
    $cedula = $_POST['cedula'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $usuario_id = $_SESSION['idUser'];

    if (empty($cedula) || empty($proveedor) || empty($contacto) || empty($telefono) || empty($correo) || empty($direccion)) {
        $_SESSION['popup_message'] = 'Complete todos los campos';
        header("location: ../lista_proveedor.php");
    } else {
        // Check if the combination of provider, contact, and phone number already exists
        $query_check = "SELECT * FROM proveedor WHERE proveedor = '$proveedor' AND contacto = '$contacto' AND telefono = '$telefono'";
        $result_check = mysqli_query($conection, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            $_SESSION['popup_message'] = 'Ya existe un registro con el mismo proveedor, contacto y número de teléfono.';
        } else {
            $query_insert = "INSERT INTO proveedor(cedula, proveedor, contacto, correo, telefono, direccion, usuario_id) 
                             VALUES('$cedula', '$proveedor', '$contacto', '$correo', '$telefono', '$direccion', '$usuario_id')";
            $result = mysqli_query($conection, $query_insert);

            if ($result) {
                $_SESSION['popup_message'] = 'Inserción exitosa.';
            } else {
                $error_message = 'Error al guardar proveedor: ' . mysqli_error($conection);
                $_SESSION['popup_message'] = $error_message;
            }
        }
        header("location: ../lista_proveedor.php");
    }
    mysqli_close($conection);
}

echo $alert;
?>
