<?php


// estamos en desarrollo 2 version
// CONTROLADORES
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";

// MODELOS
require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";




// INSTANCIAMOS EL CONTROLADOR DE PLANTILLA
$plantilla = new ControladorPlantilla();

// ACCEDEMOS AL METODO QUE SE ENCUENTRA EN EL CONTROLADOR DE PLANTILLA
$plantilla -> ctrPlantilla();