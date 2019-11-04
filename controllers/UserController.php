<?php
  require_once 'models/User.php';

  Class UserController {

    public function registration() {
      require_once 'views/user/registration.php';
    }

    public function save() {

      if(isset($_POST)) {

        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;

        if($nombre && $apellidos && $email && $password) {

          $user = new User();

          // Fill properties with POST values
          $user -> setNombre($nombre);
          $user -> setApellidos($apellidos);
          $user -> setEmail($email);
          $user -> setPassword($password);

          // Call save() method from User model
          $saved = $user -> save();

          // Set a SESSION variable if everything goes well
          $saved ? $_SESSION['registration'] = "Success!" : $_SESSION['registration'] = "Failed!";

        } else {

          $_SESSION['registration'] = "Failed";

        }

      } else {

        $_SESSION['registration'] = "Failed";

      }

      header("Location: ".base_url.'User/registration');


    }

    public function login() {

      if(isset($_POST)) {

        $email = isset($_POST['usuario']) ? $_POST['usuario'] : false;
        $password = isset($_POST['password']) ? $_POST['password'] : false;

        $user = new User();

        $user -> setEmail($email);
        $user -> setPassword($password);

        $identity = $user -> login();
        if($identity && is_object($identity)) {
          $_SESSION['identity'] = $identity;

          if($_SESSION['identity'] -> rol == 'admin') {
            $_SESSION['admin'] = true;
          }
        } else {
          $_SESSION['error_login'] = '¡Error! No coincide la dirección o la contraseña';
        }
      }
      header("Location:".base_url);
    }

    public function logout() {

      if(isset($_SESSION['identity'])) {
        unset($_SESSION['identity']);
      }

      if(isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
      }
      header("Location:".base_url);
    }

  } // End of Class
