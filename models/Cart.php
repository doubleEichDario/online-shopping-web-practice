<?php

require_once 'helpers/Utils.php';

Class Cart {

  public static function units($action, $index) {

    if($action == 'raise' && $_SESSION['cart'][$index]['units'] >= 1) {

      $_SESSION['cart'][$index]['units']++;

    } elseif($action == 'decrease' && $_SESSION['cart'][$index]['units'] >= 2) {

      $_SESSION['cart'][$index]['units']--;

    }

  } // End of units

}
