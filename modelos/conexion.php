<?php

class Conexion{

	static public function conectar(){
		
		$link =  new PDO("pgsql:host=localhost;port=5432;dbname=bdgarden","postgres","123");

		$link->exec("SET NAMES UTF-8");

		return $link;

	}

}