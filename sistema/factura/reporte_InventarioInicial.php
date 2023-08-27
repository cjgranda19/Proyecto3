<?php
include(dirname(__DIR__) . '../../conexion.php');
global $conection;

require "fpdf.php";

// Crear el documento XML unificado
$xml = new DOMDocument("1.0", "UTF-8");
$xml->formatOutput = true;

$productsElement = $xml->createElement("products");
$xml->appendChild($productsElement);

$query = "SELECT * FROM product_i";
$result = mysqli_query($conection, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $productElement = $xml->createElement("product");

    foreach ($row as $key => $value) {
        $field = $xml->createElement($key, $value);
        $productElement->appendChild($field);
    }

    $productsElement->appendChild($productElement);
}

$xmlFilePath = "reporte_global/inventario/inventario.xml";
$xml->save($xmlFilePath);

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Inventario Inicial', 0, 1, 'C');

// Leer el archivo XML unificado
$xml = simplexml_load_file($xmlFilePath);

// Generar el contenido del PDF utilizando los datos del XML
foreach ($xml->product as $product) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(179, 0, 75); // Color de fondo para encabezados de tabla
    $pdf->Cell(60, 10, 'Campo', 1, 0, 'C', 1);
    $pdf->Cell(0, 10, 'Valor', 1, 1, 'C', 1);
    $pdf->SetFont('Arial', '', 12);

    // Agregar cada fila de datos en la tabla
    $dataRows = array(
        array('Codigo', utf8_decode($product->id_producto)),
        array('Nombre', utf8_decode($product->name)),
        array('Proveedor', utf8_decode($product->supplier)),
        array('Precio', '$' . $product->price),
        array('Stock', utf8_decode($product->stock)),
        array('Fecha Registro', utf8_decode($product->date_add))
    );

    foreach ($dataRows as $row) {
        $pdf->Cell(60, 10, $row[0], 1);
        $pdf->Cell(0, 10, $row[1], 1, 1);
    }

    $pdf->Ln(15);
}

// Descargar el PDF
$pdfFilePath = "reporte_global/inventario/inventario.pdf";
$pdf->Output($pdfFilePath, "I");
$pdf->Output($pdfFilePath, "F");
?>
