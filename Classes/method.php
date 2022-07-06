<?php
namespace methodQuery;
use connectionDB\connection;

require_once($_SERVER['DOCUMENT_ROOT']. '/navigdata/db/connection.php');

class method extends connection {
  public $result;

  public function numRows($data) {
    $result = mysqli_num_rows($data);
    return $result;
  }

  public function fetchAssoc($data) {
    $result = mysqli_fetch_assoc($data);
    return $result;
  }

  public function fetchArray($data) {
    $result = mysqli_fetch_assoc($data);
    return $result;
  }
}