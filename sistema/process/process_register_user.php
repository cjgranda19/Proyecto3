<?php
session_start();

include "../../conexion.php";

if (!isset($_SESSION['permisos']['permiso_crear_usuarios']) || $_SESSION['permisos']['permiso_crear_usuarios'] != 1) {
	header("location: index.php");
	exit();
}

$alert = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $user = $_POST['usuario'];
    $clave = md5($_POST['clave']);
    $cargo = $_POST['cargo'];
    $selectedRoles = $_POST['roles'];

    if (empty($nombre) || empty($email) || empty($user) || empty($clave) || empty($cargo) || empty($selectedRoles)) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $permiso_crear_usuarios = in_array("Crear usuarios", $selectedRoles) ? 1 : 0;
        $permiso_ver_usuarios = in_array("Ver usuarios", $selectedRoles) ? 1 : 0;
        $permiso_ver_proveedores = in_array("Ver proveedores", $selectedRoles) ? 1 : 0;
        $permiso_crear_proveedor = in_array("Crear proveedor", $selectedRoles) ? 1 : 0;
        $permiso_ver_productos = in_array("Ver productos", $selectedRoles) ? 1 : 0;
        $permiso_crear_productos = in_array("Crear productos", $selectedRoles) ? 1 : 0;
        $permiso_agregar_productos = in_array("Agregar productos", $selectedRoles) ? 1 : 0;
        $permiso_crear_hoja_tecnica = in_array("Crear hoja técnica", $selectedRoles) ? 1 : 0;
        $permiso_ver_hojas_tecnicas = in_array("Ver hojas técnicas", $selectedRoles) ? 1 : 0;
        $permiso_ver_ordenes = in_array("Ver órdenes", $selectedRoles) ? 1 : 0;
        $permiso_crear_ordenes = in_array("Crear órdenes", $selectedRoles) ? 1 : 0;
        $permiso_ver_clientes = in_array("Ver clientes", $selectedRoles) ? 1 : 0;
        $permiso_crear_clientes = in_array("Crear clientes", $selectedRoles) ? 1 : 0;
        $permiso_ver_reportes = in_array("Ver reportes", $selectedRoles) ? 1 : 0;


        $query_insert_rol = "INSERT INTO rol (permiso_crear_usuarios, permiso_ver_usuarios, permiso_ver_proveedores, permiso_crear_proveedor, permiso_ver_productos, permiso_crear_productos, permiso_agregar_productos, permiso_crear_hoja_tecnica, permiso_ver_hojas_tecnicas, permiso_ver_ordenes, permiso_crear_ordenes, permiso_ver_clientes, permiso_crear_clientes, permiso_ver_reportes) 
        VALUES ('$permiso_crear_usuarios', '$permiso_ver_usuarios', '$permiso_ver_proveedores', '$permiso_crear_proveedor', '$permiso_ver_productos', '$permiso_crear_productos', '$permiso_agregar_productos', '$permiso_crear_hoja_tecnica', '$permiso_ver_hojas_tecnicas', '$permiso_ver_ordenes', '$permiso_crear_ordenes', '$permiso_ver_clientes', '$permiso_crear_clientes', '$permiso_ver_reportes')";
        $result_insert_rol = mysqli_query($conection, $query_insert_rol);


        if ($result_insert_rol) {
            $rol_id = mysqli_insert_id($conection); // Obtener el ID del nuevo rol

            // Insertar usuario en la tabla "usuario" con el ID de rol obtenido
            $query_insert_usuario = "INSERT INTO usuario(nombre, correo, usuario, clave, cargo, rol) VALUES ('$nombre', '$email', '$user', '$clave', '$cargo' ,'$rol_id')";
            $result_insert_usuario = mysqli_query($conection, $query_insert_usuario);

            if ($result_insert_usuario) {
                $_SESSION['popup_message'] = 'Inserción exitosa.';
                header("location: ../lista_usuarios.php");
            } else {
                $_SESSION['popup_message'] = 'Error al guardar usuario: ' . mysqli_error($conection);
                header("location: ../lista_usuarios.php");
            }
        } else {
            $_SESSION['popup_message'] = 'Error al guardar rol: ' . mysqli_error($conection);
            header("location: ../lista_usuarios.php");
        }

        mysqli_close($conection);
    }
}

echo $alert;
?>