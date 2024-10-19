<?php
/*
$text = 'Hallo Welt 123!';
var_dump(preg_match('/\d/', $text));
*/

// var_dump(preg_match('/\dOrangen\d/', 'hallo 5Orangen5 hallo'));

// var_dump(preg_match('/\d\sÄpfel/', '5 Äpfel'));

var_dump(preg_match('/\d/', 'Hallo 123', $matches));
var_dump($matches);
?>