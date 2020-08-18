<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class AjaxCategorias
{
    
    
    // recogemos el idcategoria que nos manda el categorias.js
    public $idCategoria;
    
    
    
    
    /*=============================================
			RECUPERAR PARA EDITAR CATEGORIA
	=============================================*/

    public function ajaxRecEditarCategoria()
    {
        //columna de la tabla categoria
        $item = "id";
        // this hace referencia  a la variable publica o de la clase
        $valor = $this->idCategoria;
        // llamamos al metodo estatico del controlador categoria y le pasamos los parametros
        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

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
		RECUPERAR PARA EDITAR CATEGORIA
=============================================*/

// idCategoria viene del categoria.js el dato que agregamos con el append (EDITAR CATEGORIA)
if(isset($_POST['idCategoria']))
{
    // instanciamos la clase
    $editar = new AjaxCategorias();
    // asignamos a la variable publica el valor de idCategoria que viene por post
    $editar -> idCategoria = $_POST["idCategoria"];
    $editar -> ajaxRecEditarCategoria();
}



//variables post que viene del usuario.js al darle click btnActivar (ACTIAR USUARIO)
if(isset($_POST['activarUsuario']))
{
    // instanciamos la clase
    $editar = new AjaxUsuarios();
    // asignamos a la variable publica el valor de activarUsuario y activarId que viene por post 
    $editar -> activarUsuario = $_POST["activarUsuario"];
    $editar -> activarId = $_POST["activarId"];
    // ejecutamos el metodo 
    $editar -> ajaxActivarUsuario();
}




    /*=============================================
				VALIDAR CATEGORIA REPETIDO
    =============================================*/
//variables post que viene del usuario.js cuando tipeamos el campo de nuevoUsuario
if(isset($_POST['validarCategoria']))
{
    // instanciamos la clase
    $valCategoria = new AjaxCategoria();
    // asignamos a la variable publica el valor de validarCategoria que viene por post 
    $valCategoria -> validarCategoria = $_POST["validarCategoria"];
    // ejecutamos el metodo 
    $valCategoria -> ajaxValidarCategoria();
}

?>