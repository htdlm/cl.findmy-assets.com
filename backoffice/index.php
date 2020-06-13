<?php

define("DIWEB","http://cl.findmy-assets.com/");
define("DICPY","findmy-assets.com");


require_once "controladores/plantilla.controlador.php";
require_once "controladores/general.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/general.modelo.php";
require_once "modelos/clientes.modelo.php";

// https://github.com/PHPMailer/PHPMailer
require_once "extensiones/vendor/autoload.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();