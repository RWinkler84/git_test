<?php

// var_dump(preg_match('/\d*/', '123456 Hallo 123 Welt...', $matches));
// var_dump($matches);

// var_dump(preg_match('/\d+/', 'Hallo 123 Welt...', $matches));
// var_dump($matches);

// var_dump(preg_match('/Hallo?/', 'Hallo Welt', $matches));
// var_dump($matches);

// var_dump(preg_match('/apples?/', 'apple, oranges,..', $matches));
// var_dump($matches);

var_dump(preg_match('/apples{0,1}/', 'apple, oranges,..', $matches));
var_dump($matches);

?>