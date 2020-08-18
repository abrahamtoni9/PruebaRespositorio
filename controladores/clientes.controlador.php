<?php

class ControladorClientes
{
    /*=============================================
				AGREGAR CLIENTE
	=============================================*/
 
	static public function ctrCrearCliente()
	{
		if(isset($_POST['nuevoCliente']))
		{

			// $usu = $_POST['nuevaDescripcion'];
			// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
			
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]))
            //  &&
            // preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
            // preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
            // preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
            // preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]))
            {
				$usu = $_POST['nuevoCliente'];
				echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";


				$tabla = "clientes";

				$datos = array
				(
					"nombre"=> $_POST['nuevoCliente'],
					"documento"=> $_POST['nuevoDocumentoId'],
					"email"=> $_POST['nuevoEmail'],	
					"telefono"=> $_POST['nuevoTelefono'],	
					"direccion"=> $_POST['nuevaDireccion'],
					"fecha_nacimiento"=> $_POST['nuevaFechaNacimiento']
				);

				
                // $usu = "nombre: ".$_POST['nuevoCliente'];
				// $usu .=", documento: ". $_POST['nuevoDocumentoId'];
				// $usu .=", email: ". $_POST['nuevoEmail'];
				// $usu .=", telefono: ". $_POST['nuevoTelefono'];
				// $usu .=", direccion: ". $_POST['nuevaDireccion'];
				// $usu .= ", fecha_nacimiento: ".$_POST['nuevaFechaNacimiento'];


				// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				// echo "<script>console.log( 'Debug Objects: " . $usu . " " . $nom . " " . $per . "' );</script>";

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);


				// var_dump($respuesta);
				// die();

				// echo "<script>console.log( 'Debug Objects: " . $respuesta . "' );</script>";
				// echo "<script>console.log( typeof " . $respuesta . " );</script>";
				// echo "<script>alert( '" . $respuesta . "');</script>";

				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El cliente se guardo correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
						
						</script>';
				}
				else
				{
					echo '<script>
				
					Swal.fire({
						type: "error",
						title: "Ocurrio un error al insertar",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					  }).then((result)=>{
						  if(result.value)
						  {
							  window.location = "clientes";
						  }
					  });
					
					</script>';
				}

			}
			else
			{
				echo '<script>
				
				Swal.fire({
					type: "error",
					title: "El cliente no puede ir vacio o lleva caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				  }).then((result)=>{
					  if(result.value)
					  {
						  window.location = "clientes";
					  }
				  });
				
				</script>';
			}
		}
    }
    




    /*=============================================
				MOSTRAR CLIENTE
	=============================================*/
 
    static public function ctrMostrarClientes($item,$valor)
    {
        $tabla = "clientes";
		// llamamos a la funcion del modelo de cliente, es un metodo estatico por eso se usa ::vemos en la clase clientemodelo la funcion (static public function mdlMostrarCategorias($tabla, $item, $valor))
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		// var_dump($respuesta);
		// die();

		return $respuesta; 
	}
	






	/*=============================================
					EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente()
	{
		if(isset($_POST['editarCliente']))
		{
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
			// vamos a solo editar el nombre del usuario y no usuario para evitar crear carpeta basura en img/usuarios
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['editarCliente']))
			{
				

				$tabla = "clientes";

				$datos = array
				(
					"id"=> $_POST['idCliente'],
					"nombre"=> $_POST['editarCliente'],
					"documento"=> $_POST['editarDocumentoId'],
					"email"=> $_POST['editarEmail'],	
					"telefono"=> $_POST['editarTelefono'],	
					"direccion"=> $_POST['editarDireccion'],
					"fecha_nacimiento"=> $_POST['editarFechaNacimiento']
				);

				// llamamos al metodo mdlEditarCategoria de la clase modelo Categoria
				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				// mostramos mensaje de edicion exitosa
				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El cliente se editó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
						
						</script>';
				}

			}
			else
			{
				echo '<script>
				
						Swal.fire({
							type: "error",
							title: "El cliente no puede ir vacio o lleva caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
							
					</script>';	
			}
		}
	}






	/*=============================================
				BORRAR CLIENTE
	=============================================*/

	static function ctrEliminarCliente()
	{

		if(isset($_GET['idCliente']))
		{

			// $usu = $_GET['idCliente'];
			// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
			$tabla = "clientes";
			$datos = $_GET['idCliente'];

			// solicitamos una repuesta al modelo de usuario en el metodo mdlBorrarUsuario
			$respuesta = ModeloClientes::mdlEliminarCliente($tabla,$datos);

			var_dump($respuesta);
			// die();


			// echo "<script>console.log( 'Debug Objects: " . $respuesta . "' );</script>";
			// echo "<script>console.log( typeof " . $respuesta . " );</script>";
			// echo "<script>alert( '" . $respuesta . "');</script>";

			if($respuesta == "ok")
			{
				echo '<script>
			
					Swal.fire({
						type: "success",
						title: "El cliente se elimino correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value)
						{
							window.location = "clientes";
						}
					});
					
					</script>';
			}
			else
			{
				echo '<script>
				
						Swal.fire({
							type: "error",
							title: "Se produjo un error al querer eliminar el cliente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "clientes";
							}
						});
							
					</script>';	
			}
		}
	}






	/*================================================================
				AGREGAR CLIENTE DESDE LA VISTAR CREAR-VENTA
	==================================================================*/
 
	static public function ctrCrearClienteDesdeVenta()
	{
		if(isset($_POST['nuevoCliente']))
		{

			// $usu = $_POST['nuevaDescripcion'];
			// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
			
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]))
            //  &&
            // preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
            // preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
            // preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && 
            // preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"]))
            {
				$usu = $_POST['nuevoCliente'];
				echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";


				$tabla = "clientes";

				$datos = array
				(
					"nombre"=> $_POST['nuevoCliente'],
					"documento"=> $_POST['nuevoDocumentoId'],
					"email"=> $_POST['nuevoEmail'],	
					"telefono"=> $_POST['nuevoTelefono'],	
					"direccion"=> $_POST['nuevaDireccion'],
					"fecha_nacimiento"=> $_POST['nuevaFechaNacimiento']
				);

				
                // $usu = "nombre: ".$_POST['nuevoCliente'];
				// $usu .=", documento: ". $_POST['nuevoDocumentoId'];
				// $usu .=", email: ". $_POST['nuevoEmail'];
				// $usu .=", telefono: ". $_POST['nuevoTelefono'];
				// $usu .=", direccion: ". $_POST['nuevaDireccion'];
				// $usu .= ", fecha_nacimiento: ".$_POST['nuevaFechaNacimiento'];


				// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				// echo "<script>console.log( 'Debug Objects: " . $usu . " " . $nom . " " . $per . "' );</script>";

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);


				// var_dump($respuesta);
				// die();

				// echo "<script>console.log( 'Debug Objects: " . $respuesta . "' );</script>";
				// echo "<script>console.log( typeof " . $respuesta . " );</script>";
				// echo "<script>alert( '" . $respuesta . "');</script>";

				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El cliente se guardo correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "crear-venta";
							}
						});
						
						</script>';
				}
				else
				{
					echo '<script>
				
					Swal.fire({
						type: "error",
						title: "Ocurrio un error al insertar",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					  }).then((result)=>{
						  if(result.value)
						  {
							  window.location = "crear-venta";
						  }
					  });
					
					</script>';
				}

			}
			else
			{
				echo '<script>
				
				Swal.fire({
					type: "error",
					title: "El cliente no puede ir vacio o lleva caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				  }).then((result)=>{
					  if(result.value)
					  {
						  window.location = "crear-venta";
					  }
				  });
				
				</script>';
			}
		}
    }
}