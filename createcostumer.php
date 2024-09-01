<?php
require 'db.php';

$stmt = $conn->prepare("INSERT INTO costumer (name, address, taxId, salesTaxId) VALUES (?,?,?,?)");
$stmt->bind_param('ssss', $_POST['name'], $_POST['address'], $_POST['taxId'], $_POST['salesTaxId']);
$result = $stmt->execute();

if ($result){
  echo "Daten gespeichert.";
} else {
  echo "Es gab einen Fehler." . $stmt->error;
}

var_dump($result);
?>