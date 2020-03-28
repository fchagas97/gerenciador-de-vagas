<?php 
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        
        $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
        
        #self::$instance = new PDO('mysql:host=localhost;dbname=estacionamento', 'root', '', $pdo_options);

        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');
        $db_pw   = getenv('DB_PW');
        self::$instance = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pw, $pdo_options);
      }
      return self::$instance;
    }
  }
?>