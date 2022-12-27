<?php require "views/header.view.php"; ?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" id="titulo-card">
                Concentrado
                <button class="btn btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#agregarSubmenu"><span data-bs-toggle="tooltip" title="Agregar submenu"><i class="fa-solid fa-circle-plus"></i></span></button>
            </div>
            <div class="card-body">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" id="contenedor">
                    <table class="table table-striped table-bordered" id="info-table-result">
                        <thead>
                            <tr class="text-center">
                                <th class="text-uppercase">ID</th>
                                <th class="text-uppercase">Nombre</th>
                                <th class="text-uppercase">Menu padre</th>
                                <th class="text-uppercase">Descripción</th>
                                <th class="text-uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($this->menus); $i++) : ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= $this->menus[$i]['nombre_menu']; ?></td>
                                    <td><?= $this->menus[$i]['menupadre']; ?></td>
                                    <td><?= $this->menus[$i]['descripcion_menu']; ?></td>
                                    <td class="text-center"><button class="btn btn-info rounded-circle" data-bs-toggle="modal" data-bs-target="#agregarSubmenu"><span data-bs-toggle="tooltip" title="Editar menu"><i class="fa-solid fa-edit"></i></span></button></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require "views/footer.view.php"; ?>
<script src="<?php echo constant("URL"); ?>public/js/paginas/menu.js"></script>
<!-- Modal -->
<div class="modal fade" id="agregarSubmenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="nuevo-menu" action="javascript:;" class="needs-validation" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Datos menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="">Menu padre</label>
                                <select class="form-control" name="form_menu_padre" id="form_menu_padre"></select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="">Nombre</label>
                                <input class="form-control" type="text" name="form_nombre" id="form_nombre" placeholder="Nombre menu" required>
                                <div class="invalid-feedback">
                                    Favor de ingresar un nombre.
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label for="">Descripción</label>
                                <textarea class="form-control" name="form_descripcion" id="form_descripcion" cols="30" rows="5" placeholder="Descripción submenu..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="submit" data-formulario="nuevo-menu">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>