<?php
require_once 'models/Categories.php';

class Utils {

  public static function deleteSession($name) {

    if(isset($_SESSION[$name])) {

      unset($_SESSION[$name]);
      $_SESSION[$name] = null;

    }

    return $name;

  } // End of deleteSession

  public static function show_categories() {

    $categories = new Categories();
    $categories -> showAll();

  } // End of show_categories

  public static function isAdmin() {

    if(!isset($_SESSION['admin']) && !$_SESSION['admin'] == true) {
      header("Location: ".base_url);
    }

  } // End of isAdmin

  public static function showCategoryName($category_id) {

    $sql = "SELECT nombre FROM categorias WHERE id = $category_id";
    $db = Database::connect();
    $result = $db -> query($sql);
    $fetched_object = $result -> fetch_object();
    $name_of_category = $fetched_object -> nombre;

    return $name_of_category;

  } // End of showCategoryName

  public static function getTotalFromCart() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      foreach ($cart as $index => $item) {
        $product = $item['product'];
        $subtotal = $product -> precio * $item['units'];
        $total += $subtotal;
      }
      // return '$ '.$total;
      return $total;
    } else {
      return 'No hay productos en el carrito';
    }

  } // End of getTotalFromCart

  public static function countItemsInCart() {

    $total = 0;
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      foreach ($cart as $index => $item) {
        $total += $item['units'];
      }
      return $total;
    } else {
      return 0;
    }

  } // End of countItemsInCart

} // End of Class
