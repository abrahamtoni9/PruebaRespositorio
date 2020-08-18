<?php

class ControladorVentas
{

    /*=============================================
            CAPTURAR EL ULTIMO NRO DE VENTAS
    =============================================*/
    
    static public function ctrMostrarVentas($item, $valor)
    {

        $tabla= "ventas";

        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

        return $respuesta;
    }

    






    /*=============================================
                CREAR VENTA
    =============================================*/
    
    static public function ctrCrearVenta()
    {

        // echo $_POST["seleccionarCliente"];)
        if(isset($_POST['nuevaVenta']))
		{

            // var_dump($_POST['idVendedor']);

            /*================================================================================================
                    ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS 
            =================================================================================================*/

            $listarProductos = json_decode($_POST['listaProductos'], true);

            // var_dump($listarProductos);
            // var_dump($listarProductos["id"]);

            $totalProductoComprados = array();

            foreach ($listarProductos as $key => $value) 
            {

                // insertamos en el array las cantidades de cada producto
                array_push($totalProductoComprados, $value["cantidad"]);


                /*=======================================================
                    RECUEPERAMOS EL VALOR DE PRODUCTO POR MEDIO DEL ID
                =========================================================*/ 
                $tablaProductos = "productos";

                $item = "id";//vamos a filtrar por id del producto

                $valor = $value["id"];//codigo del producto

                // vamos a traer el valor de la venta del producto para luego actualizar 
                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
                
                var_dump($traerProducto);
                // var_dump($traerProducto['ventas']);
                

                /*==========================================================
                    ACTUALIZAMOS EL TOTAL DE VENTAS EN LA TABLA PRODUCTO
                ============================================================*/ 
                $item1a = "ventas";
                // sumamos la cantidad del producto de la venta mas la cantidad de ventas de la tabla producto
                $valor1a = $value["cantidad"] + $traerProducto["ventas"];
                // actualizamos la venta en la tabla productos
                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
                
                

                /*=============================================
                    ACTUALIZAMOS STOCK EN LA TABLA PRODUCTO
                =============================================*/                
                $item1b = "stock";
                $valor1b = $value["stock"];
                // actualizamos el stock de la tabla productos
                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

            }//fin del for

            $tablaClientes = "clientes";
            $item = "id";
            $valor = $_POST["seleccionarCliente"];

            // var_dump("valor del select : ", $valor);

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

            // var_dump($traerCliente["compras"]);
            // var_dump($traerCliente);

            $item1a = "compras";//vamos a filtrar por compras en la tabla clientes
            // //array_sum — Calcular la suma de los valores de un array,  con la funcion array_sum sumamos todos los valores de cada indice del array y obtenemos el total de la compra y le sumamos a la cantidad de compras que se encuentra en la base de datos 
            $valor1a = array_sum($totalProductoComprados) + $traerCliente['compras'];
            // $valor1aa = array_sum($totalProductoComprados);

            // var_dump("suma del array : ", $valor1aa);
            // var_dump("suma  total : ", $valor1a);

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);




            $item1b = "ultima_compra";//vamos a filtrar por ultima_compra en la tabla clientes

            date_default_timezone_get("America/Asuncion");//ajustamos la zona horaria
            
            // capturamos la fecha actual
            $fecha = date('Y-m-d'); //anio, mesa, dia 
            $hora = date('H:i:s'); //hora, minuto, segundo 

            $valor1b = $fecha.' '.$hora;
            // $valor1a = array_sum($totalProductoComprados);

            // var_dump("suma : ", $valor1a);

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);


            /*=================================
                  GUARDAR LA COMPRA 
            ==================================*/

