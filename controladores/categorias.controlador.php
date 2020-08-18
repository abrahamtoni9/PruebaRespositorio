<?php

class ControladorCategorias
{
    /*=============================================
                  CREAR CATEGORIA
    =============================================*/

    static public function ctrCrearCategoria()
    {

 

        if(isset($_POST['nuevaCategoria']))
		{

			// $usu = $_POST['nuevoUsuario'];
			// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
			
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['nuevaCategoria']))
            {
				$tabla = 'categorias';

				$datos = $_POST['nuevaCategoria'];
		
				$respuesta = ModeloCategorias::mdlIngresarCategorias($tabla, $datos);

				
				if($respuesta == "ok")
				{
					echo '<script>
						
								Swal.fire({
									type: "success",
									title: "La categoria se guardado correctamente!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									closeOnConfirm: false
								}).then((result)=>{
									if(result.value)
									{
										window.location = "categorias";
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
					title: "La categoria no puede ir vacio o lleva caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				  }).then((result)=>{
					  if(result.value)
					  {
						  window.location = "categorias";
					  }
				  });
				
				</script>';
			}
        }  
	}
	




	/*=============================================
                  MOSTRAR CATEGORIA
    =============================================*/

    static public function ctrMostrarCategorias($item,$valor)
    {
		$tabla = "categorias";
		// llamamos a la funcion del modelo de Categoria, es un metodo estatico por eso se usa ::vemos en la clase categoriamodelo la funcion (static public function mdlMostrarCategorias($tabla, $item, $valor))
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		// var_dump($respuesta);
		// die();

		return $respuesta; 
	}











	/*=============================================
					EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria()
	{
		if(isset($_POST['editarCategoria']))
		{
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
			// vamos a solo editar el nombre del usuario y no usuario para evitar crear carpeta basura en img/usuarios
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['editarCategoria']))
			{
				

				$tabla = "categorias";

				$datos = array(
								"categoria" => $_POST["editarCategoria"],
								"id" => $_POST["idCategoria"]);

				// llamamos al metodo mdlEditarCategoria de la clase modelo Categoria
				$respuesta = ModeloCategorias::mdlEditarCategorias($tabla, $datos);

				// mostramos mensaje de edicion exitosa
				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "La categoria se editó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "categorias";
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
							title: "El nombre no puede ir vacio o lleva caracteres especiales",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "categorias";
							}
						});
							
					</script>';	
			}
		}
	}







	/*=============================================
				BORRAR CATEGORIA
	=============================================*/

	static function ctrBorrarCategoria()
	{

		if(isset($_GET['idCategoria']))
		{
			$tabla = "categorias";
			$datos = $_GET['idCategoria'];

			// solicitamos una repuesta al modelo de usuario en el metodo mdlBorrarUsuario
			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla,$datos);

			if($respuesta == "ok")
			{
				echo '<script>
			
					Swal.fire({
						type: "success",
						title: "La categoria se elimino correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value)
						{
							window.location = "categorias";
						}
					});
					
					</script>';
			}
		}
	}
}
