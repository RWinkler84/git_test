<?php
$host = 'localhost';
$user = 'root';
$pw = '';
$database = 'invoicetool';
try {
$conn = new mysqli($host,$user,$pw, $database);
$conn->set_charset('UTF8');
} catch (Exception $e){
http_response_code(500);
die ('Datenbank konnte nicht kontaktiert werden');
}
?>