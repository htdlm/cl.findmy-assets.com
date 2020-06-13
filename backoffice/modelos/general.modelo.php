<?php

require_once "conexion.php";

class ModeloQuery{

    static public function mdlQuery($comando){

        $stmt = Conexion::conectar()->prepare($comando);

        $stmt -> execute();

        $resultado = $stmt -> fetchAll();

        return json_encode($resultado);

        $stmt -> close();

    }
}