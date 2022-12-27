<?php require "views/header.view.php"; ?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" id="titulo-card">
                Error de solicitud
                <button class="btn btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#agregarSubmenu"><span data-bs-toggle="tooltip" title="Agregar submenu"><i class="fa-solid fa-circle-plus"></i></span></button>
            </div>
            <div class="card-body">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="contenedor">
                    <h1>Hubo un error en la solicitud o no existe la página</h1>
                    <button class="btn btn-info btn-block" type="button" onclick="window.history.back();">Regresar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "views/footer.view.php"; ?>