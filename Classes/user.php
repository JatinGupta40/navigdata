<?php
namespace userQuery;
use connectionDB\connection;

require_once ($_SERVER['DOCUMENT_ROOT']. '/navigdata/db/connection.php');

class user extends connection {
  public $result;

  public function checkEmail($email) {
    $result = mysqli_query($this->connection,"SELECT * FROM users WHERE email = '$email'");
    return $result;
  }
  
}   