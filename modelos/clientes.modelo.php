<?php

// requerimos la conexion
require_once "conexion.php";

class ModeloClientes{

 	/*=============================================
					GUARDAR CLIENTE
	=============================================*/
	// funcion para guardar clientes, es llamado desde clientes.controlador.php
	static public function mdlIngresarCliente($tabla, $datos)
	{
        // llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES(:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$stmt -> bindParam(":documento", $datos['documento'], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos['email'], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
 

		// Devuelve TRUE en caso de éxito o FALSE en caso de error.
		if($stmt->execute())
		{
			// return true;
			return "ok";
		}
		else
		{
			// return false;
			return "error";
		}

		// cerramos la conexion
		$stmt -> close();

		// y asignamos a null
		$stmt = null;
    }





    /*=============================================
					MOSTRAR CLIENTES
	=============================================*/
	// valores que llegan del controlador usuarios.controlador.php
	static public function mdlMostrarClientes($tabla, $item, $valor)
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
					EDITAR CLIENTE
	=============================================*/
	// funcion para guardar usuario, es llamado desde usuarios.controlador.php
	static public function mdlEditarCliente($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id =:id ");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
		$stmt -> bindParam(":documento", $datos['documento'], PDO::PARAM_INT);
		$stmt -> bindParam(":email", $datos['email'], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos['id'], PDO::PARAM_INT);


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

	static public function mdlEliminarCliente($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla  WHERE id = :id");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);


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







	/*=============================================
			ACTUALIZAR CLIENTE DESDE LA VENTA
	=============================================*/
	// funcion para editar usuario, es llamado desde usuarios.controlador.php
	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);//concatenamos ":".$item1,
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);//concatenamos ":".$item2,


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
}