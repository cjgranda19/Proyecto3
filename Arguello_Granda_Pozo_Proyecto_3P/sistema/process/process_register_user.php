<?php
session_start();

include "../../conexion.php";

if ($_SESSION['rol'] != 1) {
    header("location: ./");
    exit();
}

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $rol = $_POST['rol'];

    if (empty($nombre) || empty($email) || empty($user) || empty($clave) || empty($rol)) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $query = "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'";
        $result = mysqli_query($conection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['popup_message'] = 'Ya existe el usuario o correo';
            header("location: ../lista_usuarios.php");

        } else {
            $query_insert = "INSERT INTO usuario(nombre, correo, usuario, clave, rol) VALUES('$nombre', '$email', '$user', '$clave', '$rol')";
            $result_insert = mysqli_query($conection, $query_insert);

            if ($result_insert) {
                $_SESSION['popup_message'] = 'Inserción exitosa.';
                header("location: ../lista_usuarios.php");

            } else {
                $_SESSION['popup_message'] = 'Error al guardar producto: ' . mysqli_error($conection);
                header("location: ../lista_usuarios.php");

            }

        }

        mysqli_close($conection);
    }
}

echo $alert;
?>
