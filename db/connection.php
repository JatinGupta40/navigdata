<?php
namespace connectionDB;
use Mysqli;

class connection {
  public $connection;
  // Constructor
  public function __construct() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "navigdata";
    try {
      $this->connection = mysqli_connect($servername, $username, $password , $db_name);
    }
    catch(Exception $e) {
      echo "DB Connection Failed", $e;
    }
  }
}

?>