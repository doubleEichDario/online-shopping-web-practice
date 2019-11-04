<?php
  session_start();
  require_once 'autoload.php';
  require_once 'config/database.php';
  require_once 'config/parameters.php';
  require_once 'helpers/Utils.php';

  // Requiring web layout
  require_once 'views/layout/header-navigation.php';
  require_once 'views/layout/aside-section.php';
  require_once 'views/layout/main-content.php';

  // If we search for something that does not exists
  function showError() {
    $error = new ErrorController();
    $error->index();
  }

  // Check if there is a controller name on URL
  if(isset($_GET['controller'])) {

    // If exists a variable is generated
    $controller_name = $_GET['controller']."Controller";

  } elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {

    // Show default controller if there is no GET values
    $controller_name = default_controller;


  } else {
    showError();
    exit();
  }

// Check if class exists
if(class_exists($controller_name)) {

  // Instantiate that class
  $controller = new $controller_name();

  // Check if a method or 'action' of that class exists
  if(isset($_GET['action']) && method_exists($controller, $_GET['action'])) {

    $action = $_GET['action'];

    // Call method
    $controller -> $action();

  } elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {

    // If there is no action on the URL
    $default_action = default_action;
    $controller -> $default_action();

  } else {
    showError();
  }

} else {
  showError();
}

// Footer from web layout
require_once 'views/layout/footer.php';

?>
