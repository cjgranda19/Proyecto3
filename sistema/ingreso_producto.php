<?php
session_start();
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}
include "../conexion.php";

$codproducto = ""; // Define el valor inicial del código del producto
$producto = "";    // Define el valor inicial del nombre del producto

if (isset($_GET['codproducto'])) {
    // Obtener el ID del producto desde la URL
    $codproducto = $_GET['codproducto'];

    // Obtener los datos del producto desde la base de datos
    $query_producto = mysqli_query($conection, "SELECT * FROM producto WHERE codproducto = $codproducto");
    $result_producto = mysqli_fetch_assoc($query_producto);

    // Asignar los valores de la base de datos a las variables
    if ($result_producto) {
        $producto = $result_producto['nombre_producto'];
        // Puedes obtener otros valores aquí si es necesario
    }
}

$query_proveedor = mysqli_query($conection, "SELECT id_supplier, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ingreso a Bodega</title>
    <!-- Tus estilos y enlaces a archivos CSS -->
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
                <input type="hidden" name="codproducto" id="codproducto" value="<?php echo $codproducto; ?>">
                <label for="producto">Producto: </label>
                <input type="text" name="producto" id="producto" placeholder="Nombre del producto"
                    value="<?php echo $producto; ?>">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="proveedor" required>
                    <option value="" disabled selected>Selecciona un proveedor</option>
                    <?php
                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                        $selected = ($proveedor['id_supplier'] == $result_producto['proveedor_id']) ? 'selected' : '';
                        echo "<option value='{$proveedor['id_supplier']}' $selected>{$proveedor['proveedor']}</option>";
                    }
                    ?>
                </select>
                <label for="precio">Precio: </label>
                <input type="number" name="precio" id="precio" step="0.01"
                    value="<?php echo isset($result_producto['precio']) ? $result_producto['precio'] : ''; ?>"
                    required>
                <label for="cantidad">Cantidad: </label>
                <!-- El campo de cantidad solo se puede aumentar -->
                <input type="number" name="cantidad" id="cantidad" placeholder="Stock" min="0" required>
                <div class="button-container">
                    <input type="submit" name="submit" value="Enviar" class="btn_save">
                </div>
            </form>
        </div>
    </section>
</body>

</html>
