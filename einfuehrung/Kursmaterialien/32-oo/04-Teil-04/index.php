<?php

class ImageHelper {

    public const QUALITY_LOW = 20;
    public const QUALITY_MEDIUM = 50;
    public const QUALITY_HIGH = 80;

    public static function resizeImage($a, $quality = 80) {
        var_dump($a);
        var_dump($quality);
    }
}

var_dump(ImageHelper::QUALITY_LOW);

ImageHelper::resizeImage("........", ImageHelper::QUALITY_MEDIUM);
