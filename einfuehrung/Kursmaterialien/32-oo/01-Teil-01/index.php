<?php

class Image {

    public static $a = 'Hallo Welt';

    public static function resize($a) {
        var_dump('Das Bild wird skaliert...');
        var_dump($a);
    }
}

// $i = new Image();
// $i->resize('Parameter');

Image::resize('Parameter...');
var_dump(Image::$a);