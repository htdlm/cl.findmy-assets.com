<div class="content-wrapper" style="min-height: 1058.31px;">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Tablero</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="app">
        <input type="hidden" id="user_id" value="<?= $usuario[0] ?>">
        <div class="row mt-5" id="step1">
          <div class="col-sm-1"></div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Analizar QR</h5>
                <hr>
                <label class="qrcode-text-btn btn btn-secondary">
                  <i class="fas fa-qrcode"></i>
                  Escanear QR
                  <input type=file
                        accept="image/*"
                        capture=environment
                        onChange="scanQR(this);"
                        tabindex=-1/>
                </label>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Analizar Código de barras</h5>
                <hr>
                <label class="qrcode-text-btn btn btn-secondary">
                  <i class="fas fa-barcode"></i>
                  Escanear código de barras
                  <input type=file
                        accept="image/*"
                        id="fileBar"
                        capture=environment
                        onChange="updateFile(this)"
                        tabindex=-1/>
                </label>
                <img class="img" src="">
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Código manual</h5>
                <hr>
                <form class="form-inline search-product">
                  <div class="form-group mx-sm-3 mb-2">
                    <input type="number" class="form-control" id="search" placeholder="Código de producto">
                  </div>
                  <button type="submit" class="btn btn-secondary mb-2">Buscar</button>
                </form>
                <img class="img" src="">
              </div>
            </div>
          </div>
          <div class="col-sm-1"></div>
        </div>

        <div class="row" id="step2">
          <div class="card card-form">
            <div class="card-header">
              <h4 class="productTitle"></h4>
            </div>
            <div class="card-body">
              <form class="productForm">

                <div class="row">
                  <div class="col-sm-6">
                    <label for="description">Descripción del producto</label>
                    <input type="text" name="description" class="form-control" id="description">
                  </div>
                  <div class="col-sm-6">
                    <label for="medida">Medida del producto</label>
                    <select class="custom-select" id="medida">

                    </select>
                  </div>
                </div>

                <div class="row mt-5">
                  <div class="col-sm-4">
                    <label for="qty">Cantidad</label>
                    <input type="number" name="qty" class="form-control" id="qty">
                  </div>
                  <div class="col-sm-4">
                    <label for="serie">Código de serie</label>
                    <input type="number" name="serie" class="form-control" id="serie">
                  </div>
                  <div class="col-sm-4">
                    <label for="caducidad">Caducidad</label>
                    <input type="date" name="caducidad" class="form-control" id="caducidad">
                  </div>
                </div>

                <div class="row mt-5">
                  <div class="col-sm-6">
                    <label for="area">Área</label>
                    <select class="custom-select" id="area">

                    </select>
                  </div>
                  <div class="col-sm-6">
                    <div class="image-header">
                      <label for="area">Imagenes de producto</label>
                      <br>
                      <label class="qrcode-text-btn btn btn-secondary">
                        Subir imagen
                        <input type=file
                               accept="image/*"
                               capture=environment
                               id="productImage"
                               multiple
                               tabindex=-1/>
                      </label>
                    </div>
                    <div class="row image-body">

                    </div>
                  </div>
                </div>

                <div class="row mt-5">
                  <div class="col-sm-6">
                    <button type="button" name="button" class="btn btn-block btn-secondary" onClick="back()">Atrás</button>
                  </div>
                  <div class="col-sm-6">
                    <input type="submit" class="btn btn-block btn-secondary mobile-space" value="Continuar">
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="row" id="step3">
          <div class="card card-folio">
            <div class="card-header">
              <h4> Folio: <span class="folioNumber"></span> </h4>
            </div>
            <div class="card-body">
              <h5>Operación: <span class="folio_operation"></span></h5>

              <button type="button" name="button" class="btn btn-block btn-secondary mt-3" onclick="restart()">Escanear otro producto</button>
              <button type="button" name="button" class="btn btn-block btn-secondary mt-3 mobile-space" onclick="printCode()">Imprimir</button>
            </div>
          </div>
        </div>

      </div>

      <div class="no-permission">
        <div class="container">
          <label>Por favor, proporcione acceso a su ubicación GPS</label>
          <br>
          <button class="btn btn-outline-secondary" type="button" name="button" onclick="permissionAgain()">
            Actualizar
          </button>
        </div>
      </div>

    </div>

  </section>
  <!-- /.content -->

  <!-- QR -->
  <script type="text/javascript" src="vistas/js/plugins/qr_packed.js"></script>

  <!-- ScanBar -->
  <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
  <script type="text/javascript" src="vistas/js/plugins/qr_packed.js"></script>

  <script type="text/javascript" src="vistas/js/scanner.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</div>
