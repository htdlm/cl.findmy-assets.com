<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, rfc, razon_social, documento, email, telefono, direccion, ciec_pass, fea_pass, admin_user) VALUES (:nombre, :rfc, :razon_social, :documento, :email, :telefono, :direccion, :ciec_pass, :fea_pass, :admin_user)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":ciec_pass", $datos["ciec_pass"], PDO::PARAM_STR);
        $stmt->bindParam(":fea_pass", $datos["fea_pass"], PDO::PARAM_STR);
        $stmt->bindParam(":admin_user", $datos["admin_user"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


/*=============================================
LEER CLIENTE FAVORITO
=============================================*/

    static public function mdlLeerFavoritoClientes($tabla,$adminItem,$adminValor)
    {

        $isql = "SELECT * FROM $tabla where $adminItem = $adminValor and favorito = 1";
        $stmt = Conexion::conectar()->prepare($isql);
        $stmt->execute();
        return $stmt->fetch();

        $stmt -> close();
        $stmt = null;

    }



    /*=============================================
    MOSTRAR CLIENTES
    =============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

		if($item != null) {

		    if ($item != "admin_user"){

                $isql = "SELECT * FROM $tabla WHERE $item = $valor";
                $stmt = Conexion::conectar()->prepare($isql);
                $stmt -> execute();
                return $stmt -> fetch();

            }else{

                $isql = "SELECT * FROM $tabla WHERE $item = $valor";
                $stmt = Conexion::conectar()->prepare($isql);
                $stmt -> execute();
                return $stmt -> fetchall();
           }
		}else{
            $isql="SELECT * FROM $tabla";
			$stmt = Conexion::conectar()->prepare($isql);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, rfc = :rfc, razon_social = :razon_social, documento = :documento, email = :email, telefono = :telefono, ciec_pass = :ciec_pass, fea_pass= :fea_pass, direccion = :direccion WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":rfc", $datos["rfc"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":ciec_pass", $datos["ciec_pass"], PDO::PARAM_STR);
        $stmt->bindParam(":fea_pass", $datos["fea_pass"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt = null;
	}


    /*=============================================
    ACTUALIZAR FAVORITOS
    =============================================*/

    static public function mdlActualizarFavoritos($tabla, $item1, $valor1){

        $campo="id";
        $cliente = self::mdlMostrarClientes($tabla,$campo,$valor1);
        $administrador = $cliente["admin_user"];


        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE admin_user = :admin_user");
        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":admin_user", $administrador, PDO::PARAM_STR);

        if($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }






}