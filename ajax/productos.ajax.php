<?php
// PRODUCTOS
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

//CATEGORIAS
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxProductos
{


     /*=================================================
        GENERARA CODIGO APARTIR DE ID CATEGORIA
    ==================================================*/

    public $idCategoria; 

    public function ajaxCrearCodigoProducto()
    {

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);//devuelve json codificado
        // echo ($respuesta);

    } //fin de la clase ajaxCrearCodigoProducto




    
    /*=================================================
                    EDITAR PRODUCTO
    ==================================================*/

    public $idProducto; 
    public $traerProductos; 
    public $nombreProducto; 

    public function ajaxEditarProducto()
    {
        // $traerProductos viene de ventas.js
        if ($this->traerProductos == "ok") {
            
            // traemos todos los productos
            $item = null;
            $valor = null;
    
            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
    
            echo json_encode($respuesta);//devuelve json codificado
            // echo ($respuesta);
            
        }
        else if($this->nombreProducto != "")//si viene diferente a vacio
        {
            // selecccionamos el productos por descripcion y vamos a traer            
            $item = "descripcion";
            $valor = $this->nombreProducto;
    
            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
    
            echo json_encode($respuesta);//devuelve json codificado
            // echo ($respuesta);

        }
        else
        {
            // selecccionamos el productos que vamos a traer            
            $item = "id";
            $valor = $this->idProducto;
    
            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
    
            echo json_encode($respuesta);//devuelve json codificado
            // echo ($respuesta);

        }

    } //fin de la clase ajaxEditarProducto


}//fin de la clase AjaxProductos





/*=================================================
    GENERARA CODIGO APARTIR DE ID CATEGORIA
==================================================*/
if(isset($_POST['idCategoria']))
{
    $codigoProducto = new AjaxProductos();
    $codigoProducto -> idCategoria = $_POST["idCategoria"];
    $codigoProducto -> ajaxCrearCodigoProducto();
}







/*=================================================
                EDITAR PRODUCTO
==================================================*/
if(isset($_POST['idProducto']))
{
    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();
}




/*=================================================
                TRAER PRODUCTOS
==================================================*/
if(isset($_POST['traerProductos']))
{
    $traerProductos = new AjaxProductos();
    $traerProductos -> traerProductos = $_POST["traerProductos"];
    $traerProductos -> ajaxEditarProducto();
}




/*=================================================
                TRAER PRODUCTOS
==================================================*/
if(isset($_POST['nombreProducto']))
{
    $nombreProducto = new AjaxProductos();
    $nombreProducto -> nombreProducto = $_POST["nombreProducto"];
    $nombreProducto -> ajaxEditarProducto();
}



?>