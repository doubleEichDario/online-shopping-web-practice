<?php

class Products {

  private $id;
  private $categoria_id;
  private $descripcion;
  private $precio;
  private $stock;
  private $oferta;
  private $fecha;
  private $imagen;
  private $marca;

  public function __construct() {
    $this -> db = Database::connect();
  }

  // Getters and Setters

  public function setId($id) {
    $this -> id = $id;
  }

  public function getId() {
    return $this -> id;
  }

  public function getCategoriaId() {
    return $this -> categoria_id;
  }

  public function setCategoriaId($categoria_id) {
    $this -> categoria_id = $this -> db -> real_escape_string($categoria_id);
  }

  public function getDescripcion() {
    return $this -> descripcion;
  }

  public function setDescripcion($descripcion) {
    $this -> descripcion = $this -> db -> real_escape_string($descripcion);
  }

  public function getPrecio() {
    return $this -> precio;
  }

  public function setPrecio($precio) {
    $this -> precio = $this -> db -> real_escape_string($precio);
  }

  public function getStock() {
    return $this -> stock;
  }

  public function setStock($stock) {
    $this -> stock = $this -> db -> real_escape_string($stock);
  }

  public function getOferta() {
    return $this -> oferta;
  }

  public function setOferta($oferta) {
    $this -> oferta = $this -> db -> real_escape_string($oferta);
  }

// Since this is an exercise to learn MVC pattern; I'm not using this properties in order to focus
// on learning
  public function getFecha() {
    return $this -> fecha;
  }

  public function setFecha($fecha) {
    $this -> fecha = $fecha;
  }

  public function getImagen() {
    return $this -> imagen;
  }

  public function setImagen($imagen) {
    $this -> imagen = $imagen;
  }

  public function getMarca() {
    return $this -> marca;
  }

  public function setMarca($marca) {
    $this -> marca = $this -> db -> real_escape_string($marca);
  }

  public function getAll() {

    $sql = "SELECT * FROM productos ORDER BY id DESC";
    $result = $this -> db -> query($sql);

    return $result;
  }

  public function getRandom($limit) {

    $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
    $result = $this -> db -> query($sql);

    return $result;
  } // End of getRandom

  public function delete($id) {

    $sql = "DELETE FROM productos WHERE id = $id";
    $result = $this -> db -> query($sql);

    return $result;
  } // End of delete

  public function edit($id) {

    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $this -> db -> query($sql);

    return $result;

  } // End of edit

  public function update() {

    $sql = "UPDATE productos
            SET categoria_id = {$this -> getCategoriaId()},
                descripcion = '{$this -> getDescripcion()}',
                precio = {$this -> getPrecio()},
                stock = {$this -> getStock()}
            WHERE id = '{$this -> getId()}'";

    $result = $this -> db -> query($sql);

    return $result;
  } // End of update

  public function showCategoryProducts($category_id) {

    $sql = "SELECT * FROM productos WHERE categoria_id = $category_id";
    $result = $this -> db -> query($sql);

    return $result;

  } // End of showCategoryProducts

  public function showProduct($id) {

    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $this -> db -> query($sql);

    return $result;

  } // End of showProduct

  public function getOneProduct($id) {

    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $this -> db -> query($sql);
    $product = $result -> fetch_object();

    return $product;

  } // End of showProduct


} // End of Class
