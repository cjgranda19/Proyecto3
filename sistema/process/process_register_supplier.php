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
        $query_insert = mysqli_query($conection, "INSERT INTO proveedor(cedula, proveedor,contacto,correo,telefono,direccion,usuario_id) VALUES('$cedula','$proveedor','$contacto','$correo','$telefono','$direccion','$usuario_id')");
        $result = mysqli_query($conection, $query_insert);

        if ($result) {
            $_SESSION['popup_message'] = 'Inserción exitosa.';
        } else {
            $error_message = 'Error al guardar proveedor: ' . mysqli_error($conection);
            $error_message .= "\nDatos enviados:";
            $error_message .= "\nCédula: $cedula";
            $error_message .= "\nProveedor: $proveedor";
            $error_message .= "\nContacto: $contacto";
            $error_message .= "\nTeléfono: $telefono";
            $error_message .= "\nCorreo: $correo";
            $error_message .= "\nDirección: $direccion";

            $_SESSION['popup_message'] = $error_message;
            echo $error_message;
        }
        header("location: ../lista_proveedor.php");
        mysqli_close($conection);
    }
}

echo $alert;
?>