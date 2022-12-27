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
    public function datosMenu($id)
    {
        try {
            $query = $this->con->pdo->prepare("
                SELECT * FROM menus m WHERE m.id_menu in (:idMenu);
            ");
            $query->execute([':idMenu' => $id]);
            return $query->fetch();
        } catch (PDOException $e) {
            echo "Error recopilado datosMenu: " . $e->getMessage();
        }
    }
    public function eliminarMenu($id){
        try {
            $this->con->pdo->beginTransaction();
            $query = $this->con->pdo->prepare("
                DELETE FROM menus WHERE id_menu = :idMenu
            ");
            $query->execute([':idMenu' => $id]);
            $this->con->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->con->pdo->rollBack();
            return false;
        }
    }
    public function actualizarMenu($datos){
        try {
            $this->con->pdo->beginTransaction();
            $query = $this->con->pdo->prepare("
                UPDATE menus SET nombre_menu = :nombreMenu, fk_id_menu = :menuPadre, descripcion_menu = :descMenu WHERE id_menu = :idMenu;
            ");
            $query->execute([
                ':nombreMenu' =>$datos['form_nombre'],
                ':menuPadre' => $datos['form_menu_padre'],
                ':descMenu' => $datos['form_descripcion'],
                ':idMenu' => $datos['form_id']
            ]);
            $this->con->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->con->pdo->rollBack();
            return false;
        }
    }
    public function crearMenu($datos){
        try {
            $this->con->pdo->beginTransaction();
            $query = $this->con->pdo->prepare("
                INSERT INTO menus (nombre_menu,fk_id_menu,descripcion_menu) VALUES (:nombreMenu,:menuPadre,:descMenu);
            ");
            $paterno = ($datos['form_menu_padre'] == "")?NULL:$datos['form_menu_padre'];
            $query->execute([
                ':nombreMenu' =>$datos['form_nombre'],
                ':menuPadre' => $paterno,
                ':descMenu' => $datos['form_descripcion']
            ]);
            $this->con->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->con->pdo->rollBack();
            return false;
        }
    }
}