<?php


class ControladorGeneral{

	static public function ctrRuta(){

		return DIWEB;

	}

	static public function ctrValorSuscripcion(){

		return 10;

	}
	
	static public function ctrPatrocinador(){

		return "find-my-assets";

	}

    /*=============================================
    Query
    =============================================*/

    static public function ctrQuery($comando){

        $respuesta = ModeloQuery::mdlQuery($comando);

        return $respuesta;

    }

}