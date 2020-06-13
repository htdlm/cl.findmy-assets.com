<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientesFav{

/*=============================================
	 CLIENTE FAVORITO
=============================================*/

	public $idCliente;

	public function ajaxClienteFavorito(){

		$item1 = "favorito";
		$valor1 = 1;
		$valor2 = $this->idCliente;

		$respuesta = ControladorClientes::ctrActualizarCliente($item1, $valor1,$valor2);

		echo json_encode($respuesta);
	}

}

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientesFav();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxClienteFavorito();

}