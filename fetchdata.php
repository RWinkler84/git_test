<?php 
require 'db.php';

  $fetchCostumer = $conn->query("SELECT id, name FROM costumer");
  $costumer = $fetchCostumer->fetch_all(MYSQLI_ASSOC);
  usort($costumer, function($a, $b){
    return strcmp($a['name'], $b['name']);
  });

  $fetchProduct= $conn->query("SELECT id, productTitle FROM products");
  $product = $fetchProduct->fetch_all(MYSQLI_ASSOC);
  usort($product, function($a, $b){
    return strcmp($b['id'], $a['id']);
  });

?>