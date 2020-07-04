<?php

// https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class ControladorUsuarios
{

    /*=============================================
    Registro de usuarios
    =============================================*/

    public function ctrRegistroUsuario()
    {

        if (isset($_POST["registroNombre"])) {

            $ruta = ControladorRuta::ctrRuta();

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])) {

                $encriptar = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encriptarEmail = md5($_POST["registroEmail"]);

                $tabla = "usuarios";
                $datos = array("perfil" => "admin",
                    "nombre" => $_POST["registroNombre"],
                    "email" => $_POST["registroEmail"],
                    "password" => $encriptar,
                    "suscripcion" => 0,
                    "verificacion" => 0,
                    "email_encriptado" => $encriptarEmail,
                    "patrocinador" => $_POST["patrocinador"]);


                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    /*=============================================
                    Verificación Correo Electrónico
                    =============================================*/

                    date_default_timezone_set("America/Mexico_City");

                    $mail = new PHPMailer;

                    $mail->isSMTP();                                           // Set mailer to use SMTP

                    $mail->Charset = "UTF-8";

                    $mail->SMTPDebug = 0;                                       // Enable verbose debug output


                    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                    $mail->Username = 'envia.mis.mails@gmail.com';            // SMTP username
                    $mail->Password = 'bjwqemuuiwsyggts';                     // SMTP password
                    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

//                    $mail->isMail();

                    $mail->setFrom("contacto@findmy-assets.com", "Find my assets");

                    $mail->addReplyTo("contacto@findmy-assets.com", "Find my assets");

                    $mail->Subject = "Por favor verifique su email";

                    $mail->addAddress($_POST["registroEmail"]);

                    $fhtml = $ruta . "verificar-correo.html";

                    $mensaje = file_get_contents($fhtml);

                    $mensaje = str_replace('%logo%', $ruta . "vistas/img/vectors/Logo.png", $mensaje);

                    $mensaje = str_replace('%iconomail%', $ruta . "vistas/img/vectors/Logo.png", $mensaje);

                    $mensaje = str_replace('%cadena%', $ruta . $encriptarEmail, $mensaje);

                    echo $mensaje;

                    $mail->msgHTML($mensaje);

                    $envio = $mail->Send();

                    if (!$envio) {

                        echo '<script>

							swal({

								type:"error",
								title: "¡ERROR!",
								text: "¡¡Ha ocurrido un problema enviando email a ' . $_POST["registroEmail"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});

						</script>';


                    } else {


                        echo '<script>

							swal({

								type:"success",
								title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su email para verificar la cuenta!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "' . $ruta . 'ingreso";

								}


							});

						</script>';


                    }

                }

            } else {

                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});

				</script>';


            }

        }

    }


