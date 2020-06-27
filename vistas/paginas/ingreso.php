<div class="hold-transition login-page">

	<div class="login-box">

	  <div class="login-box-body">
	    <form method="post">

				<div class="part-1">
					<p class="text-center py-3 text-title-login">Hola, ingresa tu e-mail</p>
					<div class="form-group">
						<input type="email" id="email" class="form-control form-control-feedback" placeholder="E-mail" name="ingresoEmail" required>
					</div>

					<div class="row">
		        <div class="col-sm-3"></div>
		        <!-- /.col -->
		        <div class="col-sm-6">
		          <button type="button" class="btn btn-warning text-white btn-block next">Continuar</button>
		        </div>
						<div class="col-sm-3"></div>
		      </div>

					<div class="row mt-4">
						<div class="col-sm-1"></div>
						<div class="col-sm-10">
							<p class="text-center little-text mt-1">¿Sin cuenta?  <a class="ml-2 btn btn-outline-warning" href="<?php echo $ruta; ?>registro">Regístrate</a></p>
						</div>
						<div class="col-sm-1"></div>
					</div>
				</div>

				<div class="part-2" style="display: none">
					<p class="text-center py-3 text-title-login">Ahora tu clave</p>
					<div class="form-group">
		        <input type="password" class="form-control" placeholder="Password" name="ingresoPassword" required>
		      </div>

					<div class="row">
		        <div class="col-sm-3"></div>
		        <!-- /.col -->
		        <div class="col-sm-6">
		          <button type="submit" class="btn btn-warning text-white btn-block next">Acceder</button>
		        </div>
						<div class="col-sm-3"></div>
		      </div>

					<div class="row mt-4">
						<div class="col-sm-1"></div>
						<div class="col-sm-10">
							<p class="text-center pt-1"><a class="btn btn-outline-warning" href="#modalRecuperarPassword" data-toggle="modal" data-dismiss="modal">¿Olvidó su contraseña?</a></p>
						</div>
						<div class="col-sm-1"></div>
					</div>
				</div>
				<?php

					$ingreso = new ControladorUsuarios();
					$ingreso -> ctrIngresoUsuario();

				?>
	    </form>
	    <!-- /.social-auth-links -->
	  </div>
  <!-- /.login-box-body -->
</div>

<script type="text/javascript">

	$( '.next' ).click((event) =>
	{
		if ( $( '#email' ).val( ) == '' )
		{
			swal({
					type:"error",
						title: "¡ERROR!",
						text: "¡El email es obligatorio",
						showConfirmButton: true,
					confirmButtonText: "Cerrar"

			});
		}
		else
		{
			$( '.part-1' ).hide( );
			$( '.part-2' ).show( );
		}

	});

</script>


</div>

<!--=====================================
VENTANA MODAL RECUPERAR CONTRASEÑA
======================================-->

<div class="modal" id="modalRecuperarPassword">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header bg-info text-white">
		        <h4 class="modal-title">Recuperar contraseña</h4>
		        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		    </div>
			 <div class="modal-body">
				<form method="post">
					<p class="text-muted">Escriba su correo electrónico con el que está registrado y allí le enviaremos una nueva contraseña:</p>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      <span class="input-group-text">
					      	<i class="far fa-envelope"></i>
					      </span>
					    </div>
					    <input type="email" class="form-control" placeholder="Email" name="emailRecuperarPassword" required>
					</div>
					<input type="submit" class="btn btn-dark btn-block" value="Enviar">

					<?php

						$recuperarPassword = new ControladorUsuarios();
						$recuperarPassword -> ctrRecuperarPassword();

					?>

				</form>
			 </div>
	    </div>
    </div>
</div>
