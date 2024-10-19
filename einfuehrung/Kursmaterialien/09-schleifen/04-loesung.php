<?php
// Aufgabe:
// 1) Summiere alle Zahlen von 1 bis einschließlich 100 auf
// 2) Summiere alle Zahlen auf, bis die Gesamtsumme über oder gleich 1000 ist.
// 
// Verwende für beide Aufgaben die jeweils korrekte Schleife, d.h. verwende
// die while-Schleife nur dann, wenn es zwingend für die Berechnung notwendig ist.


$sum = 0;
for ($x = 1; $x <= 100; $x++) {
    // $sum = $sum + $x;
    $sum+=$x;
}
var_dump($sum);

echo "----\n";

$sum = 0;
$x = 1;
while ($sum < 1000) {
    // if ($sum + $x >= 1000) break;
    $sum = $sum + $x;
    $x = $x + 1;
}
var_dump($sum);


?>