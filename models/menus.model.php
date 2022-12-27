<?php
class MenusModel extends ModelBase
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getMenu()
    {
        try {
            $query = $this->con->pdo->prepare("
            SELECT m.id_menu,m.nombre_menu,m2.nombre_menu as menupadre,m.descripcion_menu FROM menus m LEFT JOIN menus m2 On m2.id_menu=m.fk_id_menu ORDER BY m.nombre_menu,m2.nombre_menu;
            ");
            $query->execute();
            $items = $query->fetchAll();
            return $items;
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return [];
        }
    }
    public function getMenuPadre()
    {
        try {
            $query = $this->con->pdo->prepare("
            SELECT * FROM menus m
                where m.estatus_menu in (1) AND m.fk_id_menu IS NULL AND m.nombre_menu NOT IN ('Menu');
            ");
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return [];
        }
    }
}
