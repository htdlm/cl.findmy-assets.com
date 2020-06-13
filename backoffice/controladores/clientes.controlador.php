<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

	    $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "C0mpuvive";

/* Seccion para desencriptar passwords

        $decryption_iv = '1234567891011121';
        $decryption_key = "C0mpuvive";
        $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
*/

        if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+$/', $_POST["nuevoRFC"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"])){

                $encrypCiecPass = openssl_encrypt($_POST["nuevaCiecPass"], $ciphering, $encryption_key, $options, $encryption_iv);
                $encrypFeaPass = openssl_encrypt($_POST["nuevaFeaPass"], $ciphering, $encryption_key, $options, $encryption_iv);


                if(isset($_FILES["nuevaCerFile"]["tmp_name"])){
//                    echo "<script>console.log('Debug Objects A : " . $_FILES["nuevaCerFile"]["tmp_name"] . "' );</script>";
                    $directorio = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"];
                    mkdir($directorio, 0755);
                    $archivo = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"]."/".$_POST["nuevoRFC"].".cer";
//                    echo "<script>console.log('Debug Objects A : " . $archivo . "' );</script>";
                    move_uploaded_file( $_FILES['nuevaCerFile']['tmp_name'], $archivo);
                }

                if(isset($_FILES["nuevaKeyFile"]["tmp_name"])){
//                    echo "<script>console.log('Debug Objects A : " . $_FILES["nuevaCerFile"]["tmp_name"] . "' );</script>";
                    $directorio = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"];
                    mkdir($directorio, 0755);
                    $archivo = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"]."/".$_POST["nuevoRFC"].".key";
//                    echo "<script>console.log('Debug Objects A : " . $archivo . "' );</script>";
                    move_uploaded_file( $_FILES['nuevaKeyFile']['tmp_name'], $archivo);
                }


                $tabla = "clientes";

                $datos = array("nombre" => $_POST["nuevoCliente"],
                    "rfc" => $_POST["nuevoRFC"],
                    "razon_social" => $_POST["nuevoRazon_social"],
                    "documento" => $_POST["nuevoDocumentoId"],
                    "email" => $_POST["nuevoEmail"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "direccion" => $_POST["nuevaDireccion"],
                    "ciec_pass" => $encrypCiecPass,
                    "fea_pass" => $encrypFeaPass,
                    "admin_user" => $_SESSION["id"]);

                $respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

                if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}


    /*=============================================
    ACTUALIZAR CLIENTES FAVORITOS
    =============================================*/

    static public function ctrActualizarCliente($item1, $valor1, $valor2){

        $tabla = "clientes";

        $favoritos = ModeloClientes::mdlActualizarFavoritos($tabla,$item1,$valor2);
        if ($favoritos=="ok"){
            $respuesta = ModeloClientes::mdlActualizarCliente($tabla, $item1, $valor1,$valor2);
            return $respuesta;
        }
    }



    /*=============================================
    LEER FAVORITOS CLIENTES
    =============================================*/

    static public function ctrLeerFavoritoClientes($adminItem, $adminValor){

        $tabla = "clientes";

        $respuesta = ModeloClientes::mdlLeerFavoritoClientes($tabla, $adminItem, $adminValor);

        return $respuesta;

    }


    /*=============================================
    EDITAR CLIENTE
    =============================================*/

	static public function ctrEditarCliente(){

        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "C0mpuvive";

        /* Seccion para desencriptar passwords

                $decryption_iv = '1234567891011121';
                $decryption_key = "C0mpuvive";
                $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
        */

        if (isset($_POST["editarCliente"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
                preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) &&
                preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])) {


                $encrypCiecPass = openssl_encrypt($_POST["nuevaCiecPass"], $ciphering, $encryption_key, $options, $encryption_iv);
                $encrypFeaPass = openssl_encrypt($_POST["nuevaFeaPass"], $ciphering, $encryption_key, $options, $encryption_iv);


                if(isset($_FILES["nuevaCerFile"]["tmp_name"])){
//                    echo "<script>console.log('Debug Objects A : " . $_FILES["nuevaCerFile"]["tmp_name"] . "' );</script>";
                    $directorio = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"];
                    mkdir($directorio, 0755);
                    $archivo = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"]."/".$_POST["nuevoRFC"].".cer";
//                    echo "<script>console.log('Debug Objects A : " . $archivo . "' );</script>";
                    move_uploaded_file( $_FILES['nuevaCerFile']['tmp_name'], $archivo);
                }

                if(isset($_FILES["nuevaKeyFile"]["tmp_name"])){
//                    echo "<script>console.log('Debug Objects A : " . $_FILES["nuevaCerFile"]["tmp_name"] . "' );</script>";
                    $directorio = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"];
                    mkdir($directorio, 0755);
                    $archivo = $_SERVER['DOCUMENT_ROOT']."/datos/users/".$_SESSION["id"]."/".$_POST["nuevoRFC"].".key";
//                    echo "<script>console.log('Debug Objects A : " . $archivo . "' );</script>";
                    move_uploaded_file( $_FILES['nuevaKeyFile']['tmp_name'], $archivo);
                }


                $tabla = "clientes";

                $datos = array("id" => $_POST["idCliente"],
                    "nombre" => $_POST["editarCliente"],
                    "rfc" => $_POST["editarRFC"],
                    "razon_social" => $_POST["editarRazon_social"],
                    "documento" => $_POST["editarDocumentoId"],
                    "email" => $_POST["editarEmail"],
                    "telefono" => $_POST["editarTelefono"],
                    "ciec_pass" => $encrypCiecPass,
                    "fea_pass" => $encrypFeaPass,
                    "direccion" => $_POST["editarDireccion"]);


                $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Error en datos vacío o caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

            if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}

}

