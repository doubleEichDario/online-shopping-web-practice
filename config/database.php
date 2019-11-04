<?php

  class Database {

    public static function connect() {
      $connection = new mysqli('localhost', 'root', '', 'web_store');

      // Query results in Spanish 
      $connection->query("SET NAMES 'utf8'");

      return $connection;
    }
  }
