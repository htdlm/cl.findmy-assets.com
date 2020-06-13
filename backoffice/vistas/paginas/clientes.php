<?php


/* Solo admin
if ($usuario["perfil"] != "admin") {
    echo '<script>
    window.location = "inicio";
  </script>';
    return;
}
*/

?>

<div class="content-wrapper" style="min-height: 1058.31px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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
                    <button class="btn btn-purple" data-toggle="modal" data-target="#modalAgregarCliente">

                        Agregar Cliente

                    </button>
                    <i class="fas fa-plus-circle text-purple"></i>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped dt-responsive tablas table-sm" width="100%">

                        <thead class="thead-dark">
                        <tr>

                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>RFC</th>
                            <th>Razón Social</th>
                            <th>Documento ID</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Ingreso al sistema</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $item = "admin_user";
                        $valor = $_SESSION["id"];
                        //$item = null;
                        //$valor = null;

                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value) {

                            echo '<tr>

                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $value["nombre"] . '</td>
                                    <td>' . $value["rfc"] . '</td>
                                    <td>' . $value["razon_social"] . '</td>
                                    <td>' . $value["documento"] . '</td>
                                    <td>' . $value["email"] . '</td>
                                    <td>' . $value["telefono"] . '</td>
                                    <td>' . $value["direccion"] . '</td>
                                    <td>' . $value["fecha"] . '</td>
                                <td>
                                <div class="btn-group">';


/* ***** ACTIVA, DESACTIVA BOTONES Y ESTABLECE EL FAVORITO  ********
****** */

                            if ($usuario["perfil"] == "admin") {

                                if($value["favorito"] == 1){
                                    echo '
                                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pen"></i></button>
                                        <button class="btn btn-danger  btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                                        <button class="btn btn-primary  btnFavoritoCliente" idCliente="' . $value["id"] . '"><i class="fa fa-star"></i></button>';
                                } else {
                                    echo '
                                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pen"></i></button>
                                        <button class="btn btn-danger  btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                                        <button class="btn btn-default  btnFavoritoCliente" idCliente="' . $value["id"] . '"><i class="fa fa-star"></i></button>';
                                }
                            } else {

                                if ($value["favorito"] == 1){
                                    echo '
                                        <button class="btn btn-primary  btnFavoritoCliente" idCliente="' . $value["id"] . '"><i class="fa fa-star"></i></button>';
                                } else {
                                    echo '
                                        <button class="btn btn-default  btnFavoritoCliente" idCliente="' . $value["id"] . '"><i class="fa fa-star"></i></button>';
                                }
                            }
                            echo '  </div>
                                    </td>
                                    </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#605ca8; color:white">
                    <h4 class="modal-title">Agregar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"> : </i></span>
                                <input type="text" class="form-control input-lg" name="nuevoCliente"
                                       placeholder="Ingresar nombre" maxlength="20" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL RFC -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-badge"> : </i></span>
                                <input type="text" class="form-control input-lg" name="nuevoRFC"
                                       placeholder="Ingresar RFC" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA Razón Social -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building"> : </i></span>
                                <input type="text" class="form-control input-lg" name="nuevoRazon_social"
                                       placeholder="Ingresar Razón Social" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL DOCUMENTO ID -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i> : </span>
                                <input type="text" class="form-control input-lg" name="nuevoDocumentoId"
                                       placeholder="Ingresar documento">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i> : </span>
                                <input type="email" class="form-control input-lg" name="nuevoEmail"
                                       placeholder="Ingresar email" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELÉFONO -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i> : </span>
                                <input type="text" class="form-control input-lg" name="nuevoTelefono"
                                       placeholder="Ingresar teléfono" data-inputmask="'mask':'99-9999-9999'"
                                       data-mask required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search-location"></i> : </span>
                                <input type="text" class="form-control input-lg" name="nuevaDireccion"
                                       placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA PASS CIEC -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-question"></i> : </span>
                                <input type="password" class="form-control input-lg" name="nuevaCiecPass"
                                       placeholder="Ingresar Password CIEC">
                            </div>
                        </div>

                        <!-- ENTRADA PARA PASS FEA -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-question"></i> : </span>
                                <input type="password" class="form-control input-lg" name="nuevaFeaPass"
                                       placeholder="Ingresar Password FIEL">
                            </div>
                        </div>

                        <!-- ENTRADA PARA SUBIR FIEL CER -->

                        <div class="form-group">
                            <div class="panel">Archivo FIEL CER</div>
                            <input type="file" class="nuevaCerFile" name="nuevaCerFile">
                        </div>

                        <!-- ENTRADA PARA SUBIR FIEL KEY -->

                        <div class="form-group">
                            <div class="panel">Archivo FIEL KEY</div>
                            <input type="file" class="nuevaKeyFile" name="nuevaKeyFile">
                        </div>

                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>

            </form>

            <?php

            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#605ca8; color:white">
                    <h4 class="modal-title">Editar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"> : </i></span>
                                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente"
                                       required>
                                <input type="hidden" id="idCliente" name="idCliente">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL RFC -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-badge"> : </i></span>
                                <input type="text" class="form-control input-lg" name="editarRFC" id="editarRFC"
                                       placeholder="Ingresar RFC" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA Razón Social -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-building"> : </i></span>
                                <input type="text" class="form-control input-lg" name="editarRazon_social"
                                       id="editarRazon_social"
                                       placeholder="Ingresar Razón Social" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL DOCUMENTO ID -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-id-card"></i> : </span>
                                <input type="text" class="form-control input-lg" name="editarDocumentoId"
                                       id="editarDocumentoId"
                                       placeholder="Ingresar documento">
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i> : </span>
                                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail"
                                       placeholder="Ingresar email" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELÉFONO -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i> : </span>
                                <input type="text" class="form-control input-lg" name="editarTelefono"
                                       id="editarTelefono"
                                       placeholder="Ingresar teléfono" data-inputmask="'mask':'99-9999-9999'"
                                       data-mask required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search-location"></i> : </span>
                                <input type="text" class="form-control input-lg" name="editarDireccion" id=
                                       "editarDireccion"
                                placeholder="Ingresar dirección" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA PASS CIEC -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-question"></i> : </span>
                                <input type="password" class="form-control input-lg" name="nuevaCiecPass"
                                       placeholder="Ingresar Password CIEC">
                            </div>
                        </div>

                        <!-- ENTRADA PARA PASS FEA -->

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-question"></i> : </span>
                                <input type="password" class="form-control input-lg" name="nuevaFeaPass"
                                       placeholder="Ingresar Password FIEL">
                            </div>
                        </div>

                        <!-- ENTRADA PARA SUBIR FIEL CER -->

                        <div class="form-group">
                            <div class="panel">Archivo FIEL CER</div>
                            <input type="file" class="nuevaCerFile" name="nuevaCerFile">
                        </div>

                        <!-- ENTRADA PARA SUBIR FIEL KEY -->

                        <div class="form-group">
                            <div class="panel">Archivo FIEL KEY</div>
                            <input type="file" class="nuevaKeyFile" name="nuevaKeyFile">
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

            $editarCliente = new ControladorClientes();
            $editarCliente->ctrEditarCliente();

            ?>


        </div>

    </div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>


