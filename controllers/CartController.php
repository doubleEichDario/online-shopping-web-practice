<?php

require_once 'models/Cart.php';
require_once 'models/Products.php';

Class CartController {

  public function index() {

    if(isset($_SESSION['cart'])) {

    $cart = $_SESSION['cart'];
    require_once 'views/cart/index.php';

  } else {
    echo '<p class="out-of-corner not-found">No hay productos en el carrito</p>';
  }


  } // End of index

  public function add() {

    if(isset($_GET['id'])) {

      $product_id = $_GET['id'];
      $already_in_cart = false;

      if(isset($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $index => $element) {
          // Look for duplicated products
          if($element['product_id'] == $product_id) {
            // If so, add one to 'units'
            $_SESSION['cart'][$index]['units']++;
            $already_in_cart = true;
          }
        }

      }
      // If $already_in_cart changes to true, it means
      // $_SESSION['cart'] variable is set;
      // hence false value on $already_in_cart adds new product if no
      // matched product is present or if 'cart' variable is not set, it sets
      if(!$already_in_cart) {

        $product = new Products();
        $result = $product -> getOneProduct($product_id);

        if(is_object($result)) {
          // Getting result set of a query to database
          $_SESSION['cart'][] = array(
            'product_id' => $result -> id,
            'price' => $result -> precio,
            'units' => 1,
            'product' => $result
          );
        }
      }
    }

    header('Location: '.base_url.'Cart/index');

  } // End of add

  public function remove() {

    if(isset($_GET['id']) && $_SESSION['cart']) {

      $id_of_product_to_remove = (int)$_GET['id'];
      unset($GLOBALS[_SESSION]['cart'][$id_of_product_to_remove]);

    }

    header('Location: '.base_url.'Cart/index');

  }// End of remove

  public function empty() {

    array_splice($GLOBALS[_SESSION]['cart'], 0);

    header('Location: '.base_url.'Cart/index');

  } // End of empty

  public function units() {

    if(isset($_GET['id']) && isset($_GET['do'])) {
      Cart::units($_GET['do'], $_GET['id']);
    }

    header('Location: '.base_url.'Cart/index');

  } // End of units

}
