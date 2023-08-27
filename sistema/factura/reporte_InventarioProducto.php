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

$allProducts = array(); // Un array para almacenar todos los productos

while ($row = mysqli_fetch_assoc($result)) {
    $allProducts[] = $row; // Agregar cada producto al array
}

$xmlFilePath = "reporte_global/inventario/inventarioProdcutos.xml";
$xml->save($xmlFilePath);

// Crear una instancia de FPDF con orientación horizontal
$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFont('Courier', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de Inventario Inicial', 0, 1, 'C');
$pdf->Cell(0, 10, 'Citaviso', 0, 1, 'C');

// Leer el archivo XML unificado
$xml = simplexml_load_file($xmlFilePath);
$pdf->Image('../img/favicon.png', 165, 12, 35, 35, 'PNG');
$pdf->Ln(15);

// Generar una sola tabla con todos los productos
$pdf->SetFont('Courier', 'B', 12);
$pdf->SetFillColor(179, 0, 75); // Color de fondo para encabezados de tabla
$pdf->Cell(40, 10, 'Codigo', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Proveedor', 1);
$pdf->Cell(30, 10, 'Precio Actual', 1);
$pdf->Cell(30, 10, 'Stock', 1);
$pdf->Cell(50, 10, 'Fecha Registro', 1);
$pdf->Ln();

$pdf->SetFont('Courier', '', 12);

foreach ($allProducts as $product) {
    $pdf->Cell(40, 10, utf8_decode($product['id_producto']), 1);
    $pdf->Cell(40, 10, utf8_decode($product['name']), 1);
    $pdf->Cell(40, 10, utf8_decode($product['supplier']), 1);
    $pdf->Cell(30, 10, '$' . $product['price'], 1);
    $pdf->Cell(30, 10, utf8_decode($product['stock']), 1);
    $pdf->Cell(50, 10, utf8_decode($product['date_add']), 1);
    $pdf->Ln();
}

$pdf->SetFont('Courier', 'BI', 10);
date_default_timezone_set("America/Guayaquil");
$fechaHoraActual = date("d/m/Y H:i:s");
$pdf->Cell(0, 10, utf8_decode("¡Fin de reporte!"), 0, 1, 'C');
$pdf->Cell(0, 10, utf8_decode($fechaHoraActual), 0, 1, 'C');

// Descargar el PDF
$pdfFilePath = "reporte_global/inventario/inventarioProductos.pdf";
$pdf->Output($pdfFilePath, "I");
$pdf->Output($pdfFilePath, "F");
?>
