<?php

// requerimos la conexion
require_once "conexion.php";

class ModeloUsuarios{






	/*=============================================
					MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		
		if($item != null)
		{
	
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	 
			return $stmt -> fetch();
			
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stm -> close();

		$stm = null;
	}


	
}