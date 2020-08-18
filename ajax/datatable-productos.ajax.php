<?php

// PRODUCTOS
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

//CATEGORIAS
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos
{
    
    /*=============================================
			MOSTRAR LA TABLA DE PRODUCTOS
	=============================================*/


    public function mostrarTablaProductos()
    {

        $item = null;
        $valor = null;
        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        var_dump($productos);
 
      
        $datosJson = '{
            "data": [';

            for ($i=0; $i < count($productos); $i++) { 
          
                /*==========================================
                            BOTON DE STOCK
                ===========================================*/

                if($productos[$i]['cantidadxunidad'] <= 5)
                {   //ROJO
                    $stock = "<button class='btn btn-danger'>".$productos[$i]['cantidadxunidad']."</button>";
                }
                else if($productos[$i]['cantidadxunidad'] > 6 && $productos[$i]['cantidadxunidad'] <= 10)
                {   //AMARILLO
                    $stock = "<button class='btn btn-warning'>".$productos[$i]['cantidadxunidad']."</button>"; 
                }
                else
                {   //VERDE
                    $stock = "<button class='btn btn-success'>".$productos[$i]['cantidadxunidad']."</button>";
                }

                $datosJson .= '  
                [
                    "'.($i + 1).'",
                    "'.$productos[$i]["codigo"].'",
                    "'.$productos[$i]["deposito"].'",
                    "'.$productos[$i]["descripcion"].'",
                    "'.$productos[$i]["talle"].'",
                    "'.$productos[$i]["color"].'",
                    "'.$productos[$i]["ref"].'",
                    "'.$productos[$i]["vmarcas"].'",
                    "'.$stock.'"
                ],';
            }
            
            $datosJson = substr($datosJson, 0, -1);
            $datosJson .='
            ]
        }';

        echo $datosJson;
        // echo json_encode($productos);
        // echo gettype($productos);
        // echo typeof($productos);
        
    }//fin de la funcion 

}//fin de la clase TablaProductos



    /*=============================================
				ACTIVAR LA TABLA DE PRODUCTO
    =============================================*/

    // intanciamos la clase
    $activarProductos = new TablaProductos();
    $activarProductos->mostrarTablaProductos();



?>