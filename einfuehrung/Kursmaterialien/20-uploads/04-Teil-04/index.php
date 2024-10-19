<?php

header("Content-Type: image/jpeg");

$img = imagecreatefromjpeg('bild.jpg');

$imgSmaller = imagescale($img, 100);

imagejpeg($imgSmaller);

?>