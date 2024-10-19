<pre><?php

$zip = new ZipArchive();

var_dump($zip);

$zip->open(__DIR__ . '/Archive.zip');

var_dump($zip);

// $fn = $zip->getNameIndex(0);
// var_dump($fn);

$contents = $zip->getFromName('secret.txt');
var_dump($contents);

$zip2 = new ZipArchive();
$zip2->open(__DIR__ . '/Archive2.zip');
var_dump($zip2->getNameIndex(0));

// $zip2->extractTo(__DIR__);

?></pre>