<?php

if($usuario["perfil"] != "admin"){

    echo '<script>

    window.location = "'.$ruta.'backoffice/inicio";

  </script>';

    return;

}
?>


<div class="content-wrapper" style="min-height: 1058.31px;">

    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Productos</li>
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

                    <button class="btn btn-purple" data-toggle="modal" data-target="#modalAgregarProducto">

                        Agregar producto

                    </button>

                    <a class="btn btn-purple" href="#">
                        Escanear código
                    </a>

                    <i class="fas fa-plus-circle text-purple"></i>


                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped dt-responsive tablaProductos table-sm" width="100%">

                        <thead class="thead-dark">

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>

                        </tr>

                        </thead>

                    </table>

                    <input type="hidden" value="<?php echo $usuario["perfil"]; ?>" id="perfilOculto">


                </div>

            </div>

    </section>

</div>
</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#605ca8; color:white">

                    <h4 class="modal-title">Agregar producto</h4>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                        <div class="form-group">

                            <div class="input-group-sm">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>

                                    <option value="">Selecionar categoría</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                    foreach ($categorias as $key => $value) {

                                        echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL CÓDIGO -->

                        <div class="form-group">

                            <div class="input-group-sm">

                                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>

                                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->

                        <div class="form-group">

                            <div class="input-group-sm">

                                <span class="input-group-addon"><i class="fa fa-align-justify"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA STOCK -->

                        <div class="form-group">

                            <div class="input-group-sm">

                                <span class="input-group-addon"><i class="fa fa-archive"></i></span>

                                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA PRECIO COMPRA -->

                        <div class="form-group row">

                            <div class="col-sm-4">

                                <div class="input-group-sm">

                                    <span class="input-group-addon"><i class="fa fa-money-bill"></i></span>

                                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA PRECIO VENTA -->

                            <div class="col-sm-5">

                                <div class="input-group-sm">

                                    <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                    <input type="number" class="form-control input-sm" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

                                </div>
                            </div>


                            <!-- CHECKBOX PARA PORCENTAJE -->

                            <div class="col-sm-1">

                                <div class="input-group-sm">

                                    <input type="checkbox" class="minimal porcentaje" checked>

                                </div>

                            </div>

                            <!-- ENTRADA PARA PORCENTAJE -->

                            <div class="col-sm-2">

                                <div class="input-group-sm">

                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    <input type="number" class="form-control input-sm nuevoPorcentaje" min="0" value="40" required>

                                </div>

                            </div>

                        </div>

                        <!-- ENTRADA PARA SUBIR FOTO -->

                        <div class="form-group">

                            <div class="panel">Subir Imagen</div>

                            <input type="file" class="nuevaImagen" name="nuevaImagen">

                            <p class="help-block">Peso máximo 2MB</p>

                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                        </div>

                    </div>


                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" class="btn btn-primary">Guardar producto</button>

                    </div>

            </form>

            <?php

            $crearProducto = new ControladorProductos();
            $crearProducto -> ctrCrearProducto();

            ?>

        </div>

    </div>

</div>
</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar producto</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <select class="form-control input-lg"  name="editarCategoria" readonly required>

                                    <option id="editarCategoria"></option>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL CÓDIGO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA STOCK -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA PRECIO COMPRA -->

                        <div class="form-group row">

                            <div class="col-xs-4">

                                <div class="input-group-sm">

                                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA PRECIO VENTA -->

                            <div class="col-xs-4">

                                <div class="input-group-sm">

                                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>

                                </div>

                                <!-- CHECKBOX PARA PORCENTAJE -->

                                <div class="col-xs-4">

                                    <div class="input-group-sm">

                                        <input type="checkbox" class="minimal porcentaje" checked>

                                    </div>

                                </div>

                                <!-- ENTRADA PARA PORCENTAJE -->

                                <div class="col-xs-4">

                                    <div class="input-group-sm">

                                        <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- ENTRADA PARA SUBIR FOTO -->

                        <div class="form-group">

                            <div class="panel">SUBIR IMAGEN</div>

                            <input type="file" class="nuevaImagen" name="editarImagen">

                            <p class="help-block">Peso máximo de la imagen 2MB</p>

                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                            <input type="hidden" name="imagenActual" id="imagenActual">

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

$eliminarProducto = new ControladorProductos();
$eliminarProducto -> ctrEliminarProducto();

?>
