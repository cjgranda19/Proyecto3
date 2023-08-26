<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ../");
}
include "../../conexion.php";

if (!empty($_POST)) {
    $alert = '';

    if ($_POST['precio'] <= 0 || $_POST['cantidad'] <= 0) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {
        $codproducto = $_POST['codproducto'];
        $descripcion = $_POST['descripcion'];
        $proveedor = $_POST['proveedor'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $usuario_id = $_SESSION['idUser'];

        // Obtener los datos anteriores del producto
        $query_producto = mysqli_query($conection, "SELECT * FROM producto WHERE codproducto = $codproducto");
        $result_producto = mysqli_fetch_assoc($query_producto);

        // Realizar la actualización del producto
        $query_update = mysqli_query($conection, "UPDATE producto SET proveedor_id = '$proveedor', precio ='$precio',  existencia = existencia + '$cantidad', usuario_id= '$usuario_id'  WHERE  codproducto = $codproducto");
        if ($query_update) {
            $alert = '<p class="msg_save">Producto editado correctamente.</p>';

            // Registrar el cambio en la tabla de auditoría
            $changes = array();

            $old_price = $result_producto['precio'];
            if ($_POST['precio'] != $old_price) {
                $changes['precio'] = array(
                    'anterior' => $old_price,
                    'nuevo' => $_POST['precio']
                );
            }

            if ($_POST['cantidad'] > 0) {
                $changes['cantidad'] = array(
                    'anterior' => $result_producto['existencia'],
                    'nuevo' => $result_producto['existencia'] + $_POST['cantidad']
                );
            }

            // Obtener el proveedor anterior del producto
            $query_old_supplier = mysqli_query($conection, "SELECT proveedor_id FROM producto WHERE codproducto = $codproducto");
            $old_supplier_result = mysqli_fetch_assoc($query_old_supplier);
            if ($old_supplier_result) {
                $old_supplier = $old_supplier_result['proveedor_id'];
                if ($_POST['proveedor'] != $old_supplier) {
                    $changes['proveedor'] = array(
                        'anterior' => $old_supplier,
                        'nuevo' => $_POST['proveedor']
                    );
                }
            }

            if (!empty($changes)) {
                $changes_json = json_encode($changes);

                // Insertar el registro en la tabla de auditoría
                $query_audit = mysqli_query($conection, "INSERT INTO product_log_update (producto_id, usuario_id, fecha_cambio, cambios) VALUES ('$codproducto', '$usuario_id', NOW(), '$changes_json')");
                if (!$query_audit) {
                
                }
            }

            header("location: ../lista_producto.php");
        } else {
            $alert = '<p class="msg_error">Error al editar producto.</p>';
            // ...
        }
    }
}
?>
