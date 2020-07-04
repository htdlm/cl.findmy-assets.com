<div class="hold-transition login-page">

	<div class="register-box">

	  <div class="login-box-body">
	    <form method="post" onsubmit="return validarPoliticas()">

				<?php if (isset($_COOKIE["patrocinador"])): ?>
					<input type="hidden" value="<?php echo $_COOKIE["patrocinador"];?>" name="patrocinador">
				<?php else: ?>
					<input type="hidden" value="findmy-assets" name="patrocinador">
				<?php endif ?>

				<p class="text-center py-3"><b>Completa tus datos</b></p>

				<input type="text" class="form-control my-3 py-3" placeholder="Nombre" name="registroNombre" required>
				<div class="row">
					<div class="col-sm">
						<input type="email" class="form-control my-3 py-3" placeholder="Correo Electrónico" name="registroEmail" required>
					</div>
					<div class="col-sm">
						<input type="password" class="form-control my-3 py-3" placeholder="Contraseña" name="registroPassword" required>
					</div>
				</div>

				<?php

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuario();

				?>

				<div class="row">
					<div class="col-sm-4">
						<input type="submit" class="form-control btn btn-warning text-white" value="Registrarse">
					</div>
					<div class="col-sm-8">
						<div class="form-check-inline text-right">
							<input type="checkbox" id="politicas" class="form-check-input" checked style="display: none;" >
							<label class="form-check-label terminos-link" for="politicas">
								Al registrarme, declaro qué acepto <a href="<?php echo $ruta ?>politicas-de-privacidad.pdf" target="_blank"> los términos, condiones y políticas de provacidad </a> de Find my assets.
							</label>
						</div>
					</div>
				</div>



				<p class="text-center py-3">¿Ya tienes una cuenta? <a class="ml-2 btn btn-outline-warning" href="<?php echo $ruta; ?>ingreso">Ingresar</a></p>

	    </form>
	    <!-- /.social-auth-links -->
	  </div>
  <!-- /.login-box-body -->
</div>
