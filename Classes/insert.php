<?php
namespace insertQuery;
use connectionDB\connection;

require_once($_SERVER['DOCUMENT_ROOT']. '/navigdata/db/connection.php');

class insert extends connection {
  public $result;

  public function selectQuery() {
    $result = mysqli_query($this->connection, "SELECT * FROM");
    return $result;
  }

  public function insertUserDetails($fname, $lname, $email, $pass, $date, $time) {
    $result = mysqli_query($this->connection,"INSERT INTO users (fname, lname, email, password, register_date, register_time) VALUES ('$fname', '$lname', '$email', '$pass', '$date', '$time')");
    return $result;
  }
}