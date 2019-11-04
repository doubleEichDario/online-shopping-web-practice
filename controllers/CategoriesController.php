<?php
require_once 'models/Categories.php';

class CategoriesController {

  private $id;
  private $nombre;

  public function manage() {

    Utils::isAdmin();
    $categorias = new Categories();

    $all = $categorias -> showAll();

    require_once 'views/categories/manage.php';
  }

  public function create() {
    require_once 'views/categories/create.php';
  }

  public function insert() {

    Utils::isAdmin();
    if(isset($_POST['category_name'])) {
      $category_to_insert = $_POST['category_name'];
      $new_category = new Categories();
      $new_category -> setNombre($category_to_insert);

      $result = $new_category -> insert();

      if($result) {
        $_SESSION['inserting_category'] = true;
      } else {
        $_SESSION['inserting_category'] = false;
      }

    }

    header("Location:".base_url."Categories/manage");

  }

  public function delete() {

    Utils::isAdmin();
    if(isset($_GET['id'])){

      $id = $_GET['id'];

      $category = new Categories();
      $result = $category -> delete($id);

      if($result) {
        $_SESSION['deleting_category'] = true;
      } else {
        $_SESSION['deleting_category'] = false;
      }
    }
    header("Location: ".base_url."Categories/manage");
  }

  public function edit() {

    Utils::isAdmin();
    if(isset($_GET['id'])){

      $id = $_GET['id'];

      $category = new Categories();
      $result = $category -> edit($id);

      if($result) {
        $_SESSION['edit_category'] = true;
      } else {
        $_SESSION['edit_category'] = false;
      }
      require_once 'views/categories/create.php';
    }

  }

  public function update() {

    Utils::isAdmin();
    if(isset($_POST['category_name']) && isset($_POST['id'])) {
      $category_id_to_update = $_POST['id'];
      $category_to_update = $_POST['category_name'];

      $update_category = new Categories();
      $update_category -> setNombre($category_to_update);
      $update_category -> setId($category_id_to_update);


      $result = $update_category -> update();

      if($result) {
        $_SESSION['updated_category'] = true;
      } else {
        $_SESSION['updated_category'] = false;
      }
    }
    header("Location: ".base_url."Categories/manage");
  } // End of update


}
