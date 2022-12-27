<?php
/*
 * Autor: Francisco Arenal Guerrero
 */
class Database extends PDO{
  private $host;
  public $db;
  private $user;
  private $password;
  private $charset;

  public function __construct(){
    $this->host = constant("HOST");
    $this->db = constant("DB");
    $this->user = constant("USER");
    $this->password = constant("PASSWORD");
    $this->charset = constant("CHARSET");
    try {
      $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;//Mysql
      $options = [
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];
      $this->pdo = new PDO($connection, $this->user, $this->password, $options);
    } catch (PDOException $e) {
      print_r("Error de conexión: " . $e->getMessage());
    }
  }
}
