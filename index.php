<?php

//dev
//define("DIWEB","http://localhost/findmyassets/");
//live
define("DIWEB","https://cl.findmy-assets.com");
define("DICPY","findmy-assets.com");


require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "backoffice/controladores/usuarios.controlador.php";
require_once "backoffice/modelos/usuarios.modelo.php";

// https://github.com/PHPMailer/PHPMailer
require_once "backoffice/extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
