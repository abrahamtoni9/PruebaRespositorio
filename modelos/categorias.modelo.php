<?php

// requerimos la conexion
require_once "conexion.php";

class ModeloCategorias{


    /*=============================================
					GUARDAR CATEGORIA
	=============================================*/
	// funcion para guardar usuario, es llamado desde usuarios.controlador.php
	static public function mdlIngresarCategorias($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES(:categoria)");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":categoria", $datos, PDO::PARAM_STR);


		// Devuelve TRUE en caso de éxito o FALSE en caso de error.
		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}

		// cerramos la conexion
		$stmt -> close();

		// y asignamos a null
		$stmt = null;

	}











	/*=============================================
					MOSTRAR CATEGORIA
	=============================================*/


	// valores que llegan del controlador usuarios.controlador.php
	static public function mdlMostrarCategorias($tabla, $item, $valor)
	{
		// hacemos el filtro para saber si llegan parametro diferente a null, si es nulo entonces entra en else
		if($item != null)//si entra hace un select de filtro
		{
	
			// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
	
			// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
			// el primero parametro se concatena por que es una variable que utiliza el $
			//PDO::PARAM_STR quiere decir que va a recibir caracteres
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
			// ejecutamos la sentencia
			$stmt -> execute();
	
			// retornamos como un solo objecto osea una sola linea 
			return $stmt -> fetch();
			// return $stmt -> fetch_object();
			
		}
		else//sino hace select de todos los registros
		{
			// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
			// el primero parametro se concatena por que es una variable que utiliza el $
			//PDO::PARAM_STR quiere decir que va a recibir caracteres
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			// ejecutamos la sentencia
			$stmt -> execute();

			// retornamos como un  objecto de varios registros
			// return $stmt -> fetch_object();
			return $stmt -> fetchAll();
		}
		


		// cerramos la conexion
		$stm -> close();

		// y asignamos a null
		$stm = null;
	}










	 /*=============================================
					EDITAR CATEGORIA
	=============================================*/
	// funcion para guardar usuario, es llamado desde usuarios.controlador.php
	static public function mdlEditarCategorias($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id =:id ");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos['id'], PDO::PARAM_STR);


		// Devuelve TRUE en caso de éxito o FALSE en caso de error.
		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}

		// cerramos la conexion
		$stmt -> close();

		// y asignamos a null
		$stmt = null;

	}












		/*=============================================
					BORRAR CATEGORIA
		=============================================*/

	static public function mdlBorrarCategoria($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla  WHERE id = :id");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":id", $datos, PDO::PARAM_STR);


		// Devuelve TRUE en caso de éxito o FALSE en caso de error.
		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}

		// cerramos la conexion
		$stmt -> close();

		// y asignamos a null vaciamos
		$stmt = null;
	}


}