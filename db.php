<?php 
error_reporting(E_ALL);
$db = new mysqli('localhost','root','','invoicetool');
$db->set_charset('UTF8');
print_r($db->connect_error);
?>