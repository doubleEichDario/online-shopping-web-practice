<?php
require_once 'models/Products.php';

  class ProductController {

    public function index() {
      $product = new Products();
      $hot_products = $product -> getRandom(10);

      require_once 'views/products/hot.php';
    }

    public function manage() {

      Utils::isAdmin();
      $product = new Products();
      $products = $product -> getAll();

      require_once 'views/products/manage.php';
    }

    public function create() {
      require_once 'views/products/create.php';
    } // End of manage

    public function insert() {

      Utils::isAdmin();
      if(isset($_POST['categoria']) && isset($_POST['descripcion']) &&
         isset($_POST['precio']) && isset($_POST['stock']) && isset($_FILES['imagen'])) {

           $product = new Products();

           $product -> setDescripcion($_POST['descripcion']);
           $product -> setCategoriaId($_POST['categoria']);
           $product -> setPrecio($_POST['precio']);
           $product -> setStock($_POST['stock']);

           // Saving images
           $image_file = $_FILES['imagen'];
           $image_file_name = $image_file['name'];
           $mimetype = $image_file['type'];

           if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

             // If 'uploads' directory doesn't exist; create it
             if(!is_dir('uploads/images')) {
               mkdir('uploads/images', 0777, true);
             }
             // Move uploaded image file to directory
             move_uploaded_file($image_file['tmp_name'], 'uploads/images/'.$image_file_name);
             $product -> setImagen($image_file_name);

             $result = $product -> db -> query(
                         "INSERT INTO productos (categoria_id, descripcion, precio, stock, imagen)
                         VALUES({$product -> getCategoriaId()}, '{$product -> getDescripcion()}',
                         {$product -> getPrecio()}, {$product -> getStock()}, '{$product -> getImagen()}')"
                       );

              // If database query success redirects to manage page and sets a $_SESSION variable
              // to show a success alert
              if($result) {
                $_SESSION['inserting_query'] = true;
                header("Location: ".base_url."Product/manage");
              }

           // If saving an image fails
           } else {
             $_SESSION['inserting_query'] = false;
             header("Location: ".base_url."Product/manage");
           }

         // If $_POST and $_FILES global variables don't get set
         } else {
           $_SESSION['inserting_query'] = false;
           header("Location: ".base_url."Product/manage");
         }

    } // End of insert()

    public function delete() {

      Utils::isAdmin();
      if(isset($_GET['id'])) {

        $product = new Products();
        $product -> setId($_GET['id']);

        $result = $product -> delete($product -> getId());

        if($result) {
          $_SESSION['deleting_query'] = true;
        }else{
          $_SESSION['deleting_query'] = false;
        }

        header("Location: ".base_url."Product/manage");

      }

    } // End of delete

    public function edit() {

      Utils::isAdmin();
      if(isset($_GET['id'])) {

        $product = new Products();
        $product -> setId($_GET['id']);

        $result = $product -> edit($product -> getId());

        if($result) {
          $_SESSION['edit_item'] = true;
        }else{
          $_SESSION['edit_item'] = false;
        }

        require_once 'views/products/create.php';

      } // End of edit
    }

    public function update() {

      Utils::isAdmin();
      if(isset($_POST['categoria']) && isset($_POST['descripcion']) &&
         isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['id']) && isset($_FILES['imagen'])) {


           $product = new Products();

           $product -> setID($_POST['id']);
           $product -> setDescripcion($_POST['descripcion']);
           $product -> setCategoriaId($_POST['categoria']);
           $product -> setPrecio($_POST['precio']);
           $product -> setStock($_POST['stock']);

           // Saving images
           $image_file = $_FILES['imagen'];
           $image_file_name = $image_file['name'];
           $mimetype = $image_file['type'];

           if($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

             // If 'uploads' directory doesn't exist; create it
             if(!is_dir('uploads/images')) {
               mkdir('uploads/images', 0777, true);
             }
             // Move uploaded image file to directory
             move_uploaded_file($image_file['tmp_name'], 'uploads/images/'.$image_file_name);
             $product -> setImagen($image_file_name);

             $result = $product -> update();

             if($result) {
               // If updating query success
               $_SESSION['updated_product'] = true;
             } else {
               // If not
               $_SESSION['updated_product'] = false;
             }

            }
      }
      header("Location: ".base_url."Product/manage");
    } // End of update

    public function categorized() {

      if(isset($_GET['id'])){

        $category_id = $_GET['id'];

        $product_by_category = new Products();
        $result = $product_by_category -> showCategoryProducts($category_id);


        if($result -> num_rows >= 1) {
          require_once 'views/products/categorized.php';
        } else {
          echo "<p class=\"out-of-corner not-found\">Aún no hay productos en esta categoría</p>";
        }
      }
    } // End of categorized

    public function product() {

      if(isset($_GET['id'])){

        $product_id = $_GET['id'];

        $product = new Products();
        $result = $product -> showProduct($product_id);

        if($result -> num_rows == 1) {
          require_once 'views/products/product_details.php';
        } else {
          echo "<p class=\"out-of-corner not-found\">No se encuentra el producto</p>";
        }
      }

    } // End of product

  }
