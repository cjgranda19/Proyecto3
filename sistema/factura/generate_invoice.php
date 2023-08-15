<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../../conexion.php";
require_once '../pdf/vendor/autoload.php';
use Dompdf\Dompdf;

if (empty($_GET['order_id'])) {
    echo "No es posible generar la factura.";
} else {
    $order_id = $_GET['order_id'];

    $query_order = mysqli_query($conection, "SELECT * FROM ordenes WHERE id = $order_id");
    $result_order = mysqli_fetch_assoc($query_order);

    if (!$result_order) {
        echo "Orden no encontrada.";
    } else {
        $codCliente = $result_order['user_id'];
        $noFactura = $result_order['id'];
        $anulada = '';

        // Insert into the 'Factura' table
        $totalFactura = $template_data['total']; // Adjust this based on your logic
        $insert_query = "INSERT INTO factura (nofactura, fecha, usuario, codcliente, totalfactura, estatus)
                         VALUES ($noFactura, NOW(), " . $result_order['user_id'] . ", $codCliente, $totalFactura, 1)";
        mysqli_query($conection, $insert_query);

        // Fetch the newly inserted factura details
        $query_factura = mysqli_query($conection, "SELECT f.nofactura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, f.codcliente, f.estatus,
                                                  v.nombre as vendedor,
                                                  cl.nit, cl.nombre, cl.telefono,cl.direccion
                                          FROM factura f
                                          INNER JOIN usuario v
                                          ON f.usuario = v.idusuario
                                          INNER JOIN cliente cl 
                                          ON f.codcliente = cl.idcliente
                                          WHERE f.nofactura = $noFactura AND f.codcliente = $codCliente  AND f.estatus != 10 ");
        $factura = mysqli_fetch_assoc($query_factura);

        // Define the data you want to pass to the template
        $template_data = array(
            'no_factura' => $factura['nofactura'],
            'fecha' => $factura['fecha'],
            'hora' => $factura['hora'],
            'vendedor' => $factura['vendedor'],
            'cedula' => $factura['nit'],
            'telefono' => $factura['telefono'],
            'nombre_cliente' => $factura['nombre'],
            'direccion' => $factura['direccion'],
            'productos' => array(),
            'subtotal' => 0,
            'iva' => 0,
            'total' => 0
        );
        // Fetch and populate the productos array
        $query_productos = mysqli_query($conection, "SELECT * FROM detalle_temp WHERE token_user = '$codCliente'");
        while ($row = mysqli_fetch_assoc($query_productos)) {
            $producto = array(
                'cantidad' => $row['cantidad'],
                'descripcion' => '',
                // Obtener la descripción del producto basado en $row['codproducto']
                'precio_unitario' => $row['precio_venta'],
                'precio_total' => $row['precio_venta'] * $row['cantidad']
            );
            $template_data['productos'][] = $producto;
            $template_data['subtotal'] += $producto['precio_total'];
            // Calcular el IVA y el total basado en el subtotal
            // ...
        }

        // Calculate IVA and total based on subtotal
        $template_data['iva'] = $template_data['subtotal'] * 0.12; // Ejemplo de cálculo de IVA (12%)
        $template_data['total'] = $template_data['subtotal'] + $template_data['iva'];

        // Code for generating and rendering the PDF
        ob_start();
        include(__DIR__ . '/factura_template.php'); // Reemplaza con la ubicación de tu archivo de plantilla real
        $html = ob_get_clean();

        // Instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);
        // (Optional) Configura el tamaño de papel y la orientación
        $dompdf->setPaper('letter', 'portrait');
        // Renderiza el HTML como PDF
        $dompdf->render();
        // Muestra el PDF generado en el navegador
        $dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
        exit;
    }
}