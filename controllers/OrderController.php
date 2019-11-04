<?php

require_once 'models/Orders.php';
require_once 'helpers/Utils.php';
require_once 'controllers/CartController.php';

Class OrderController  {

  public function checkout() {

    require_once 'views/order/do.php';

  } // End of do

  public function add() {

    if(isset($_POST)) {

      // Save $_POST data in variables
      isset($_POST['estado']) ? $estado = $_POST['estado'] : false;
      isset($_POST['municipio']) ? $municipio = $_POST['municipio'] : false;
      isset($_POST['direccion']) ? $direccion = $_POST['direccion'] : false;

      if($estado && $municipio && $direccion && $_SESSION['cart']) {

         $cart = $_SESSION['cart'];
         $usuario = $_SESSION['identity'];

         $new_order = new Orders();

         $new_order -> setEstado($estado);
         $new_order -> setMunicipio($municipio);
         $new_order -> setDireccion($direccion);
         $new_order -> setImporte(Utils::getTotalFromCart());
         $new_order -> setUsuarioId($usuario -> id);

         // This function sets all date functions to a specific timezone
         date_default_timezone_set('America/Mexico_City');

         $new_order -> setFecha(date("d/m/Y"));
         $new_order -> setHora(date("h:i a"));

      }

      $order_result = $new_order -> insert();
      $order_relation_result = $new_order -> productOrderRelationshipInsert();

      $order_result && $order_relation_result ? $_SESSION['pedido'] = true : $_SESSION['pedido'] = false;

      // Empty cart in order to get new orders
      $_SESSION['pedido'] ? array_splice($GLOBALS[_SESSION]['cart'], 0) : false;

    }

    header('Location: '.base_url);

  } // End of add

  public static function getByUser() {

    if(isset($_SESSION['identity'])) {

      $id = $_SESSION['identity'] -> id;

      $orders = new Orders();
      $result = $orders -> getByUser($id);


      return $result;

    }

  } // End of getByUser

  public function details() {

    if(isset($_GET['id'])) {

      $id = $_GET['id'];
      $product = new Orders();

      $products_to_show = $product -> getProductsByOrder($id);

      require_once 'views/order/order_details.php';

    }

  }

}
