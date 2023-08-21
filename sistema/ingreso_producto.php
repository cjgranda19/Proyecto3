<?php

session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";

if (!empty($_POST)) {

    $alert = '';

    if (empty($_POST['proveedor']) || empty($_POST['precio']) || empty($_POST['cantidad']) || $_POST['precio'] <= 0 || $_POST['cantidad'] <= 0) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $codproducto = $_POST['codproducto'];
        $descripcion = $_POST['descripcion'];
        $proveedor = $_POST['proveedor'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $usuario_id = $_SESSION['idUser'];

        $query_update = mysqli_query($conection, "UPDATE producto SET proveedor = '$proveedor', precio ='$precio',  existencia ='$cantidad', usuario_id= '$usuario_id'  WHERE  codproducto = $codproducto");
        if ($query_update) {
            $alert = '<p class="msg_save">Producto editado correctamente.</p>';
            header("location: lista_producto.php");
        } else {

            $alert = '<p class="msg_error">Error al editar producto.</p>';
            $alert .= 'Producto' . $producto . ', ';
            $alert .= 'CodProducto' . $codproducto . ', ';
            $alert .= 'Proveedor: ' . $proveedor . ', ';
            $alert .= 'Precio: ' . $precio . ', ';
            $alert .= 'Cantidad: ' . $cantidad . ' ';
            $alert .= 'Usuario: ' . $usuario_id . '</p>';

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Ingreso a Bodega</title>
    <link rel="stylesheet" href="css/nuevo_producto.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Ingreso a bodega</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <form action="" method="post">
                <input  type="hidden" name="codproducto"  id="codproducto" value="<?php echo $codproducto; ?>">
                <label for="producto">Producto: </label>
                <input type="text" name="producto" id="producto" placeholder="Nombre del producto">
                <label for="proveedor">Proveedor</label>
                <?php
                $query_proveedor = mysqli_query($conection, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
                $result_proveedor = mysqli_num_rows($query_proveedor);
                mysqli_close($conection);
                ?>
                <select name="proveedor" id="proveedor" disabled required>
                    <option value="" disabled selected>Selecciona un cliente</option>

                    <?php
                    if ($result_proveedor > 0) {
                        while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                            ?>
                            <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <label for="precio">Precio: </label>
                <input type="number" name="precio" id="precio" step="0.01" placeholder="Precio del producto" disabled
                    required>
                <label for="cantidad">Cantidad: </label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Stock" disabled required>
                <input type="submit" value="Guardar producto" id="bt_test" class="btn_save">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
    <script>

        $('#producto').keyup(function (e) {
            e.preventDefault();

            var producto = $(this).val();
            var action = 'searchProduct';

            $.ajax({
                url: 'ajax.php',
                type: "POST",
                async: true,
                data: { action: action, producto: producto },

                success: function (response) {

                    if (response == 0) {
                        $('#codproducto').val('');
                        $('#producto').val('');
                        $('#proveedor').val('');
                        $('#precio').val('');
                        $('#cantidad').val('');
                    } else {
                        var data = $.parseJSON(response);
                        $('#codproducto').val(data.codproducto);
                        $('#producto').val(data.descripcion);
                        $('#proveedor').val(data.proveedor);
                        $('#precio').val(data.precio);
                        $('#cantidad').val(data.existencia);
                        $('#producto').prop('disabled', true);
                        $('#proveedor').removeAttr('disabled');
                        $('#precio').removeAttr('disabled');
                        $('#cantidad').removeAttr('disabled');

                    }
                },
                error: function (error) {
                }
            });
        });

    </script>
</body>

</html>