<?php

class Conexion{

	static public function conectar()
    {
        try
        {
					//dev
          $link = new PDO("mysql:host=localhost;dbname=fa", "root", "");
					//live
					//$link = new PDO("mysql:host=localhost;dbname=fa", "root", "1f#Z9ho7}hVS8L7E");

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
