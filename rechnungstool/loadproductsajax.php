<?php
require 'db.php';

$fetchProduct = $conn->query("SELECT id, productTitle, productPrice FROM products");
$product = $fetchProduct->fetch_all(MYSQLI_ASSOC);

echo json_encode($product);
 
