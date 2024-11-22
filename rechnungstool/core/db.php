<?php 
$host = 'localhost';
$user = 'root';
$pw = '';
$database = 'invoicetool';

$conn = new mysqli($host,$user,$pw, $database);
$conn->set_charset('UTF8');

if ($conn->connect_error){
  die (http_response_code(500));
}
?>