            $tabla = "ventas";

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                            "id_cliente" => $_POST["seleccionarCliente"],
                            "codigo" => $_POST["nuevaVenta"],
                            "productos" => $_POST["listaProductos"],
                            "impuesto" => $_POST["nuevoPrecioImpuesto"],
                            "neto" => $_POST["nuevoPrecioNeto"],
                            "total" => $_POST["totalVenta"],
                            "metodo_pago" => $_POST["listaMetodoPago"]
                        );

            // var_dump($datos);

            $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

            // var_dump($respuesta);

            if($respuesta == "ok")
            {
                echo '<script>
            
                    Swal.fire({
                        type: "success",
                        title: "La venta se guardo correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result)=>{
                        if(result.value)
                        {
                            window.location = "ventas";
                        }
                    });
                    
                    </script>';
            }

        }//fin del if

    }//fin de la clase 
    
    
    
    
    
    
    
    
    
    /*=============================================
                EDITAR VENTA
    =============================================*/
    
    static public function ctrEditarVenta()
    {

        // echo $_POST["seleccionarCliente"];)
        if(isset($_POST['editarVenta']))
		{

            // var_dump($_POST['editarVenta']);
            // echo $_POST['editarVenta'];
            
            /*==============================================================
                        FORMATEAR LA TABLA PRODUCTOS Y DE CLIENTES 
            ================================================================*/
            
            $tabla = "ventas";
            
            $item = "codigo";//vamos a filtrar por id del producto
            
            $valor = $_POST["editarVenta"];//codigo del producto en la vista
            
            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
            
            // var_dump($traerVenta);
            
            
            /*==============================================================
                        REVISAR SI VIENEN PRODCUTOS EDITADOS
            ================================================================*/

            //si viene vacio entonces asignamos el valor que viene de la bd
            if($_POST["listaProductos"] == "")
            {
                $listarProductos = $traerVenta["productos"];
                $cambioProducto = false;
            }
            else // sino, entonces le asignamos el valor que viene del input de la vista
            {
                $listarProductos = $_POST["listaProductos"];
                $cambioProducto = true;
            }
            

            //si el cambio es verdadero, bandera para saber si es hay cambio en la cantidad del producto
            if($cambioProducto)
            {

                /*=========================================================================================================
                        ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS 
                ==========================================================================================================*/

                // todos los productos de la tabla ventas
                $detalleProductos = json_decode($traerVenta['productos'], true);

                // var_dump($productos);
                // var_dump($listarProductos);
                // // var_dump($listarProductos["id"]);

                $totalProductoComprados = array();


                // vamos a actualizar el stock del producto el detalle
                foreach ($detalleProductos as $key => $value) 
                {

                    // insertamos en el array las cantidades de cada producto para poder actualizar en la tabla cliente
                    array_push($totalProductoComprados, $value["cantidad"]);


                    /*=======================================================
                        RECUEPERAMOS EL VALOR DE PRODUCTO POR MEDIO DEL ID
                    =========================================================*/ 
                    $tablaProductos = "productos";

                    $item = "id";//vamos a filtrar por la columna id de la tabla producto

                    $valorIdProducto = $value["id"];//codigo del producto en el detalle, vamos sacar los datos de ese producto que se encuentra encuentra en el detalle de la venta

                    // vamos a traer el valor de del producto en la tabla venta para luego actualizar el stock en la tabla venta 
                    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valorIdProducto);
                    
                    // var_dump($traerProducto);
                    // var_dump($traerProducto['ventas']);
                    

                    /*====================================================================================================================================
                        ACTUALIZAMOS EL TOTAL DE VENTAS EN LA TABLA PRODUCTOS PARA QUE QUEDE COMO ESTABA ANTES DE HACER LA VENTA EN LA TABLA PRODUCTOS
                    ======================================================================================================================================*/ 
                    
                    $item1a = "ventas";//vamos a filtrar por compras en la tabla clientes
                    
                    //traemos los datos de total de ventas de la tabla productos y restamos a la cantidad de la tabla ventas
                    $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valorIdProducto);



                    
                    /*================================================================================================
                        ACTUALIZAMOS STOCK PARA QUE QUEDE COMO ESTABA ANTES DE HACER LA VENTA EN LA TABLA PRODUCTO
                    ==================================================================================================*/                
                    $item1b = "stock";

                    // obtenemos el nuevo valor del stock en la tabla productos si sumamos la cantidad del producto de la tabla venta mas la cantidad de stock de la tabla productoa
                    $valor1b = $value["cantidad"] + $traerProducto["stock"];

                    // actualizamos la venta en la tabla productos
                    $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valorIdProducto);
                    

                }//fin del for


                /*=======================================================================
                    RECUPERAMOS LOS DATOS DE LA TABLA CLIENTE QUE SE HIZO EN LA VENTA
                =========================================================================*/ 
                
                $tablaClientes = "clientes";
                $itemCliente = "id";
                $valorCliente = $_POST["seleccionarCliente"];

                // var_dump("valor del select : ", $valor);
                // echo "id del cliente: ", $valorCliente;

                $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            
                // var_dump($totalProductoComprados);
                // echo $totalProductoComprados;
                // var_dump(array_sum($totalProductoComprados));

                // echo '<br>';
                // echo 'suma del array : ',array_sum($totalProductoComprados);
                // echo '<br>';
                // // var_dump($traerCliente["compras"]);
                // echo 'compra del cliente en la bd : ',$traerCliente["compras"];
                // echo '<br>';
                // $valor1a =  $traerCliente["compras"] - array_sum($totalProductoComprados);
                // // var_dump($valor1a);
                // echo 'resta de las ventas del cliente : ',$valor1a;
                // die();
                
                
                $item1a = "compras";//columna compras de la cual se va a filtrar en la  tabla clientes

                // restamos a la columna compras de la tabla clientes la suma total de la cantidad de producto de la tabla venta 
                $valor1a =  $traerCliente["compras"] - array_sum($totalProductoComprados);

                // var_dump($valor1a);
                // die();

                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);
                
                // var_dump($comprasCliente);
                // die();
                
                






                
                
                /*================================================================================================
                        ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS 
                =================================================================================================*/

                // $listarProductos_2 = json_decode($_POST['listaProductos'], true);
                $listarProductos_2 = json_decode($listarProductos, true);

                // var_dump($listarProductos);
                // var_dump($listarProductos["id"]);

                $totalProductoComprados_2 = array();

                foreach ($listarProductos_2 as $key => $value) 
                {

                    // insertamos en el array las cantidades de cada producto
                    array_push($totalProductoComprados_2, $value["cantidad"]);


                    /*=======================================================
                        RECUEPERAMOS EL VALOR DE PRODUCTO POR MEDIO DEL ID
                    =========================================================*/ 
                    $tablaProductos_2 = "productos";

                    $item_2 = "id";//vamos a filtrar por id del producto

                    $valorId = $value["id"];//codigo del producto

                    // vamos a traer el valor de la venta del producto para luego actualizar 
                    $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valorId);
                    
                    // var_dump($traerProducto_2);
                    // var_dump($traerProducto['ventas']);
                    

                    /*==========================================================
                        ACTUALIZAMOS EL TOTAL DE VENTAS EN LA TABLA PRODUCTO
                    ============================================================*/ 
                    $item1a_2 = "ventas";
                    // sumamos la cantidad del producto de la venta mas la cantidad de ventas de la tabla producto
                    $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

                    // actualizamos la venta en la tabla productos
                    $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valorId);
                    
                    

                    /*=============================================
                        ACTUALIZAMOS STOCK EN LA TABLA PRODUCTO
                    =============================================*/                
                    $item1b_2 = "stock";
                    $valor1b_2 = $value["stock"];

                    // actualizamos el stock de la tabla productos
                    $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valorId);

                }//fin del for

                $tablaClientes_2 = "clientes";
                $item_2 = "id";
                $valor_2 = $_POST["seleccionarCliente"];

                // var_dump("valor del select : ", $valor);

                $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

                // var_dump($traerCliente["compras"]);
                // var_dump($traerCliente);

                $item1a_2 = "compras";//vamos a filtrar por compras en la tabla clientes

                // //array_sum — Calcular la suma de los valores de un array
                $valor1a_2 =  $traerCliente_2['compras'] + array_sum($totalProductoComprados_2);

                // var_dump("suma : ", $valor1a);



                // var_dump($totalProductoComprados_2);
                // var_dump(array_sum($totalProductoComprados_2));
                // var_dump($traerCliente_2["compras"]);
                // $valor1a =  $traerCliente_2["compras"] - array_sum($totalProductoComprados_2);
                // var_dump($valor1a);
                // die();




                $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);




                $item1b_2 = "ultima_compra";//vamos a filtrar por ultima_compra en la tabla clientes

                date_default_timezone_get("America/Asuncion");
                
                // capturamos la fecha actual
                $fecha_2 = date('Y-m-d'); //anio, mesa, dia 
                $hora_2 = date('H:i:s'); //hora, minuto, segundo 

                $valor1b_2 = $fecha_2.' '.$hora_2;
                // $valor1a = array_sum($totalProductoComprados);

                // var_dump("suma : ", $valor1a);

                $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);
            
            }//fin de la condicion cambioProducto   

            /*======================================
                  GUARDAR CAMBIOS DE LA COMPRA 
            ========================================*/

            $tabla = "ventas";

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                            "id_cliente" => $_POST["seleccionarCliente"],
                            "codigo" => $_POST["editarVenta"],
                            // "productos" => $_POST["listaProductos"],
                            "productos" => $listarProductos,
                            "impuesto" => $_POST["nuevoPrecioImpuesto"],
                            "neto" => $_POST["nuevoPrecioNeto"],
                            "total" => $_POST["totalVenta"],
                            "metodo_pago" => $_POST["listaMetodoPago"]
                        );

            // var_dump($datos);

            $respuesta_2 = ModeloVentas::mdlEditarVenta($tabla, $datos);

            // var_dump($respuesta);

            if($respuesta_2 == "ok")
            {
                echo '<script>
            
                    Swal.fire({
                        type: "success",
                        title: "La venta se edito correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result)=>{
                        if(result.value)
                        {
                            window.location = "ventas";
                        }
                    });
                    
                    </script>';
            }

        }//fin del if

    }//fin de la funcion ctrEditarVenta












    /*=============================================
                ELIMINAR VENTA
    =============================================*/
    
    static public function ctrEliminarVenta()
    {
        // var_dump($_GET['idVenta']);

        if(isset($_GET['idVenta']))
		{

            
            $tabla = "ventas";
            
            $item = "id";//vamos a filtrar por id del producto
            
            $valor = $_GET["idVenta"];//codigo del producto en la vista
            
            // traemos los valores de esa venta que queremos eliminar
            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            // var_dump($traerVenta);

            
            
            
            /*==============================================================
                            ACTUALIZAR FECHA ULTIMA VENTA 
            ================================================================*/
            
            $tablaClientes = "clientes";

            $itemVentas = null;
            
            $valorVentas = null;
            
            // trae todas las ventas 
            $traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

            $guardarFechas = array();


            foreach ($traerVentas as $key => $value) {
                
                // si los valores del id del cliente de la tabla venta es igual al id de cliente que viene del formulario 
                if ($value["id_cliente"] == $traerVenta["id_cliente"]) {
                    // entonces filtra todas  fechas de compras de ese cliente


                    // var_dump($value["fecha"]);
                    
                    // guardamos todas las fechas de la tabla ventas en el array 
                    array_push($guardarFechas, $value["fecha"]);
                    
                }
            }


            // si al borrar la venta vemos:
            // si el array contiene mas de un elemento entonces
            if(count($guardarFechas) > 1)
            {

                // si la fecha de la venta actual que se quiere eliminar es mayor a la de la penultima fecha 
                if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]) 
                {

                    $item = "ultima_compra";
                    $valor = $guardarFechas[count($guardarFechas)-2];//penultima fecha
    
                    //id del cliente que se quiere eliminar
                    $valorIdCliente = $traerVenta["id_cliente"];
    
                    // actualizamos y seteamos la penultima fecha para que figure que se hizo como la ultima compra el cliente 
                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
                    
                }
                else
                {
                    $item = "ultima_compra";
                    $valor = $guardarFechas[count($guardarFechas)-1];//ultima fecha
    
                    //id del cliente que se quiere eliminar
                    $valorIdCliente = $traerVenta["id_cliente"];
    
                    // actualizamos y seteamos la ultima fecha para que figure que se hizo como la ultima compra el cliente 
                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

                }

            }
            else //si hay solo 1 venta que se quiere eliminar de ese cliente entonces enviamos los valores
            {
                $item = "ultima_compra";
                $valor = "0000-00-00 00:00:00";

                //id del cliente que se quiere eliminar
                $valorIdCliente = $traerVenta["id_cliente"];

                // actualizamos la ultima compra en la tabla cliente cuando queremos borrar en la vista de la venta 
                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
            }
            
            var_dump($guardarFechas);




            /*========================================================
                    FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
            ==========================================================*/ 

            $detalleProductos = json_decode($traerVenta['productos'], true);

                // var_dump($productos);
                // var_dump($listarProductos);
                // // var_dump($listarProductos["id"]);

                $totalProductoComprados = array();


                // vamos a actualizar el stock del producto el detalle
                foreach ($detalleProductos as $key => $value) 
                {

                    // insertamos en el array las cantidades de cada producto para poder actualizar en la tabla cliente
                    array_push($totalProductoComprados, $value["cantidad"]);


                    /*=======================================================
                        RECUEPERAMOS EL VALOR DE PRODUCTO POR MEDIO DEL ID
                    =========================================================*/ 
                    $tablaProductos = "productos";

                    $item = "id";//vamos a filtrar por la columna id de la tabla producto

                    $valorIdProducto = $value["id"];//codigo del producto en el detalle, vamos sacar los datos de ese producto que se encuentra encuentra en el detalle de la venta

                    // vamos a traer el valor de del producto en la tabla venta para luego actualizar el stock en la tabla venta 
                    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valorIdProducto);
                    
                    // var_dump($traerProducto);
                    // var_dump($traerProducto['ventas']);
                    

                    /*====================================================================================================================================
                        ACTUALIZAMOS EL TOTAL DE VENTAS EN LA TABLA PRODUCTOS PARA QUE QUEDE COMO ESTABA ANTES DE HACER LA VENTA EN LA TABLA PRODUCTOS
                    ======================================================================================================================================*/ 
                    
                    $item1a = "ventas";//vamos a filtrar por compras en la tabla clientes
                    
                    //traemos los datos de total de ventas de la tabla productos y restamos a la cantidad de la tabla ventas
                    $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valorIdProducto);



                    
                    /*================================================================================================
                        ACTUALIZAMOS STOCK PARA QUE QUEDE COMO ESTABA ANTES DE HACER LA VENTA EN LA TABLA PRODUCTO
                    ==================================================================================================*/                
                    $item1b = "stock";

                    // obtenemos el nuevo valor del stock en la tabla productos si sumamos la cantidad del producto de la tabla venta mas la cantidad de stock de la tabla productoa
                    $valor1b = $value["cantidad"] + $traerProducto["stock"];

                    // actualizamos la venta en la tabla productos
                    $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valorIdProducto);
                    

                }//fin del for


                /*=======================================================================
                    RECUPERAMOS LOS DATOS DE LA TABLA CLIENTE QUE SE HIZO EN LA VENTA
                =========================================================================*/ 
                
                $tablaClientes = "clientes";
                $itemCliente = "id";
                $valorCliente = $traerVenta["id_cliente"];

                // var_dump("valor del select : ", $valor);

                $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            
                // var_dump($totalProductoComprados);
                // var_dump(array_sum($totalProductoComprados));
                // var_dump($traerCliente["compras"]);
                // $valor1a =  $traerCliente["compras"] - array_sum($totalProductoComprados);
                // var_dump($valor1a);
                // die();


                $item1a = "compras";//columna compras de la tabla clientes

                // restamos a la columna compras de la tabla clientes la suma total de la cantidad de producto de la tabla venta 
                $valor1a =  $traerCliente["compras"] - array_sum($totalProductoComprados);

                // var_dump($valor1a);
                // die();

                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

                // var_dump($comprasCliente);
                
                


            /*========================================================
                            ELIMINAR LA VENTA
            ==========================================================*/ 

            $respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET['idVenta']);


            if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "La venta se elimino correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "ventas";
							}
						});
						
						</script>';
				}
				else
				{
					echo '<script>
				
					Swal.fire({
						type: "error",
						title: "Ocurrio un error al eliminar la venta",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					  }).then((result)=>{
						  if(result.value)
						  {
							  window.location = "ventas";
						  }
					  });
					
					</script>';
				}


        }


    }// fin de la funcion ctrEliminarVenta











    /*=============================================
                RANGO DE FECHAS
    =============================================*/
    
    static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal)
    {
        $tabla = "ventas";

        // var_dump($fechaInicial);
        // var_dump($fechaFinal);

        $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

        // var_dump($respuesta);

        return $respuesta;
    }




} //fin de la clase