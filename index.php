<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once("app/database.php");
require_once("app/menu.base.php");
require_once("app/controller.base.php");
require_once("app/model.base.php");
require_once("app/view.base.php");
require_once("config/config.php");
require_once('app/app.php');
$app = new App();
?>