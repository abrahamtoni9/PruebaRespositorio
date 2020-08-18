<?php

// PRODUCTOS
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";



class TablaProductosVentas
{
    
    /*=============================================
			MOSTRAR LA TABLA DE PRODUCTOS
	=============================================*/

    // public function mostrarTablaProductos()
    // {
    //     // echo "hola";

    //     $item = null;
    //     $valor = null;
    //     $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
 
    //     // var_dump($productos);
    //     // print($productos);
    //     // print_r($productos);
    //     // // die();
    //     // return;


    //     // echo json_encode($productos, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    //     echo json_encode($productos);
    //     // echo gettype($productos);
    //     // echo typeof($productos);
    // }


    public function mostrarTablaProductosVentas()
    {
        // echo "hola";

        $item = null;
        $valor = null;
        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
 
        // var_dump($productos);
        // print($productos);
        // print_r($productos);
        // // die();
        // return;

        $datosJson = '{
            "data": [';

            for ($i=0; $i < count($productos); $i++) { 


                /*=============================================
                        TRAEMOS LA IMAGEN DEL PRODUCTO
                =============================================*/

                $imagen = "<img src='".$productos[$i]["imagen"]."' class='img-thumbnail' width='40px'>";
          
                
                /*=============================================
                                    STOCK
                =============================================*/

                if($productos[$i]["stock"] <= 10 )
                {
                    // boton en color rojo 
                    // $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";  
                    $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                }
                elseif($productos[$i]["stock"] > 11 &&  $productos[$i]["stock"]  <= 15 )
                {
                    // boton en color amarillo
                    $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
                    // $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                }
                else 
                {
                    // boton en color verde
                    $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
                    // $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                }


                /*=============================================
                        TRAEMOS LAS ACCIONE DEL PRODUCTO
                =============================================*/
                $botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>";


                // concatenamos la variable datosJson
                $datosJson .= '  [
                    "'.($i + 1).'",
                    "'.$imagen.'",
                    "'.$productos[$i]["codigo"].'",
                    "'.$productos[$i]["descripcion"].'",
                    "'.$stock.'",
                    "'.$botones.'"
                  ],';
            }
            
            $datosJson = substr($datosJson, 0, -1);//substraemos el ultimo caracter de la variable la coma (,)
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
    $activarProductos = new TablaProductosVentas();
    $activarProductos->mostrarTablaProductosVentas();



?>