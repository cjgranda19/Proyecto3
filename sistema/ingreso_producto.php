<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ../");
}
include "../conexion.php";

$query_producto = mysqli_query($conection, "SELECT * FROM producto");
$query_proveedor = mysqli_query($conection, "SELECT * FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
$producto_info = array();

$query_info = mysqli_query($conection, "SELECT codproducto, precio, proveedor FROM producto");
while ($info = mysqli_fetch_assoc($query_info)) {
    $producto_info[$info['codproducto']] = array('precio' => $info['precio'], 'proveedor' => $info['proveedor']);
}

mysqli_close($conection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ingreso a Bodega</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section id="container-2">
        <div class="form_register">
            <h1>Ingreso a bodega</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert : ''; ?>
            </div>
            <span class="close-button" onclick="closePopup()">&times;</span>

            <form id="entryForm" action="process/process_entry_product.php" method="post">
                <input type="hidden" name="codproducto" id="codproducto" value="">
                <label for="producto">Producto: </label>
                <select name="producto" id="producto" required onchange="populateFieldsProductos()">
                    <option value="" disabled selected>Selecciona un producto</option>
                    <?php
                    while ($producto = mysqli_fetch_array($query_producto)) {
                        echo '<option value="' . $producto['codproducto'] . '">' . $producto['descripcion'] . '</option>';
                    }
                    ?>
                </select>



                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="proveedor" required>
                    <option value="" disabled selected>Selecciona un proveedor</option>
                    <?php
                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                        echo '<option value="' . $proveedor['id_supplier'] . '">' . $proveedor['proveedor'] . '</option>';
                    }
                    ?>
                </select>
                <label for="precio">Precio: </label>
                <input type="number" name="precio" id="precio" step="0.01" min="0">
                <label for="cantidad">Cantidad: </label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Stock" min="0">
                <div class="button-container">
                    <input type="submit" name="submit" value="Enviar" class="btn_save">
                </div>
            </form>
        </div>
    </section>

</body>

</html>