<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class AjaxUsuarios
{
    
    
    // recogemos el idusuario que nos manda el usuarios.js
    public $idUsuario;
    
    
    
    
    /*=============================================
					EDITAR USUARIO
	=============================================*/

    public function ajaxEditarUsuario()
    {
        //columna de la tabla usuarios
        $item = "id";
        // this hace referencia  a la variable publica o de la clase
        $valor = $this->idUsuario;
        // llamamos al metodo estatico del controlador usuario y le pasamos los parametros
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        // retornamos un echo codificado en json 
        echo json_encode($respuesta);
    }



    // vamos a capturar las dos variables post que viene del usuario.js al darle click btnActivar (ACTIAR USUARIO)
    public $activarUsuario;
    public $activarId;
    /*=============================================
					ACTIVAR USUARIO
	=============================================*/

    public function ajaxActivarUsuario()
    {
        //tabla de la bd
        $tabla = "usuarios";
        //columnas de la tabla u  suarios
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $item2 = "id";
        $valor2 = $this->activarId;
        //  llama al metodo del modelo de usuario y retorna la cadena ok o error
        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2); 
    }




    /*=============================================
				VALIDAR USUARIO REPETIDO
    =============================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {
        // columna de la tabla usuarios
        $item = "usuario";
        // this hace referencia  a la variable publica o de la clase
        $valor = $this->validarUsuario;
        // llamamos al metodo estatico del controlador usuario y le pasamos los parametros
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        // retornamos un echo codificado en json 
        echo json_encode($respuesta);
    }


}


/*=============================================
			INSTANCIA DE EDITAR USUARIO
=============================================*/

// idUsuario viene del usuario.js el dato que agregamos con el append (EDITAR USUARIO)
if(isset($_POST['idUsuario']))
{
    // instanciamos la clase
    $editar = new AjaxUsuarios();
    // asignamos a la variable publica el valor de idUsuario que viene por post
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
}




/*=============================================
		INSTANCIA DE ACTIVAR USUARIO
=============================================*/
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
			INSTANCIA DE  USUARIO REPETIDO
    =============================================*/
//variables post que viene del usuario.js cuando tipeamos el campo de nuevoUsuario
if(isset($_POST['validarUsuario']))
{
    // instanciamos la clase
    $valUsuario = new AjaxUsuarios();
    // asignamos a la variable publica el valor de validarUsuario que viene por post 
    $valUsuario -> validarUsuario = $_POST["validarUsuario"];
    // ejecutamos el metodo 
    $valUsuario -> ajaxValidarUsuario();
}

?>