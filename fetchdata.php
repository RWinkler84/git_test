<?php 
require 'db.php';

  $fetchCostumer = $conn->query("SELECT id, name FROM costumer");
  $costumer = $fetchCostumer->fetch_all(MYSQLI_ASSOC);
  usort($costumer, function($a, $b){
    return strcmp($a['name'], $b['name']);
  });


?>