<?php

  class User {

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct() {
      $this -> db = Database::connect();
    }

    // id
    public function getId() {
      return $this-> id;
    }

    public function setId($id) {
      $this -> id = $id;
    }

    //nombre
    public function getNombre() {
      return $this -> nombre;
    }

    public function setNombre($nombre) {
      $this -> nombre = $this -> db -> real_escape_string($nombre);
    }

    // apellidos
    public function getApellidos() {
      return $this -> apellidos;
    }

    public function setApellidos($apellidos) {
      $this -> apellidos = $this -> db -> real_escape_string($apellidos);
    }

    // email
    public function getEmail() {
      return $this -> email;
    }

    public function setEmail($email) {
      $this -> email = $this -> db -> real_escape_string($email);
    }

    // password
    public function getPassword() {
      return password_hash($this -> db -> real_escape_string($this -> password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password) {
      $this -> password = $password;
    }

    // rol
    public function getRol() {
      return $this -> rol;
    }

    public function setRol($rol) {
      $this -> rol = $this -> db -> real_escape_string($rol);
    }

    public function save() {

      $sql = "INSERT INTO usuarios (id, nombre, apellidos, email, password, rol) VALUES(null, '{$this -> getNombre()}', '{$this -> getApellidos()}', '{$this -> getEmail()}', '{$this -> getPassword()}', 'user')";
      $save = $this -> db -> query($sql);

      $result = false;

      // If query success
      if($save) {
        $result = true;
      }

      return $result;
    }

    public function login() {

      $result = false;

      $sql = "SELECT * FROM usuarios WHERE email = '{$this -> email}'";
      $query = $this -> db -> query($sql);

      // Check if user exists
      if($query && $query -> num_rows == 1) {

        // Ask for associative object
        $user = $query -> fetch_object();

        // Verify password
        if (password_verify($this -> password, $user -> password)) {

          $result = $user;

        } else {

          return 'Ooops';
        }
      }

      return $result;
    }

  }
