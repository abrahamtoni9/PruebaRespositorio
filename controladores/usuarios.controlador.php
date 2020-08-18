<?php


class ControladorUsuarios{

	/*=============================================
				INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$tabla = "usuarios";

				// $encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

				$item = "usu_descri";
				$valor = $_POST["ingUsuario"];
				$pass = $_POST["ingPassword"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				// var_dump($respuesta);
				// die();

				if($respuesta["usu_descri"] == $_POST["ingUsuario"] && $respuesta["clave"] == $_POST["ingPassword"])
				{

					if($respuesta['estado'] == 'A')
					{

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						// $_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usu_descri"];
						// $_SESSION["foto"] = $respuesta["foto"];
						// $_SESSION["perfil"] = $respuesta["perfil"];

						echo '<script>
	
						window.location = "inicio";
	
						</script>';
					}
					else
					{
						echo '<br><div class="alert alert-danger">El usuario no esta activo, porfavor, comuniquese con el administrador</div>';
					}

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}

			







	/*=============================================
				AGREGAR USUARIOS
	=============================================*/

	// Se ejecutar en vistas/modulos/usuarios.php papra guardar el registro de usuario
	static public function ctrCrearUsuario()
	{
		// $usu = $_POST['nuevoUsuario'];
		// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";


		// hacemos el filtro cuando llegan por post

		// Devuelve true si la variable existe y tiene un valor distinto de null, false de lo contrario.
		// if(isset($_POST['nuevoUsuario']) && !empty($_POST['nuevoUsuario']))
		if(isset($_POST['nuevoUsuario']))
		{

			// $usu = $_POST['nuevoUsuario'];
			// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
			
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['nuevoNombre']) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['nuevoUsuario']) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST['nuevoPassword']))
			{
				
				/*=============================================
							VALIDAR IMAGEN
				=============================================*/


				$ruta = "";

				// si existe el archivo temporal del archivo file
				if(isset($_FILES['nuevaFoto']['tmp_name']))
				{
					// vamos a recortar la imagen 500 x 500 px

					// list — Asignar variables como si fueran un array
					// getimagesize — Obtener el tamaño de una imagen
					//en list() toma el indice 0 de [nuevaFoto][tmp_name](los indice del archivo temporal son medidas de la imagen) y asigna a $ancho y el indice 1  asigna  a $alto 
					list($ancho, $alto) = getimagesize($_FILES['nuevaFoto']['tmp_name']);

					// redimensionamos
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// creamos la ruta donde se va a guardar la imagen
					$directorio = 'vistas/img/usuarios/'.$_POST['nuevoUsuario'];

					// vamos a crear el directorio
					mkdir($directorio, 0755);


					/*====================================================================
					DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP 
					======================================================================*/

					if($_FILES['nuevaFoto']['type'] == "image/jpeg")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/usuarios/".$_POST['nuevoUsuario']."/".$aleatorio.".jpg";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefromjpeg($_FILES['nuevaFoto']['tmp_name']);

						// imagecreatetruecolor — Crear una nueva imagen de color verdadero
						// imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);


						// imagecopyresized — Copia y cambia el tamaño de parte de una imagen
						// imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
						// imagecopyresized(resource $dst_image(destino) , resource $src_image(origen) , int $dst_x(eje x izq) , int $dst_y(eje y up) , int $src_x(desde donde el corte) , int $src_y(dese el eje y) , int $dst_w(ancho de corte) , int $dst_h(alto de corte) , int $src_w(ancho de original) , int $src_h(alto original) )
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagejpeg — Exportar la imagen al navegador o a un fichero
						// imagejpeg() crea un archivo JPEG desde image.
						// $destino es donde quedo la foto recortada
						//$ruta donde vmos a guardar la foto 
						imagejpeg($destino, $ruta);
					}

					if($_FILES['nuevaFoto']['type'] == "image/png")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/usuarios/".$_POST['nuevoUsuario']."/".$aleatorio.".png";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefrompng($_FILES['nuevaFoto']['tmp_name']);

						// imagecreatetruecolor — Crear una nueva imagen de color verdadero
						// imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);


						// imagecopyresized — Copia y cambia el tamaño de parte de una imagen
						// imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
						// imagecopyresized(resource $dst_image(destino) , resource $src_image(origen) , int $dst_x(eje x izq) , int $dst_y(eje y up) , int $src_x(desde donde el corte) , int $src_y(dese el eje y) , int $dst_w(ancho de corte) , int $dst_h(alto de corte) , int $src_w(ancho de original) , int $src_h(alto original) )
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagejpeg — Exportar la imagen al navegador o a un fichero
						// imagejpeg() crea un archivo JPEG desde image.
						// $destino es donde quedo la foto recortada
						//$ruta donde vmos a guardar la foto 
						imagepng($destino, $ruta);
					}

					// var_dump($_FILES['nuevaFoto']['tmp_name']);
					// var_dump(getimagesize($_FILES['nuevaFoto']['tmp_name']));

				}


				// $usu = $_POST['nuevoUsuario'];
				// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";

				$tabla = "usuarios";

				// crypt — Hash de cadenas de un sólo sentido
				$encriptar = crypt($_POST['nuevoPassword'], '$2a$07$usesomesillystringforsalt$');

				$datos = array
				(
					"nombre"=> $_POST['nuevoNombre'],
					"usuario"=> $_POST['nuevoUsuario'],	
					"password"=> $encriptar,	
					"perfil"=> $_POST['nuevoPerfil'],
					"ruta" => $ruta	
				);

				
				// $usu = $_POST['nuevoUsuario'];
				// $nom = $_POST['nuevoNombre'];
				// $per = $_POST['nuevoPerfil'];
				// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				// echo "<script>console.log( 'Debug Objects: " . $usu . " " . $nom . " " . $per . "' );</script>";

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				// var_dump($respuesta);
				// die();

				// echo "<script>console.log( 'Debug Objects: " . $respuesta . "' );</script>";
				// echo "<script>alert( " . $respuesta . " );</script>";

				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El usuario se guardado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "usuarios";
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
					title: "El usuario no puede ir vacio o lleva caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				  }).then((result)=>{
					  if(result.value)
					  {
						  window.location = "usuarios";
					  }
				  });
				
				</script>';
			}
		}
	}











	/*=============================================
					MOSTRAR USUARIO
	=============================================*/

	// carga automatico en la vista usuarios.php ya que se instancia 
	static public function ctrMostrarUsuarios($item,$valor)
	{

		$tabla = "usuarios";
		// llamamos a la funcion del modelo de Usuario, es un metodo estatico por eso se usa ::vemos en la clase usuariomodelo la funcion (static public function mdlMostrarUsuarios($tabla, $item, $valor))
		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta; 
	}










	

	/*=============================================
					EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{
		if(isset($_POST['editarUsuario']))
		{
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
			// vamos a solo editar el nombre del usuario y no usuario para evitar crear carpeta basura en img/usuarios
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['editarNombre']))
			{
				/*=============================================
							VALIDAR IMAGEN
				=============================================*/

				// recuperamos la ruta de la imagen del input oculto
				$ruta = $_POST['fotoActual'];

				// si existe la variable $_FILE(en nuestro caso siempre existe) y viene diferente a vacio el archivo temporal de la imagen
				if(isset($_FILES['editarFoto']['tmp_name']) && !empty($_FILES['editarFoto']['tmp_name']))
				// if(isset($_FILES['editarFoto']['tmp_name']))
				{
					// vamos a recortar la imagen 500 x 500 px

					// list — Asignar variables como si fueran un array
					// getimagesize — Obtener el tamaño de una imagen
					//en list() toma el indice 0 de [nuevaFoto][tmp_name](los indice del archivo temporal son medidas de la imagen) y asigna a $ancho y el indice 1  asigna  a $alto 
					list($ancho, $alto) = getimagesize($_FILES['editarFoto']['tmp_name']);

					// redimensionamos
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// creamos la ruta donde se va a guardar la imagen
					$directorio = 'vistas/img/usuarios/'.$_POST['editarUsuario'];

					
					
					/*====================================================================
					PRIMERO PREGUNTAMOS SI EXISTE LA IMAGEN EN LA BD 
					======================================================================*/
					
					// si la ruta de la db es diferente a vacio  
					if(!empty($_POST['fotoActual']))
					{
						// unlink — Borra un fichero
						// vamos a borrar ese archivo en esa carpeta
						// console.log('foto actual');
						unlink($_POST['fotoActual']);
					}
					else
					{
						// en caso de que venga vacio, vamos a crear el directorioo carpeta
						mkdir($directorio, 0755);

					}


					/*====================================================================
					DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP 
					======================================================================*/

					if($_FILES['editarFoto']['type'] == "image/jpeg")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/usuarios/".$_POST['editarUsuario']."/".$aleatorio.".jpg";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefromjpeg($_FILES['editarFoto']['tmp_name']);

						// imagecreatetruecolor — Crear una nueva imagen de color verdadero
						// imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);


						// imagecopyresized — Copia y cambia el tamaño de parte de una imagen
						// imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
						// imagecopyresized(resource $dst_image(destino) , resource $src_image(origen) , int $dst_x(eje x izq) , int $dst_y(eje y up) , int $src_x(desde donde el corte) , int $src_y(dese el eje y) , int $dst_w(ancho de corte) , int $dst_h(alto de corte) , int $src_w(ancho de original) , int $src_h(alto original) )
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagejpeg — Exportar la imagen al navegador o a un fichero
						// imagejpeg() crea un archivo JPEG desde image.
						// $destino es donde quedo la foto recortada
						//$ruta donde vmos a guardar la foto 
						imagejpeg($destino, $ruta);
					}

					if($_FILES['editarFoto']['type'] == "image/png")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/usuarios/".$_POST['editarUsuario']."/".$aleatorio.".png";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefrompng($_FILES['editarFoto']['tmp_name']);

						// imagecreatetruecolor — Crear una nueva imagen de color verdadero
						// imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);


						// imagecopyresized — Copia y cambia el tamaño de parte de una imagen
						// imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
						// imagecopyresized(resource $dst_image(destino) , resource $src_image(origen) , int $dst_x(eje x izq) , int $dst_y(eje y up) , int $src_x(desde donde el corte) , int $src_y(dese el eje y) , int $dst_w(ancho de corte) , int $dst_h(alto de corte) , int $src_w(ancho de original) , int $src_h(alto original) )
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						// imagejpeg — Exportar la imagen al navegador o a un fichero
						// imagejpeg() crea un archivo JPEG desde image.
						// $destino es donde quedo la foto recortada
						//$ruta donde vmos a guardar la foto 
						imagepng($destino, $ruta);
					}

					// var_dump($_FILES['nuevaFoto']['tmp_name']);
					// var_dump(getimagesize($_FILES['nuevaFoto']['tmp_name']));

				}

				$tabla = "usuarios";

				
				// si el nuevo pass es diferente a vacio
				if($_POST['editarPassword'] != "")
				{
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]))
					{
						//almacenamos en la variable encriptar y encriptamos el nuevo pass y usamos el hash de tipo CRYPT_BLOWFISH
						// crypt — Hash de cadenas de un sólo sentido, se encripta la pass ingresado
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');

					}
					else
					{
						echo '<script>
				
							Swal.fire({
								type: "error",
								title: "La contrasena no puede ir vacio o lleva caracteres especiales",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then((result)=>{
								if(result.value)
								{
									window.location = "usuarios";
								}
							});
							
							</script>';
					}
				}
				else //si editarPassword viene vacio
				{
					$encriptar = $_POST["passwordActual"];
				}

				$datos = array
				(
					"nombre"=> $_POST['editarNombre'],
					"usuario"=> $_POST['editarUsuario'],	
					"password"=> $encriptar,	
					"perfil"=> $_POST['editarPerfil'],
					"ruta" => $ruta	
				);

				// llamamos al metodo mdlEditarUsuario de la clase modelo Usuario
				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				// mostramos mensaje de edicion exitosa
				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El usuario se editó correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "usuarios";
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
								window.location = "usuarios";
							}
						});
							
					</script>';	
			}
		}
	}






	/*=============================================
				BORRAR USUARIOS
	=============================================*/

	static function ctrBorrarUsuario()
	{

		if(isset($_GET['idUsuario']))
		{
			$tabla = "usuarios";
			$datos = $_GET['idUsuario'];

			// vamos a eliminar la foto
			//si hay una foto entonces eliminamos 
			if($_GET['fotoUsuario'] != "")
			{
				// unlink — Borra un fichero
				// vamos a borrar ese archivo o imagen en esa carpeta
				// unlink($_POST['fotoUsuario']);
				unlink($_GET['fotoUsuario']);

				//rmdir borra directorio
				rmdir('vistas/img/usuarios/'.$_GET["usuario"]);
			}

			// solicitamos una repuesta al modelo de usuario en el metodo mdlBorrarUsuario
			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla,$datos);

			if($respuesta)
			{
				echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El usuario se elimino correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "usuarios";
							}
						});
						
						</script>';
			}
		}
	}
}
	

						


