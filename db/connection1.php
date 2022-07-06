<?php
namespace connectionDB;
use Mysqli;

class connection {
  public $connection;
  // Constructor
  public function __construct() {
    $servername = "localhost";
    $username = "navigteh_navigdata";
    $password = "Navigdata@890";
    $db_name = "navigteh_navig";
    try {
      $this->connection = mysqli_connect($servername, $username, $password , $db_name);
    }
    catch(Exception $e) {
      echo "DB Connection Failed", $e;
    }
  }
}

?>