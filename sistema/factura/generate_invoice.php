<?php
include(dirname(__DIR__) . '../../conexion.php');
global $conection;
if ($_SESSION['rol'] != 1) {
    header("location: ./");
}

if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

    $stmt = mysqli_query($conection, "SELECT * FROM ordenes WHERE id = $orderId");

    if ($stmt) {
        $order = mysqli_fetch_assoc($stmt);

        // Create a new XML document
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;

        // Create root element
        $root = $xml->createElement("order");
        $xml->appendChild($root);

        $root->appendChild($xml->createElement("order_id", $order['id']));
        $root->appendChild($xml->createElement("customer_name", $order['customer_name'])); 
        $root->appendChild($xml->createElement("created_at", $order['created_at']));

        // ... (añadir más elementos XML según tus necesidades)

        // Save XML to a file
        $xmlFilePath = "data/invoices" . $orderId . ".xml";
        $xml->save($xmlFilePath);

        echo "XML invoice generated successfully for order $orderId: $xmlFilePath";
    } else {
        echo "Error fetching order data from the database.";
    }
} else {
    echo "Invalid or missing order ID.";
}
?>