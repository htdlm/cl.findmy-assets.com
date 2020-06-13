<?php

if (isset($_GET["myvar"])) {

    $item="admin_user";
    $valor = $_GET["myvar"];

}else{

    $item=null;
    $valor = null;

}

define("DIWEB","http://cl.findmy-assets.com/");
define("DICPY","findmy-assets.com");

require_once "../controladores/general.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios{

    public $idMaster;

	public function mostrarTabla(){


		$ruta = ControladorGeneral::ctrRuta();

        global $item,$valor;

//        $item = null;
//        $valor = null;
//        $item = "admin_user";
//        $valor = $auser;

        $usuarios = ControladorUsuarios::ctrMostrarusuarios($item, $valor);

		if(count($usuarios) == 0){

			echo '{ "data":[]}';
			return;

		}

		$datosJson = '{"data":[';

		foreach ($usuarios as $key => $value) {

			if($value["perfil"] != "admin"){

				/*=============================================
				FOTO USUARIOS
				=============================================*/	

				if($value["foto"] == ""){

					$foto = "<img src='vistas/img/usuarios/default/default.png' class='img-fluid rounded-circle' width='30px'>";

				}else{

					$foto = "<img src='".$value["foto"]."' class='img-fluid rounded-circle' width='30px'>";
				}

                $botones =  "<div class='btn-group btn-group-sm'></button><button class='btn btn-danger btn-sm btnEliminarUsuario' idUser='".$usuarios[$key]["id_usuario"]."'><i class='fa fa-times'></i></button></div>";

                $datosJson .= '[

					   "'.$key.'",
				       "'.$foto.'",
				       "'.$value["nombre"].'",
				       "'.$value["email"].'",
				       "'.$value["pais"].'",
					   "'.$value["fecha"].'",
					   "'.$botones.'"
				],';

			}

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';

		echo $datosJson;

	}
	// cierre metodo


}
// cierre clase

$activarTabla = new TablaUsuarios();
$activarTabla -> mostrarTabla();
