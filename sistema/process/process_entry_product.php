<?php

function getOldAndNewValues($conection, $codproducto, $precio, $proveedor, $cantidad)
{
    $query_producto = mysqli_query($conection, "SELECT * FROM producto WHERE codproducto = $codproducto");
    $result_producto = mysqli_fetch_assoc($query_producto);


    $old_price = $result_producto['precio'];
    $new_price = $precio;

    $old_supplier = $result_producto['proveedor'];
    $new_supplier = $proveedor;

    $old_stock = $result_producto['existencia'];
    $new_stock = $old_stock + $cantidad;

    return array(
        'old_price' => $old_price,
        'new_price' => $new_price,
        'old_supplier' => $old_supplier,
        'new_supplier' => $new_supplier,
        'old_stock' => $old_stock,
        'new_stock' => $new_stock
    );
}

session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ../");
}
include "../../conexion.php";

if (!empty($_POST)) {
    $alert = '';

    $codproducto = $_POST['codproducto'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $usuario_id = $_SESSION['idUser'];
    $values = getOldAndNewValues($conection, $codproducto, $precio, $proveedor, $cantidad);

    $changes = array();

    if ($values['new_price'] != $values['old_price']) {
        $changes['precio'] = array(
            'anterior' => $values['old_price'],
            'nuevo' => $values['new_price']
        );
    } else {
        $changes['precio'] = array(
            'anterior' => $values['old_price'],
            'nuevo' => $values['old_price']
        );
    }

    if ($values['new_supplier'] != $values['old_supplier']) {
        $changes['proveedor'] = array(
            'anterior' => $values['old_supplier'],
            'nuevo' => $values['new_supplier']
        );
    } else {
        $changes['proveedor'] = array(
            'anterior' => $values['old_supplier'],
            'nuevo' => $values['old_supplier']
        );
    }



    if ($values['new_stock'] != $values['old_stock']) {
        $changes['stock'] = array(
            'anterior' => $values['old_stock'],
            'nuevo' => $values['new_stock']
        );
    } else {
        $changes['stock'] = array(
            'anterior' => $values['old_stock'],
            'nuevo' => $values['old_stock']
        );
    }

    if (!empty($changes)) {
        $changes_json = json_encode($changes);
        $query_audit = mysqli_query($conection, "INSERT INTO product_log_update (producto_id, usuario_id,cambios, old_price, new_price, old_supplier, new_supplier, old_stock, new_stock) VALUES ('$codproducto', '$usuario_id', '$changes_json', '{$values['old_price']}', '{$values['new_price']}', '{$values['old_supplier']}', '{$values['new_supplier']}', '{$values['old_stock']}', '{$values['new_stock']}')");
        if (!$query_audit) {
            $alert = '<p class="msg_save">Producto editado correctamente.</p>';

        }
    }

    $query_update = mysqli_query($conection, "UPDATE producto SET proveedor='$proveedor', precio ='$precio', usuario_id= '$usuario_id', existencia = existencia + '$cantidad'  WHERE  codproducto = $codproducto");

    if ($query_update) {
        $alert = '<p class="msg_save">Producto editado correctamente.</p>';
        header("location: ../lista_producto.php");
    } else {
        $alert = '<p class="msg_error">Error al editar producto.</p>';

    }
}

?>