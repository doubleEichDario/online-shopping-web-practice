<?php

class Categories {
  private $id;
  private $nombre;

  public function __construct() {
    $this -> db = Database::connect();
  }

  // Getters and Setters
  public function getId() {
    return $this -> id;
  }

  public function setId($id) {
    $this -> id = $id;
  }

  public function getNombre() {
    return $this -> nombre;
  }

  public function setNombre($nombre) {
    $this -> nombre = $this -> db -> real_escape_string($nombre);
  }

  // Methods

  public function showAll() {

    $sql = "SELECT * FROM categorias ORDER BY id DESC";
    $result = $this -> db -> query($sql);

    return $result;
  }

  public function insert() {

    $sql = "INSERT INTO categorias (nombre) VALUES('{$this -> getNombre()}')";
    $result = $this -> db -> query($sql);

    return $result;
  } // End o insert

  public function delete($id) {

    $sql = "DELETE FROM categorias WHERE id = $id";
    $result = $this -> db -> query($sql);

    return $result;

  } // End of delete

  public function edit($id) {

    $sql = "SELECT * FROM categorias WHERE id = $id";
    $result = $this -> db -> query($sql);

    return $result;

    require_once 'views/categories/create.php';

  } // End of edit

  public function update() {

    $sql = "UPDATE categorias SET nombre = '{$this -> getNombre()}' WHERE id = '{$this -> getId()}'";
    $result = $this -> db -> query($sql);

    return $result;
  } // End of update



}
