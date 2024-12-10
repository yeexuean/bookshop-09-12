<?php 
require_once('config.php');

function getDBConnection() {
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE;
    try {
        $db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }
  }
?>