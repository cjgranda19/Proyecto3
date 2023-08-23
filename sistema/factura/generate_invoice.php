<?php

include(dirname(__DIR__) . '../../conexion.php');
global $conection;

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
        LEFT JOIN recipe as r ON r.id = ordenes_recetas.id_recipe
        WHERE orden_id = {$row['id']}"
    );
    $recipes = [];

    while ($row2 = mysqli_fetch_assoc($stmt2)) {
        $recipes[] = $row2;
    }

    $row['recipes'] = $recipes;
    $orders[] = $row;
}

// Create a new XML document
$xml = new DOMDocument("1.0", "UTF-8");
$xml->formatOutput = true;

// Create root element
$root = $xml->createElement("orders");
$xml->appendChild($root);

foreach ($orders as $order) {
    $orderElement = $xml->createElement("order");
    $root->appendChild($orderElement);

    $orderElement->appendChild($xml->createElement("order_id", $order['id']));
    $orderElement->appendChild($xml->createElement("customer_name", $order['customer_name']));
    $orderElement->appendChild($xml->createElement("created_at", $order['created_at']));

    $recipesElement = $xml->createElement("recipes");
    foreach ($order['recipes'] as $recipe) {
        $recipeElement = $xml->createElement("recipe");
        $recipeElement->appendChild($xml->createElement("name", $recipe['name']));
        $recipeElement->appendChild($xml->createElement("price", $recipe['price']));
        $recipeElement->appendChild($xml->createElement("quantity", $recipe['quantity']));
        $recipeElement->appendChild($xml->createElement("total", $recipe['total']));
        $recipesElement->appendChild($recipeElement);
    }
    $orderElement->appendChild($recipesElement);

    $orderElement->appendChild($xml->createElement("subtotal", array_reduce($order['recipes'], function ($carry, $recipe) {
        return $carry + $recipe['total'];
    }, 0)));
}

// Save XML to a file
$xmlFilePath = "invoices.xml";
$xml->save($xmlFilePath);

echo "XML invoice generated successfully: $xmlFilePath";

?>
