<?php

// requerimos la conexion
require_once "conexion.php";

class ModeloProductos{







	/*=============================================
					MOSTRAR PRODUCTOS
	=============================================*/


	static public function mdlMostrarProductos($tabla, $item, $valor)
	{
		if($item != null)
		{
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY  idproducto DESC");

			$stmt = Conexion::conectar()->prepare(
				"SELECT p.idproducto, m.codigo, m.DESCRIPCION, 
					sum(p.cantidad) as  cantidadxunidad, 
					d.descripcion as deposito, mm.descripcion as VMARCAS,p.iddeposito,0 as   cantidadxcaja ,coalesce(m.talle,'ND') as talle,coalesce(col.descripcion,'ND') as color,coalesce(m.referencia,'ND') as ref
					FROM stock p
					left join productos m on m.idproducto = p.idproducto
					left join depositos d on d.iddeposito = p.iddeposito
					left join marcas mm on mm.idmarca = m.idmarca
					left join rubros rub on rub.idrubro=m.idrubro 
					left join colores col on col.idcolor = m.idcolor 
			
			 	group by p.idproducto, m.codigo, m.DESCRIPCION,d.descripcion, mm.descripcion ,
			 		p.iddeposito,coalesce(m.talle,'ND') ,coalesce(col.descripcion,'ND') ,coalesce(m.referencia,'ND')   
			 	order by m.codigo asc");
	
			// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();

		}
		else
		{
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt = Conexion::conectar()->prepare(
				"SELECT p.idproducto, m.codigo, m.DESCRIPCION, 
					sum(p.cantidad) as  cantidadxunidad, 
					d.descripcion as deposito, mm.descripcion as VMARCAS,p.iddeposito,0 as   cantidadxcaja ,coalesce(m.talle,'ND') as talle,coalesce(col.descripcion,'ND') as color,coalesce(m.referencia,'ND') as ref
					FROM stock p
					left join productos m on m.idproducto = p.idproducto
					left join depositos d on d.iddeposito = p.iddeposito
					left join marcas mm on mm.idmarca = m.idmarca
					left join rubros rub on rub.idrubro=m.idrubro 
					left join colores col on col.idcolor = m.idcolor 
			
			 	group by p.idproducto, m.codigo, m.DESCRIPCION,d.descripcion, mm.descripcion ,
			 		p.iddeposito,coalesce(m.talle,'ND') ,coalesce(col.descripcion,'ND') ,coalesce(m.referencia,'ND')   
				 order by m.codigo asc");

			// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stm -> close();

		$stm = null;
	}
	/*=============================================
					MOSTRAR PRECIOS
	=============================================*/


	static public function mdlMostrarPrecios($tabla, $item, $valor)
	{
		if($item != null)
		{
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY  idproducto DESC");

			$stmt = Conexion::conectar()->prepare(
				"SELECT 
						idproducto,codigo,descripcion,minoristaxunidad::integer,mayoristaxunidad::integer,
						costounitario::integer 
				FROM productos");
	
			// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
			$stmt -> execute();
	
			return $stmt -> fetch();

		}
		else
		{
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt = Conexion::conectar()->prepare(
				"SELECT 
						idproducto,codigo,descripcion,minoristaxunidad::integer,mayoristaxunidad::integer,
						costounitario::integer 
				FROM productos");

			// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stm -> close();

		$stm = null;
	}










	/*=============================================
					MOSTRAR PRODUCTO
	=============================================*/


	// static public function mdlMostrarProducto($tabla, $item, $valor)
	// {
	// 	if($item != null)
	// 	{
	
	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY  idproducto DESC");
	
	// 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
	// 		$stmt -> execute();
	
	// 		return $stmt -> fetch();

	// 	}
	// 	else
	// 	{
	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

	// 		$stmt -> execute();

	// 		return $stmt -> fetchAll();
	// 	}
		


	// 	// cerramos la conexion
	// 	$stm -> close();

	// 	// y asignamos a null
	// 	$stm = null;
	// }
}








