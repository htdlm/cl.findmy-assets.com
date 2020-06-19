<?php

class Conexion{

	static public function conectar()
    {
        try
        {
                $link = new PDO("mysql:host=localhost;dbname=fa",
                    "root",
                    "");

                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $link->exec("set names utf8");

                return $link;

        } catch (PDOException $e)
        {
            echo "Error Abriendo DB: ".$e->getMessage();
            return $e->getMessage();
        }
	}
}