/*=============================================
Alta de usuarios
=============================================*/

    public function ctrAltaUsuario()
    {

        if (isset($_POST["altaNombre"])) {

             $ruta = ControladorGeneral::ctrRuta();

            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["altaNombre"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["altaEmail"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["altaPassword"])) {

                $encriptar = crypt($_POST["altaPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $encriptarEmail = md5($_POST["altaEmail"]);

                if (isset($_SESSION["id"])) {
                    $adminUser = $_SESSION["id"];
                    } else {
                    $adminUser = -1;
                    }

                $tabla = "usuarios";
                $datos = array("perfil" => "usuario",
                    "nombre" => $_POST["altaNombre"],
                    "email" => $_POST["altaEmail"],
                    "password" => $encriptar,
                    "suscripcion" => 0,
                    "verificacion" => 0,
                    "email_encriptado" => $encriptarEmail,
                    "patrocinador" => DICPY,
                    "admin_user" => $adminUser);


                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    /*=============================================
                    Verificación Correo Electrónico
                    =============================================*/

                    date_default_timezone_set("America/Mexico_City");

                    $mail = new PHPMailer;

                    $mail->isSMTP();                                           // Set mailer to use SMTP

                    $mail->Charset = "UTF-8";

                    $mail->SMTPDebug = 0;                                       // Enable verbose debug output


                    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
                    $mail->Username = 'envia.mis.mails@gmail.com';            // SMTP username
                    $mail->Password = 'bjwqemuuiwsyggts';                     // SMTP password
                    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

//                    $mail->isMail();

                    $mail->setFrom("contacto@e-mpresa.com", "e-mpresa");

                    $mail->addReplyTo("contacto@e-mpresa.com", "e-mpresa");

                    $mail->Subject = "Por favor verifique su email";

                    $mail->addAddress($_POST["altaEmail"]);

                    $fhtml = $ruta . "verificar-correo.html";

                    $mensaje = file_get_contents($fhtml);

                    $mensaje = str_replace('%logo%', $ruta . "vistas/img/logo-positivo.png", $mensaje);

                    $mensaje = str_replace('%iconomail%', $ruta . "vistas/img/icon-email.png", $mensaje);

                    $mensaje = str_replace('%cadena%', $ruta . $encriptarEmail, $mensaje);

                    echo $mensaje;

                    $mail->msgHTML($mensaje);

                    $envio = $mail->Send();


                    if (!$envio) {

                        echo '<script>

							swal({

								type:"error",
								title: "¡ERROR!",
								text: "¡¡Ha ocurrido un problema enviando email a ' . $_POST["altaEmail"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									history.back();

								}


							});

						</script>';


                    } else {


                        echo '<script>

							swal({

								type:"success",
								title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
								text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su email para verificar la cuenta!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){

									window.location = "usuarios";

								}

							});

						</script>';


                    }

                }

            } else {

                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡Error en los datos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}


					});

				</script>';


            }

        }

    }




    /*=============================================
    Mostrar Usuarios
    =============================================*/

    static public function ctrMostrarUsuarios($item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
    Actualizar Usuario
    =============================================*/

    static public function ctrActualizarUsuario($id, $item, $valor)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    Ingreso Usuario
    =============================================*/

    public function ctrIngresoUsuario()
    {

        if (isset($_POST["ingresoEmail"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])) {

                $encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["ingresoEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["verificacion"] == 0) {

                        echo '<script>

							swal({
									type:"error",
								  	title: "¡ERROR!",
								  	text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para verificar la cuenta, o contáctese con nuestro soporte a info@academyoflife.com!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"

							}).then(function(result){

									if(result.value){
									    history.back();
									  }
							});

						</script>';

                        return;

                    } else {

                        $_SESSION["validarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id_usuario"];

                        $ruta = ControladorRuta::ctrRuta();

                        echo '<script>

							window.location = "' . $ruta . 'backoffice";

						</script>';

                    }

                } else {

                    echo '<script>

						swal({
								type:"error",
							  	title: "¡ERROR!",
							  	text: "¡El email o contraseña no coinciden!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
								    history.back();
								  }
						});

					</script>';

                }


            } else {

                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});

				</script>';

            }

        }

    }

    /*=============================================
    Cambiar foto perfil
    =============================================*/

    public function ctrCambiarFotoPerfil()
    {

        if (isset($_POST["idUsuarioFoto"])) {

            $ruta = $_POST["fotoActual"];

            if (isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])) {

                list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto = 500;

                /*=============================================
                CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                =============================================*/

                $directorio = "vistas/img/usuarios/" . $_POST["idUsuarioFoto"];

                /*=============================================
                PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD Y EL CARPETA
                =============================================*/

                if ($ruta != "") {

                    unlink($ruta);

                } else {

                    if (!file_exists($directorio)) {

                        mkdir($directorio, 0755);

                    }

                }

                /*=============================================
                DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                =============================================*/

                if ($_FILES["cambiarImagen"]["type"] == "image/jpeg") {

                    $aleatorio = mt_rand(100, 999);

                    $ruta = $directorio . "/" . $aleatorio . ".jpg";

                    $origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);


                } else if ($_FILES["cambiarImagen"]["type"] == "image/png") {

                    $aleatorio = mt_rand(100, 999);

                    $ruta = $directorio . "/" . $aleatorio . ".png";

                    $origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagealphablending($destino, FALSE);

                    imagesavealpha($destino, TRUE);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);

                } else {

                    echo '<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
								    history.back();
								  }
						});

					</script>';

                }

            }

            // final condicion

            $tabla = "usuarios";
            $id = $_POST["idUsuarioFoto"];
            $item = "foto";
            $valor = $ruta;

            $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						type:"success",
					  	title: "¡CORRECTO!",
					  	text: "¡La foto de perfil ha sido actualizada!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

							if(result.value){
							    history.back();
							  }
					});

				</script>';


            }

        }

    }

    /*=============================================
    Cambiar contraseña
    =============================================*/

    public function ctrCambiarPassword()
    {

        if (isset($_POST["idUsuarioPassword"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

                $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $id = $_POST["idUsuarioPassword"];
                $item = "password";
                $valor = $encriptar;

                $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                if ($respuesta == "ok") {

                    echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡La contraseña ha sido actualizada!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
								    history.back();
								  }
						});

					</script>';


                }

            } else {

                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en la contraseña!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});

				</script>';

            }


        }

    }

    /*=============================================
    Recuperar contraseña
    =============================================*/

    public function ctrRecuperarPassword()
    {

        if (isset($_POST["emailRecuperarPassword"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])) {

                /*=============================================
                GENERAR CONTRASEÑA ALEATORIA
                =============================================*/

                function generarPassword($longitud)
                {

                    $password = "";
                    $patron = "1234567890abcdefghijklmnopqrstuvwxyz";

                    $max = strlen($patron) - 1;

                    for ($i = 0; $i < $longitud; $i++) {

                        $password .= $patron{mt_rand(0, $max)};

                    }

                    return $password;

                }

                $nuevoPassword = generarPassword(11);

                $encriptar = crypt($nuevoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";
                $item = "email";
                $valor = $_POST["emailRecuperarPassword"];

                $traerUsuario = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

                if ($traerUsuario) {

                    $id = $traerUsuario["id_usuario"];
                    $item = "password";
                    $valor = $encriptar;

                    $actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

                    if ($actualizarPassword == "ok") {

                        /*=============================================
                        Verificación Correo Electrónico
                        =============================================*/

                        $ruta = ControladorRuta::ctrRuta();

                        date_default_timezone_set("America/Bogota");

                        $mail = new PHPMailer;

                        $mail->Charset = "UTF-8";

                        $mail->isMail();

                        $mail->setFrom("info@academyoflife.com", "Academy of Life");

                        $mail->addReplyTo("info@academyoflife.com", "Academy of Life");

                        $mail->Subject = "Solicitud nueva contraseña";

                        $mail->addAddress($traerUsuario["email"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

							<center>

								<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

								<center>

								<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevoPassword . '</h4>

								<a href="' . $ruta . 'ingreso" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');

                        $envio = $mail->Send();

                        if (!$envio) {

                            echo '<script>

								swal({

									type:"error",
									title: "¡ERROR!",
									text: "¡¡Ha ocurrido un problema enviando verificación de correo electrónico a ' . $traerUsuario["email"] . ' ' . $mail->ErrorInfo . ', por favor inténtelo nuevamente",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										history.back();

									}


								});

							</script>';


                        } else {


                            echo '<script>

								swal({

									type:"success",
									title: "¡SU NUEVA CONTRASEÑA HA SIDO ENVIADA!",
									text: "¡Por favor revise la bandeja de entrada o la carpeta SPAM de su correo electrónico para tomar la nueva contraseña!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){

										window.location = "' . $ruta . 'ingreso";

									}


								});

							</script>';


                        }

                    }


                } else {

                    echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

								if(result.value){
								    history.back();
								  }
						});

					</script>';

                }

            } else {


                echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡Error al escribir el correo!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});

				</script>';

            }


        }


    }

    /*=============================================
    Iniciar Suscripción
    =============================================*/

    static public function ctrIniciarSuscripcion($datos)
    {

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::mdlIniciarSuscripcion($tabla, $datos);

        return $respuesta;

    }

    /*=============================================
    Cancelar Suscripción
    =============================================*/

    static public function ctrCancelarSuscripcion($valor)
    {

        $tabla = "usuarios";

        $datos = array("id_usuario" => $valor,
            "suscripcion" => 0,
            "ciclo_pago" => null,
            "firma" => null,
            "fecha_contrato" => null);


        $respuesta = ModeloUsuarios::mdlCancelarSuscripcion($tabla, $datos);

        return $respuesta;

    }


    /*=============================================
    BORRAR USUARIOS
    =============================================*/
    static public function ctrEliminarUsuario()
    {

        if (isset($_GET["idUser"])) {

            $tabla = "usuarios";
            $datos = $_GET["idUser"];

/*
            unlink('vistas/img/usuarios/' . $datos);
            rmdir('vistas/img/usuarios/' . $datos);
*/
            $respuesta = ModeloUsuarios::mdlEliminarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "El Usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "index.php?pagina=usuarios";

								}
							})

				</script>';

            }
        }
    }
}
