<?php

// requerimos la conexion
require_once "conexion.php";

class ModeloVentas{



    /*=======================================================
					MOSTRAR ULTIMO CODIGO DE VENTAS
    =========================================================*/
    
    static public function mdlMostrarVentas($tabla, $item, $valor)
	{
		// hacemos el filtro para saber si llegan parametro diferente a null, si es nulo entonces entra en else
		if($item != null)
		{
	
			// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");
	
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
		else
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







	/*=======================================================
					EDITAR VENTA
	=========================================================*/
	
	static public function mdlEditarVenta($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total = :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);
		$stmt -> bindParam(":id_cliente", $datos['id_cliente'], PDO::PARAM_INT);
		$stmt -> bindParam(":id_vendedor", $datos['id_vendedor'], PDO::PARAM_INT);
		$stmt -> bindParam(":productos", $datos['productos'], PDO::PARAM_STR);
		$stmt -> bindParam(":impuesto", $datos['impuesto'], PDO::PARAM_STR);
		$stmt -> bindParam(":neto", $datos['neto'], PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos['total'], PDO::PARAM_STR);
		$stmt -> bindParam(":metodo_pago", $datos['metodo_pago'], PDO::PARAM_STR);

		// var_dump($stmt);

		// return;


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







	/*=======================================================
					GUARDAR VENTA
	=========================================================*/
	
	static public function mdlIngresarVenta($tabla, $datos)
	{
		// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago) VALUES(:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago)");

		// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
		//PDO::PARAM_STR quiere decir que va a recibir caracteres
		$stmt -> bindParam(":codigo", $datos['codigo'], PDO::PARAM_INT);
		$stmt -> bindParam(":id_cliente", $datos['id_cliente'], PDO::PARAM_INT);
		$stmt -> bindParam(":id_vendedor", $datos['id_vendedor'], PDO::PARAM_INT);
		$stmt -> bindParam(":productos", $datos['productos'], PDO::PARAM_STR);
		$stmt -> bindParam(":impuesto", $datos['impuesto'], PDO::PARAM_STR);
		$stmt -> bindParam(":neto", $datos['neto'], PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos['total'], PDO::PARAM_STR);
		$stmt -> bindParam(":metodo_pago", $datos['metodo_pago'], PDO::PARAM_STR);

		// var_dump($stmt);

		// return;


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
				ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos)
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
				RANGO DE FECHAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
	{

		// var_dump($fechaInicial);
		// var_dump($fechaFinal);

		if($fechaInicial == null)
		{
			// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");
	
			// ejecutamos la sentencia
			$stmt -> execute();
	
			// retornamos como un solo objecto de varias linea 
			return $stmt -> fetchAll();
			// return $stmt -> fetch_object();
		}
		else if($fechaInicial == $fechaFinal) 
		{
			// llamamos a la clase conexion y al metodo statico conectar y a la vez vamos a preparar la sentencia sql
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha LIKE '%$fechaFinal%'");
	
			// PDOStatement::bindParam — Vincula un parámetro al nombre de variable especificado
			// el primero parametro se concatena por que es una variable que utiliza el $
			//PDO::PARAM_STR quiere decir que va a recibir caracteres
			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
	
			// ejecutamos la sentencia
			$stmt -> execute();
	
			// var_dump($stmt);
			// retornamos como un solo objecto osea una sola linea 
			return $stmt -> fetchAll();
			// return $stmt -> fetch_object();
		}
		else
		{
			date_default_timezone_set('America/Asuncion');

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));//adicionar un dia mas
			$fechaActualMasUno = $fechaActual->format("Y-m-d");
			
			// $date1 = new DateTime();
			// $eightynine_days_ago = new DateInterval( "P6D" );//resta 6 dias
			// $eightynine_days_ago->invert = 1; //Make it negative.
			// $date1->add( $eightynine_days_ago );
			// $fecha7 = $date1->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			// var_dump($fechaActual);
			// var_dump($fechaActualMasUno);
			// var_dump($fechaFinalMasUno);
			// var_dump($fecha7);
			// die();

			if($fechaFinalMasUno == $fechaActualMasUno)
			{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}
			else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}

			// ejecutamos la sentencia
			$stmt -> execute();

			// retornamos como un  objecto de varios registros
			// return $stmt -> fetch_object();
			return $stmt -> fetchAll();
		}

		// Devuelve TRUE en caso de éxito o FALSE en caso de error.
		// if($stmt->execute())
		// {
		// 	return "ok";
		// }
		// else
		// {
		// 	return "error";
		// }

		// // cerramos la conexion
		// $stmt -> close();

		// // y asignamos a null vaciamos
		// $stmt = null;
	}

}