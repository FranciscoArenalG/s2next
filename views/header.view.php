<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Prueba técnica de S2Next">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2Next - Evaluación</title>
    <!-- Librerías -->
    <link href="<?= constant('URL') ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=constant('URL')?>public/css/fontawesome-free-6.2.0-web/css/fontawesome.css" rel="stylesheet">
    <link href="<?=constant('URL')?>public/css/fontawesome-free-6.2.0-web/css/brands.css" rel="stylesheet">
    <link href="<?=constant('URL')?>public/css/fontawesome-free-6.2.0-web/css/solid.css" rel="stylesheet">
    <link href="<?=constant('URL')?>public/css/fontawesome-free-6.2.0-web/css/v5-font-face.css" rel="stylesheet">
    <script src="<?php echo constant("URL");?>public/js/sweetalert.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="">Evaluación</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <?php $menu = new Menu(); ?>
                    <ul class="navbar-nav">
                        <?php foreach ($menu->getMenu() as $menus) : ?>
                            <?php if ($menu->getByIdMenuSubmenu($menus['id_menu']) == false) : ?>
                                <li class="nav-item">
                                    <a class="nav-link menus" href="javascript:;" data-descripcion="<?=$menus['descripcion_menu']?>"><?=$menus['nombre_menu']?></a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><?=$menus['nombre_menu']?></a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($menu->getByIdMenuSubmenu($menus['id_menu']) as $submenu) : ?>
                                            <li><a class="dropdown-item menus" data-descripcion="<?=$submenu['descripcion_menu']?>" href="javascript:;"><?=$submenu['nombre_menu']?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-3">