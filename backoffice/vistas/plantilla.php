<!DOCTYPE html>

<html>

<head>

  	<meta charset="utf-8">

  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

  	<title>Backoffice | findmy-assets</title>

  	<link rel="icon" href="vistas/img/plantilla/logo.ico">

  	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!--=====================================
    Vínculos CSS
    ======================================-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="vistas/css/plugins/OverlayScrollbars.min.css">

    <!-- jdSlider -->
    <link rel="stylesheet" href="vistas/css/plugins/jdSlider.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="vistas/css/plugins/select2.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

    <!-- estilo personalizado -->
    <link rel="stylesheet" href="vistas/css/style.css">

    <!--=====================================
  Vínculos JS
  ======================================-->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/js/plugins/adminlte.min.js"></script>

    <!-- overlayScrollbars -->
    <script src="vistas/js/plugins/jquery.overlayScrollbars.min.js"></script>

    <!-- jdSlider -->
    <!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
    <script src="vistas/js/plugins/jdSlider.js"></script>

    <!-- Select2 -->
    <!-- https://github.com/select2/select2 -->
    <script src="vistas/js/plugins/select2.full.min.js"></script>

    <!-- InputMask -->
    <!-- https://github.com/RobinHerbots/Inputmask -->
    <script src="vistas/js/plugins/jquery.inputmask.js"></script>

    <!-- jSignature -->
    <!-- https://www.jqueryscript.net/other/Signature-Field-Plugin-jQuery-jSignature.html -->
    <script src="vistas/js/plugins/jSignature.js"></script>
    <script src="vistas/js/plugins/jSignature.CompressorSVG.js"></script>

    <!-- SWEET ALERT 2 -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="vistas/js/plugins/sweetalert2.all.js"></script>

    <!-- DataTables
    https://datatables.net/-->
    <script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
    <script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
    <script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>

    <!-- ChartJS -->

    <script src="vistas/js/plugins/Chart.min.js"></script>


</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

<div class="wrapper">

    <?php

    session_start();

    $ruta = ControladorGeneral::ctrRuta();
    $valorSuscripcion = ControladorGeneral::ctrValorSuscripcion();
    $patrocinador = ControladorGeneral::ctrPatrocinador();

    if(!isset($_SESSION["validarSesion"])){

        echo '<script>
		window.location = "'.$ruta.'ingreso";
	</script>';
        return;

    }

    $item = "id_usuario";
    $valor = $_SESSION["id"];

    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

    $_SESSION["perfil"]=$usuario["perfil"];
    $_SESSION["master"]=$usuario["admin_user"];

    $adminItem = "admin_user";
    $adminValor = $_SESSION["master"];

    $empresa = ControladorClientes::ctrLeerFavoritoClientes($adminItem,$adminValor);

    if (empty($empresa)) {

        $_SESSION["cpyName"] = "Sin Empresa";
        $_SESSION["cpyId"] = 0;

        echo '<script>
				swal({
						type:"error",
						title: "¡ERROR!",
						text: "¡¡No hay empresas favoritas por favor de de alta una empresa favorita",
						showConfirmButton: true,
								confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){

						}
					});
		  </script>';
    } else{
        $_SESSION["cpyName"]=$empresa["nombre"];
        $_SESSION["cpyId"]=$empresa["id"];

    }

    ?>

    <?php

include "paginas/modulos/header.php";

include "paginas/modulos/menu.php";

/*=============================================
Páginas del sitio
=============================================*/

if(isset($_GET["pagina"])){

	if( $_GET["pagina"] == "inicio" ||
		$_GET["pagina"] == "perfil" ||
		$_GET["pagina"] == "usuarios" ||
		$_GET["pagina"] == "uninivel" ||
		$_GET["pagina"] == "binaria" ||
		$_GET["pagina"] == "matriz" ||
		$_GET["pagina"] == "productos" ||
		$_GET["pagina"] == "ingresos-binaria" ||
		$_GET["pagina"] == "ingresos-matriz" ||
		$_GET["pagina"] == "plan-compensacion" ||
		$_GET["pagina"] == "soporte" ||
    $_GET["pagina"] == "clientes" ||
    $_GET["pagina"] == "empresas" ||
    $_GET["pagina"] == "scanner" ||
		$_GET["pagina"] == "salir"){

		include "paginas/".$_GET["pagina"].".php";

	}

	else if( $_GET["pagina"] == "cuerpo-activo" ||
		$_GET["pagina"] == "mente-sana" ||
		$_GET["pagina"] == "espiritu-libre"){

		include "paginas/academia.php";
	}

	else{

		include "paginas/error404.php";
	}

}else{

	include "paginas/inicio.php";
}


include "paginas/modulos/footer.php";

 ?>

</div>


<script> var GlobalJS = 20 ; </script>

<script src="vistas/js/inicio.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/usuarios.js"></script>



</body>

</html>
