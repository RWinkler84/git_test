<?php
/*
var_dump(preg_match('/^H/', 'Hallo'));
var_dump(preg_match('/^H/', 'hallo'));
var_dump(preg_match('/^H/', '   Hallo'));
*/

// var_dump(preg_match('/^.*H/', ' Hallo'));


// var_dump(preg_match('/^.+@.+\..+$/', 'hallo@welt.de'));


var_dump(preg_match('/^\d{2}\.\d{2}\.\d{4}$/', '10.10.2090'));
var_dump(preg_match('/^\d{2}\.\d{2}\.\d{4}$/', '99.99.9999'));
?>