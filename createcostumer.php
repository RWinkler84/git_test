<?php
require 'db.php';
$saveCostumer = $db->query("INSERT INTO costumer (id, name, address, taxId, salesTaxId) 
  VALUES ('{$_POST[name]}', '{$_POST[address]}', '{$_POST[taxId]}', '{$_POST[salesTaxId]}'");
var_dump($saveCostumer);
print_r($_POST);
echo $_POST['name'];



?>