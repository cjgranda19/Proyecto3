<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ORDEN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img class="anulada" src="img/anulado.png" alt="Anulada">
<div id="page_pdf">
    <table id="factura_head">
        <tr>
            <td class="logo_factura">
                <div>
                    <img src="img/empresa.png">
                </div>
            </td>
            <td class="info_empresa">
                <div>
                    <span class="h2">CITAVISO FABRIC</span>
                    <p>Quito - Pichincha - Ecuador</p>
                    <p>Teléfono: +(593) 000 - 000 - 0000</p>
                    <p>Email: citaviso@gmail.com</p>
                </div>
            </td>
            <td class="info_factura">
                <div class="round">
                    <span class="h3">ORDEN</span>
                    <p>No. Orden: <strong><?php echo $template_data['no_factura']; ?></strong></p>
                    <p>Fecha: <?php echo $template_data['fecha']; ?></p>
                    <p>Hora: <?php echo $template_data['hora']; ?></p>
                    <p>Vendedor: <?php echo $template_data['vendedor']; ?></p>
                </div>
            </td>
        </tr>
    </table>
    <table id="factura_cliente">
        <tr>
            <td class="info_cliente">
                <div class="round">
                    <span class="h3">Cliente</span>
                    <table class="datos_cliente">
                        <tr>
                            <td><label>Cédula:</label><p><?php echo $template_data['cedula']; ?></p></td>
                            <td><label>Teléfono:</label> <p><?php echo $template_data['telefono']; ?></p></td>
                        </tr>
                        <tr>
                            <td><label>Nombre:</label> <p><?php echo $template_data['nombre_cliente']; ?></p></td>
                            <td><label>Dirección:</label> <p><?php echo $template_data['direccion']; ?></p></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table id="factura_detalle">
        <thead>
            <tr>
                <th width="50px">Cant.</th>
                <th class="textleft">Descripción</th>
                <th class="textright" width="150px">Precio Unitario.</th>
                <th class="textright" width="150px">Precio Total</th>
            </tr>
        </thead>
        <tbody id="detalle_productos">
            <?php foreach ($template_data['productos'] as $producto) : ?>
                <tr>
                    <td class="textcenter"><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td class="textright"><?php echo $producto['precio_unitario']; ?></td>
                    <td class="textright"><?php echo $producto['precio_total']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot id="detalle_totales">
            <tr>
                <td colspan="3" class="textright"><span>SUBTOTAL Q.</span></td>
                <td class="textright"><span><?php echo $template_data['subtotal']; ?></span></td>
            </tr>
            <tr>
                <td colspan="3" class="textright"><span>IVA (12%)</span></td>
                <td class="textright"><span><?php echo $template_data['iva']; ?></span></td>
            </tr>
            <tr>
                <td colspan="3" class="textright"><span>TOTAL Q.</span></td>
                <td class="textright"><span><?php echo $template_data['total']; ?></span></td>
            </tr>
        </tfoot>
    </table>
    <div>
        <!-- Additional content if needed -->
    </div>
</div>
</body>
</html>
