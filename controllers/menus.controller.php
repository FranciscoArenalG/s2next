<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
class Menus extends ControllerBase
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $resp = $this->getMenu();
        $this->view->menus = $resp;
        $this->view->render("menu/index");
    }
    function datosMenu($param = null)
    {
        $resp = $this->model->datosMenu($param[0]);
        echo json_encode($resp);
        return false;
    }
    function getMenu()
    {
        $resp = $this->model->getMenu();
        return $resp;
    }
    function getByIdMenuSubmenu($id)
    {
        $resp = $this->model->getByIdMenuSubmenu($id);
        return $resp;
    }
    function getMenuPadre()
    {
        $resp = $this->model->getMenuPadre();
        echo json_encode($resp);
    }
    function eliminarMenu($param = null)
    {
        try {
            $resp = $this->model->eliminarMenu($param[0]);
            if ($resp) {
                $data = [
                    'titulo' => 'Menú eliminado',
                    'texto' => 'Se ha eliminado el registro exitosamente!',
                    'icono' => 'success'
                ];
            } else {
                $data = [
                    'titulo' => 'Error petición',
                    'texto' => 'Ocurrio un problema con la petición!',
                    'icono' => 'error'
                ];
            }
        } catch (\Throwable $th) {
            echo "Error controlador: " . $th->getMessage();
            $data = [
                'titulo' => 'Error servidor',
                'texto' => 'Ocurrio un problema con el servidor!',
                'icono' => 'error'
            ];
        }
        echo json_encode($data);
    }
    function actualizarMenu()
    {
        try {
            $resp = $this->model->actualizarMenu($_POST);
            if ($resp) {
                $data = [
                    'titulo' => 'Menú actualizado',
                    'texto' => 'Se ha actualizado correctamente!',
                    'icono' => 'success'
                ];
            } else {
                echo $resp;
                $data = [
                    'titulo' => 'Error petición',
                    'texto' => 'Ocurrio un problema con la petición!',
                    'icono' => 'error'
                ];
            }
        } catch (\Throwable $th) {
            echo "Error controlador: " . $th->getMessage();
            $data = [
                'titulo' => 'Error servidor',
                'texto' => 'Ocurrio un problema con el servidor!',
                'icono' => 'error'
            ];
        }
        echo json_encode($data);
    }
    function crearMenu()
    {
        try {
            $resp = $this->model->crearMenu($_POST);
            if ($resp) {
                $data = [
                    'titulo' => 'Menú creado',
                    'texto' => 'Se creo correctamente el menú!',
                    'icono' => 'success'
                ];
            } else {
                $data = [
                    'titulo' => 'Error petición',
                    'texto' => 'Ocurrio un problema con la petición!',
                    'icono' => 'error'
                ];
            }
        } catch (\Throwable $th) {
            echo "Error controlador: " . $th->getMessage();
            $data = [
                'titulo' => 'Error servidor',
                'texto' => 'Ocurrio un problema con el servidor!',
                'icono' => 'error'
            ];
        }
        echo json_encode($data);
    }
}