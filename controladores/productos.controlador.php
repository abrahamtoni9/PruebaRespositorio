<?php

class ControladorProductos{


	/*=============================================
					MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item,$valor)
	{

		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		// var_dump($respuesta);
		// die();

		return $respuesta; 
	}


	static public function ctrMostrarPrecios($item,$valor)
	{

		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarPrecios($tabla, $item, $valor);

		// var_dump($respuesta);
		// die();

		return $respuesta; 
	}










	

	/*=============================================
					EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto()
	{
		// $usu = $_POST['nuevaDescripcion'];
		// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";


		// hacemos el filtro cuando llegan por post

		// Devuelve true si la variable existe y tiene un valor distinto de null, false de lo contrario.
		// if(isset($_POST['nuevoCodigo']) && !empty($_POST['nuevoCodigo']))
		if(isset($_POST['editarDescripcion']))
		{

			// $descrip = $_POST['editarDescripcion'];
			// echo "<script>console.log( 'Debug Objects: " . $descrip . "' );</script>";
			// echo "<script>alert( 'Debug Objects: " . $descrip . "' );</script>";
			
			//vamos a permitir caracteres especiales con tilde,espacio en blanco y numericos  con expresion regular
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓü ]+$/', $_POST['editarDescripcion']) &&
			preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarStock']) &&
			preg_match('/^[a-zA-Z0-9.]+$/', $_POST['editarPrecioCompra']) &&
			preg_match('/^[a-zA-Z0-9.]+$/', $_POST['editarPrecioVenta']))
			{
				
			
				// $usu = $_POST['editarDescripcion'];
				// echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";
				// echo "<script>console.log( 'Debug Objects: " . $usu . "' );</script>";


				/*=============================================
							VALIDAR IMAGEN
				=============================================*/


				$ruta = "vistas/img/productos/default/anonymous.png";

				// si existe el archivo temporal del archivo file y es diferente a vacio
				if(isset($_FILES['editarImagen']['tmp_name']) && !empty($_FILES['editarImagen']['tmp_name']))
				{
					// vamos a recortar la imagen 500 x 500 px

					// list — Asignar variables como si fueran un array
					// getimagesize — Obtener el tamaño de una imagen
					//en list() toma el indice 0 de [nuevaFoto][tmp_name](los indice del archivo temporal son medidas de la imagen) y asigna a $ancho y el indice 1  asigna  a $alto 
					list($ancho, $alto) = getimagesize($_FILES['editarImagen']['tmp_name']);

					// redimensionamos
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					// creamos la ruta donde se va a guardar la imagen
					$directorio = 'vistas/img/productos/'.$_POST['editarImagen'];


					/*======================================================================================
						PRIMERO PREGUNTAMOS SI EXISTE  LA IMAGEN EN LA BD DIFERENTE A LA IMAGEN POR DEFECTO
					========================================================================================*/

					// hacemos esta condicion para que no nos borre la imagen por defecto 
					// si contiene ruta de foto y es diferente a la imagen por defecto
					if(isset($_POST['imagenActual']) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png")
					{
						unlink($_POST['imagenActual']);
					}
					else
					{
						// vamos a crear el directorio
						mkdir($directorio, 0755);
					}



					/*====================================================================
					DEACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP 
					======================================================================*/

					if($_FILES['editarImagen']['type'] == "image/jpeg")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".jpg";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefromjpeg($_FILES['editarImagen']['tmp_name']);

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

					if($_FILES['editarImagen']['type'] == "image/png")
					{
						/*=============================================
							GUARDAR LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						// le damos nombre a la imagen , y puede ser un nro aleaterio del 100 al 999
						$ruta = "vistas/img/productos/".$_POST['editarCodigo']."/".$aleatorio.".png";

						// imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
						// imagecreatefromjpeg() devuelve un identificador de imagen que representa la imagen obtenida desde el nombre de fichero dado.
						$origen = imagecreatefrompng($_FILES['editarImagen']['tmp_name']);

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

				$tabla = "productos";

				$datos = array
				(
					"id_categoria"=> $_POST['editarCategoria'],
					"codigo"=> $_POST['editarCodigo'],
					"descripcion"=> $_POST['editarDescripcion'],	
					"stock"=> $_POST['editarStock'],	
					"precio_compra"=> $_POST['editarPrecioCompra'],
					"precio_venta"=> $_POST['editarPrecioVenta'],
					"imagen"=> $ruta	
				);

				
				$usu = "categoria: ".$_POST['editarCategoria'];
				$usu .=", codigo: ". $_POST['editarCodigo'];
				$usu .=", descripcion: ". $_POST['editarDescripcion'];
				$usu .=", stock: ". $_POST['editarStock'];
				$usu .=", compra: ". $_POST['editarPrecioCompra'];
				$usu .= ", venta: ".$_POST['editarPrecioVenta'];
				$usu .= ", imagen: ".$datos['imagen'];


				echo "<script>alert( 'Debug Objects: " . $usu . "' );</script>";

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);


				// var_dump($respuesta);
				// die();

				echo "<script>console.log( 'Debug Objects: " . $respuesta . "' );</script>";
				echo "<script>console.log( typeof " . $respuesta . " );</script>";
				echo "<script>alert( '" . $respuesta . "');</script>";

				if($respuesta == "ok")
				{
					echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El producto se edito correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "productos";
							}
						});
						
						</script>';
				}
				else
				{
					echo '<script>
				
					Swal.fire({
						type: "error",
						title: "Ocurrio un error al editar",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					  }).then((result)=>{
						  if(result.value)
						  {
							  window.location = "productos";
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
					title: "El producto no puede ir vacio o lleva caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				  }).then((result)=>{
					  if(result.value)
					  {
						  window.location = "productos";
					  }
				  });
				
				</script>';
			}
		}
	}









	/*=============================================
				BORRAR PRODUCTO
	=============================================*/

	static function ctrEliminarProducto()
	{

		if(isset($_GET['idProducto']))
		{
			$tabla = "productos";
			$datos = $_GET['idProducto'];

			// vamos a eliminar la foto
			//si hay una foto y es diferente a la imagen por defecto entonces eliminamos  
			if($_GET['imagen'] != "" && $_GET['imagen'] != "vistas/img/productos/default/anonymous.png")
			{
				// unlink — Borra un fichero
				// vamos a borrar ese archivo o imagen en esa carpeta
				unlink($_GET['imagen']);

				//rmdir borra directorio o carpeta
				rmdir('vistas/img/productos/'.$_GET["codigo"]);
			}

			// solicitamos una repuesta al modelo de producto en el metodo mdlEliminarProducto
			$respuesta = ModeloProductos::mdlEliminarProducto($tabla,$datos);

			if($respuesta)
			{
				echo '<script>
				
						Swal.fire({
							type: "success",
							title: "El producto se elimino correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result)=>{
							if(result.value)
							{
								window.location = "productos";
							}
						});
						
						</script>';
			}
		}
	}
}
	

// header("Location:http://localhost/pos/inventario_venta/inicio");
// header("Location:http://localhost:81/pos/inventario_venta/inicio");
						

