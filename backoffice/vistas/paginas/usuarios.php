<?php

if($usuario["perfil"] != "admin"){

  echo '<script>
  window.location = "'.$ruta.'backoffice/inicio";
  </script>';
  return;
}

$item = null;
$valor = null;
$usuarios = ControladorUsuarios::ctrMostrarusuarios($item, $valor);

?>


<div class="content-wrapper" style="min-height: 1058.31px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>


    <section class="content">

        <div class="box">

            <!-- Default box -->
            <div class="card card-purple card-outline">

                <div class="card-header">

                    <button class="btn btn-purple" data-toggle="modal" data-target="#modalAltaUsuario">

                        Agregar Usuario

                    </button>

                    <i class="fas fa-plus-circle text-purple"></i>


                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>

                </div>


      <div class="card-body">

        <script> var GlobalJS = 20 ; </script>

        <?php echo '<table class="table table-striped table-bordered dt-responsive tablaUsuarios table-sm" width="100%">'; ?>


            <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>País</th>
              <th>Ingreso</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>

<!--
           <?php foreach ($usuarios as $key => $value): ?>
             <tr>
              <td><?php echo($key+1); ?></td>
              <td><img src="<?php echo $value["foto"]?>" class="img-fluid" width="30px"></td>
              <td><?php echo $value["nombre"]?></td>
              <td><?php echo $value["email"]?></td>
            </tr>
          <?php endforeach ?>
-->
          
          </tbody>
        </table>

      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

</div>
</div>

<!--=====================================
MODAL ALTA USUARIO
======================================-->

<div id="modalAltaUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#605ca8; color:white">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-person-booth"></i></span>
                                <input type="text" class="form-control input-lg" id="altaNombre" name="altaNombre" placeholder="Nombre" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL MAIL -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-mail-bulk"></i></span>
                                <input type="email" class="form-control input-lg" name="altaEmail" placeholder="Email" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA PASSWORD -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control input-lg" name="altaPassword" placeholder="Password" required>
                            </div>
                        </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>

            </form>

            <?php

            $crearUsuario = new ControladorUsuarios();
            $crearUsuario -> ctrAltaUsuario();

            ?>

        </div>

    </div>

</div>
</div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Usuario</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-person-booth"></i></span>
                                <input type="text" class="form-control input-lg" id="EditarNombre" name="EditarNombre" placeholder="Nombre" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL MAIL -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-mail-bulk"></i></span>
                                <input type="email" class="form-control input-lg" name="EditarEmail" placeholder="Email" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA PASSWORD -->

                        <div class="form-group">
                            <div class="input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" class="form-control input-lg" name="altaPassword" placeholder="Password" required>
                            </div>
                        </div>

                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

            </form>

            <?php

            $editarProducto = new ControladorProductos();
            $editarProducto -> ctrEditarProducto();

            ?>

        </div>

    </div>
</div>

<?php

$eliminarUsuario = new ControladorUsuarios();
$eliminarUsuario -> ctrEliminarUsuario();

?>
