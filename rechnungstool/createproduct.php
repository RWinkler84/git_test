<?php
require 'db.php';

$stmt = $conn->prepare("INSERT INTO products (productTitle, productPrice, taxRate, productDescription) VALUES (?,?,?,?)");
$stmt->bind_param('ssss', $_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription']);
$result = $stmt->execute();

if ($result){
  return "Daten gespeichert.";
} else {
  return "Es gab einen Fehler." . $stmt->error;
}
?>