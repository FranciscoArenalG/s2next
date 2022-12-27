<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
require_once "controllers/error.controller.php";
class App
{
    private $url;
    public function __construct()
    {
        $this->url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->url = rtrim($this->url, '/');
        $this->url = explode("/", $this->url);
        if (empty($this->url[0])) {
            $archivoController = "controllers/menus.controller.php";
            require_once $archivoController;
            $controller = new Menus();
            $controller->loadModel("menus");
            $controller->index();
            return false;
        }
        $archivoController = "controllers/" . $this->url[0] . ".controller.php";
        if (file_exists($archivoController)) {
            require_once $archivoController;
            /* Inicialización del controlador */
            $controller = new $this->url[0];
            $controller->loadModel($this->url[0]);
            /* Número de elementos del arreglo URL */
            $nparam = sizeof($this->url);
            if ($nparam > 1) {
                if ($nparam > 2) {
                    $param = [];
                    for ($i=2; $i < $nparam; $i++) { 
                        array_push($param, $this->url[$i]);
                    }
                    if (method_exists($controller, $this->url[1])) {
                        $controller->{$this->url[1]}($param);
                    }else{
                        $controller = new Errores();
                    }
                }else{
                    if (method_exists($controller, $this->url[1])) {
                        // echo "existe metodo";
                        $controller->{$this->url[1]}(); //Carga el metodo
                    } else {
                        // echo "no existe metodo";
                        $controller = new Errores();
                    }
                }
            }else{
                $controller->index();
            }
        }else{
            $controller = new Errores();
        }
    }
}
