<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class AjaxClientes
{
    
    
    // recogemos el idcategoria que nos manda el categorias.js
    public $idCliente;
    
    
    
    
    /*=============================================
			        EDITAR CLIENTE
	=============================================*/

    public function ajaxEditarCliente()
    {
        //columna de la tabla categoria
        $item = "id";
        // this hace referencia  a la variable publica o de la clase
        $valor = $this->idCliente;
        // llamamos al metodo estatico del controlador categoria y le pasamos los parametros
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

        // retornamos un echo codificado en json 
        echo json_encode($respuesta);
    }





    /*=============================================
				VALIDAR CATEGORIA REPETIDO
    =============================================*/

    public $validarUsuario;

    public function ajaxValidarCategoria()
    {
        // columna de la tabla categorias
        $item = "categoria";
        // this hace referencia  a la variable publica o de la clase
        $valor = $this->validarCategoria;
        // llamamos al metodo estatico del controlador categoria y le pasamos los parametros
        $respuesta = ControladorCategorias::ctrMostrarCategoria($item, $valor);

        // retornamos un echo codificado en json 
        echo json_encode($respuesta);
    }


}


/*=============================================
             EDITAR CLIENTE
=============================================*/

// idCategoria viene del categoria.js el dato que agregamos con el append (EDITAR CATEGORIA)
if(isset($_POST['idCliente']))
{
    // instanciamos la clase
    $editar = new AjaxClientes();
    // asignamos a la variable publica el valor de idCategoria que viene por post
    $editar -> idCliente = $_POST["idCliente"];
    $editar -> ajaxEditarCliente();
}


 