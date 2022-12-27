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
    function descMenu($params = null)
    {
        $resp = $this->model->descMenu($params[0]);
        echo json_encode($resp);
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
}
