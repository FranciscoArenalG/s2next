<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
class ModelBase{

  function __construct(){
    $this->con = new Database();
  }
}
