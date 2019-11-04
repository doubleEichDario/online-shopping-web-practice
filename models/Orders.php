<?php

Class Orders {

  private $id;
  private $usuario_id;
  private $municipio;
  private $estado;
  private $direccion;
  private $importe;
  private $status;
  private $fecha;
  private $hora;

  public function __construct() {
    $this -> db = Database::connect();
  }

  public function getId() {
    return $this -> id;
  }

  public function setId($id) {
    $this -> id = $id;
  }

  public function getUsuarioId() {
    return $this -> usuario_id;
  }

  public function setUsuarioId($usuario_id) {
    $this -> usuario_id = $this -> db -> real_escape_string($usuario_id);
  }

  public function getMunicipio() {
    return $this -> municipio;
  }

  public function setMunicipio($municipio) {
    $this -> municipio = $this -> db -> real_escape_string($municipio);
  }

  public function getEstado() {
    return $this -> estado;
  }

  public function setEstado($estado) {
    $this -> estado = $this -> db ->real_escape_string($estado);
  }

  public function getDireccion() {
    return $this -> direccion;
  }

  public function setDireccion($direccion) {
    $this -> direccion = $this -> db -> real_escape_string($direccion);
  }

  public function getImporte() {
    return $this -> importe;
  }

  public function setImporte($importe) {
    $this -> importe = $this -> db -> real_escape_string($importe);
  }

  public function getFecha() {
    return $this -> fecha;
  }

  public function setFecha($fecha) {
    $this -> fecha = $this -> db-> real_escape_string($fecha);
  }

  public function getHora() {
    return $this -> hora;
  }

  public function setHora($hora) {
    $this -> hora = $this -> db -> real_escape_string($hora);
  }

  public function insert() {

    $sql = "INSERT INTO pedidos (id, usuario_id, municipio, estado, direccion, importe, status, fecha, hora)
            VALUES (NULL, '{$this -> getUsuarioId()}', '{$this -> getMunicipio()}', '{$this -> getEstado()}',
            '{$this -> getDireccion()}', '{$this -> getImporte()}', 'En proceso', '{$this -> getFecha()}', '{$this -> getHora()}')";

    $result = $this -> db -> query($sql);

    return $result;

  } // End of insert

  public function productOrderRelationshipInsert() {

    $sql = "SELECT LAST_INSERT_ID() AS 'pedido'";
    $query = $this -> db -> query($sql);

    $pedido_id = $query -> fetch_object() -> pedido;

    foreach($_SESSION['cart'] as $element) {

      $product = $element['product'];
      $linea_pedido_sql = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$product -> id}, {$element['units']})";

      $result = $this -> db -> query($linea_pedido_sql);

    }
    return $result ? true : false;

  } // End of productOrderRelationshipInsert

  public function getByUser($id) {

    $sql = "SELECT p.id, p.importe, p.status, SUM(lp.unidades) AS 'unidades' FROM pedidos p
            INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id
            INNER JOIN usuarios u ON p.usuario_id = u.id
            WHERE usuario_id = $id
            GROUP BY pedido_id";

    $orders = $this -> db -> query($sql);

    if($orders -> num_rows >= 1) {

      while($order = $orders -> fetch_object() ) {
        $user_orders[] = $order;
      }

      return $user_orders;

    } else {

      return false;

    }

  } // End of getByUser

  public function getProductsByOrder($id) {

    $sql = "SELECT lp.*, p.* FROM productos p
            INNER JOIN lineas_pedidos lp ON lp.producto_id = p.id
            INNER JOIN pedidos ON lp.pedido_id = pedidos.id
            WHERE pedidos.id = {$id}
            GROUP BY p.id";

    $products = $this -> db -> query($sql);
    
    if($products -> num_rows >= 1) {

      while($product = $products -> fetch_object() ) {
        $products_by_order[] = $product;
      }

      return $products_by_order;

    } else {

      return false;

    }

  } // End of getProductsByOrder

} // End of Class
