<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
class Menu
{
    function __construct()
    {
    }
    public function getMenu()
    {
        $con = new Database();
        try {
            $query = $con->pdo->prepare("
                SELECT * FROM menus m
                where m.estatus_menu in (1) AND m.fk_id_menu IS NULL;
            ");
            $query->execute();
            $items = $query->fetchAll();
            return $items;
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return [];
        }
    }
    public function getByIdMenuSubmenu($id)
    {
        $con = new Database();
        try {
            $query = $con->pdo->prepare("
                SELECT * FROM menus m
                where m.estatus_menu in (1) AND m.fk_id_menu IS NOT NULL AND m.fk_id_menu = :fkMenu
                and m.estatus_menu in (1);
            ");
            $query->execute([':fkMenu' => $id]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return false;
        }
    }
}
