<?php

// ob_start();

require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";




class imprimirFactura
{
      
public $codigo;

public function traerImpresionFactura()
{
//traemos la informacion de la venta
$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);


$fecha = substr($respuestaVenta["fecha"],0,-8);//quitamos la hora
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"],2);   
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["total"],2);

// var_dump($respuestaVenta);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');  

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


//agregar pag 1
$pdf->AddPage();

$bloque1 = '
    
    <table>
		
		<tr>
			
            <td style="width:150px"><img src="images/logo-negro-bloque.png"></td>
            
            <td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: 71.759.963-9

					<br>
					Dirección: Calle 44B 92-11

				</div>

            </td>
            
            <td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 300 786 52 49
					
					<br>
					ventas@inventorysystem.com

				</div>
				
            </td>
            
			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>'.$valorVenta.'</td>


		</tr>

	</table>
';
//escribe el texto en la hoja
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

$bloque2 = '
    <table>
            
        <tr>
            
            <td style="width:540px"><img src="images/back.jpg"></td>
        
        </tr>

    </table>

    <table style="font-size:10px; padding:5px 10px;">
    
        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:390px">

                Cliente: '.$respuestaCliente['nombre'].'

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
            
                Fecha: '.$fecha.'

            </td>

        </tr>

        <tr>
        
            <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: '.$respuestaVendedor['nombre'].'</td>

        </tr>

        <tr>
        
            <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

        </tr>

    </table>

';

$pdf->writeHTMLCell(0, 0, '', '', $bloque2, 0, 1, 0, true, '', true);


$bloque3 = '
    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
            <td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
            <td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

        </tr>

    </table>

';

$pdf->writeHTMLCell(0, 0, '', '', $bloque3, 0, 1, 0, true, '', true);


// var_dump($productos);

foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);
    
$bloque4 = '
    <table style="font-size:10px; padding:5px 10px;">

        <tr>
            
            <td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                '.$item['descripcion'].'
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                '.$item['cantidad'].'
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                '.$valorUnitario.'
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
                '.$precioTotal.'
            </td>


        </tr>

    </table>

';

 
$pdf->writeHTMLCell(0, 0, '', '', $bloque4, 0, 1, 0, true, '', true);

}




$bloque5 = '
    <table style="font-size:10px; padding:5px 10px;">

        <tr>
            <!--COLUMNAS VACIAS-->
            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

        </tr>

        <tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ '.$neto.'
			</td>

        </tr>
        
        <tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ '.$impuesto.'
			</td>

		</tr>


    </table>

';

$pdf->writeHTMLCell(0, 0, '', '', $bloque5, 0, 1, 0, true, '', true);


// ob_end_clean();
//Close and output PDF document
$pdf->Output('factura.pdf', 'I');

}//fin del metodo traerImpresionFactura


}// fin de la clase imprimirFactura


//Instancia de la clase 
$factura = new imprimirFactura();
$factura -> codigo = $_GET['codigo']; 
$factura -> traerImpresionFactura();
