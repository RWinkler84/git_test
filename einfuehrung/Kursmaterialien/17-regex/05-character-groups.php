<?php

// var_dump(preg_match('/[A-Z]/', 'Hallo Welt', $matches));
// var_dump($matches);

// var_dump(preg_match('/[a-zöäüß]/', 'Hällo Welt', $matches));
// var_dump($matches);

// var_dump(preg_match('/[a-z]+/', 'Hallo Welt', $matches));
// var_dump($matches);

// var_dump(preg_match('/[0-9]+ ?€/', 'Ein Apfel kostet 10 €', $matches));
// var_dump($matches);

// var_dump(preg_match('/^[a-zA-Z\.\-0-9]+\@gmail.com$/', 'kjhsadjkfh@gmail.com', $matches));
// var_dump($matches);

var_dump(preg_match('/\@gmail.com$/', 'kjhsadjkfh@gmail.com', $matches));
var_dump($matches);