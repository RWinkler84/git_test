<?php
declare(strict_types=1);

function resizeImage($fromFile, $toFile = null, $maxDimension = 300) {
   // Set a maximum height and width
   $width = $maxDimension;
   $height = $maxDimension;

   // Get new dimensions
   list($widthOrig, $heightOrig) = getimagesize($fromFile);
   // Valid image so far?
   if ($widthOrig === NULL || $heightOrig === NULL) {
      return false;
   }
   // Image too big?
   if ($widthOrig >= 20000 || $heightOrig >= 20000) {
      return false;
   }

   $ratioOrig = $widthOrig/$heightOrig;

   if ($width/$height > $ratioOrig) {
      $width = (int) round($height*$ratioOrig);
   } else {
      $height = (int) round($width/$ratioOrig);
   }

   // Resample
   $imageP = imagecreatetruecolor($width, $height);
   $image = @imagecreatefromjpeg($fromFile);
   if ($image === false) {
      return false;
   }
   imagecopyresampled($imageP, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);

   // Output
   imagejpeg($imageP, $toFile, 80);
   imagedestroy($imageP);
   imagedestroy($image);

   return true;
}