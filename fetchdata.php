<?php 
require 'db.php';
$fetchdata = $db->query("SELECT id, name FROM costumer");
$costumer = $fetchdata->fetch_all(MYSQLI_ASSOC); 

echo "<pre>";
print_r ($costumer);
echo "</pre>";

echo $costumer[0]["name"];

?>