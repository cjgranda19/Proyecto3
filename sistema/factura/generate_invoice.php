<?php
include(dirname(__DIR__) . '../../conexion.php');
global $conection;
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

$orders = [];

$stmt = mysqli_query($conection, "SELECT * FROM ordenes");

if (!$stmt) {
    $error = mysqli_error($conection);
    echo $error;
    exit;
}

while ($row = mysqli_fetch_assoc($stmt)) {
    $stmt2 = mysqli_query(
        $conection,
        "SELECT r.*, ordenes_recetas.quantity as quantity, ordenes_recetas.quantity * r.price as total
        FROM ordenes_recetas
        LEFT JOIN recipe as r ON r.id = ordenes_recetas.receta_id
        WHERE orden_id = {$row['id']}"
    );
    $recipes = [];

    while ($row2 = mysqli_fetch_assoc($stmt2)) {
        $recipes[] = $row2;
    }

    $row['recipes'] = $recipes;
    $orders[] = $row;
    
    // Crear el documento XML para esta orden
    $xml = new DOMDocument("1.0", "UTF-8");
    $xml->formatOutput = true;
    
    $orderElement = $xml->createElement("order");
    $xml->appendChild($orderElement);
    
    foreach ($row as $key => $value) {
        if ($key == 'recipes') {
            $recipesElement = $xml->createElement("recipes");
            foreach ($value as $recipe) {
                $recipeElement = $xml->createElement("recipe");
                foreach ($recipe as $recipeKey => $recipeValue) {
                    $recipeField = $xml->createElement($recipeKey, $recipeValue);
                    $recipeElement->appendChild($recipeField);
                }
                $recipesElement->appendChild($recipeElement);
            }
            $orderElement->appendChild($recipesElement);
        } else {
            $field = $xml->createElement($key, $value);
            $orderElement->appendChild($field);
        }
    }
    
    $xmlFilePath = "data/orden_" . $row['id'] . ".xml";
    $xml->save($xmlFilePath);
    
    echo "XML file generated for order ID {$row['id']}.\n";
}
?>