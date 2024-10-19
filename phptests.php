<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  
<?php
/*
$sum = 0;

$numbers = [1,2,3,4,5,6,7];

for ($i = 0; $i < count($numbers); $i++){
  $sum += $numbers[$i];
  echo $sum . "<br>";
} */

$a = [
  [1,2,3,4,5],
  [6,7,8,9,10]
];

$sum = 0;

foreach ($a as $b){
  foreach ($b as $value){
    echo $sum . " + " . $value . " = ";
    $sum += $value;
    echo $sum . "<br>";
  }
}
?>


</body>

</html>