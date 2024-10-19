<pre><?php
echo "-------\nAufgabe 1:\n";

// Aufgabe 1: 
// Wandle das US-amerikanische Datumsformat ins deutsche um.
// 
// Der restliche Satz soll so bleiben wie er ist, nur der Datumswert 
// soll ausgetauscht werden.
// 
// Gibt es kein amerikanisches Datumsformat, soll der Satz so bleiben
// wie er ist.
// 
// Tipp: Bitte beachte, dass du den Schrägstrich (/) beim Pattern 
//       (der erste Parameter vom preg_replace bzw. preg_match) mit einem 
//       Backslash escapen musst: preg_replace('/\//', '', $x);

$task1 = [
    "Am 04.03.1990 bin ich geboren",
    "The Black Monday was on the 10/19/1987",
    "On the 10/22/2010, the first physical good has been paid with bitcoin",
];

foreach($task1 as $x) {
    var_dump($x);
}


echo "-------\nAufgabe 2:\n";
// Aufgabe 2: 
//
// Tipp: Bitte beachte, dass du das @-Zeichen beim Pattern 
//       (der erste Parameter vom preg_replace bzw. preg_match) mit einem 
//       Backslash escapen musst.
// 
// Extrahiere alle E-Mail-Adressen aus folgenden Texten:
$texts = [
    "Hallo asdfaf@web.de",
    "Ich bin eine andere E-Mail-Adresse: asdfasdf@gmail.com",
    "Und das hier ist keine E-Mail-Adresse: Lass uns um 8 Uhr @ München Hbf treffen"
];
foreach($texts AS $text) {

}




echo "\n-------\nAufgabe 3:\n";
// Aufgabe 3
//
// In einem Text sollen alle Links durch Hyperlinks ersetzt werden.
// Beispiel, aus:
// "Hallo, das hier ist ein Link zu Google: https://google.com" 
// soll folgender Code werden:
// "Hallo, das hier ist ein Link zu Google: <a href='https://google.com'>https://google.com</a>"
//
// Tipp: Bitte beachte, dass du die Schrägstriche "//" im Pattern (erster
//       Parameter von preg_replace bzw. preg_match) escapen musst, also dort
//       ggf. jeweils einen Backslash (\) davor stellen musst.
// 
$text = "Hallo, das hier ist ein Link zu Google: https://google.com.\n" . 
  "Und das hier ist ein Link zu Facebook: https://facebook.com";




echo "-------\nAufgabe 4:\n";
// Aufgabe 4
// Wir möchten unsere Datenbank auf doppelte E-Mail-Adressen hin
// überprüfen. 
// 
// 1) Manche E-Mail-Provider stellen den Nutzern mehrere Domains zur Verfügung.
// Ersetze daher jedes @googlemail.com durch ein @gmail.com.
//
// 2) Zudem ist es bei @gmail.com-Adressen, so, dass beim Namen alles hinter
// dem Plus ignoriert wird (aber auch nur bei @gmail.com / @googlemail.com-
// Adressen). Alles hinter dem Plus soll also für @gmail.com-Adressen
// entfernt werden.
//
// Beispiel:
//   hallo+welt@googlemail.com -> hallo+welt@gmail.com -> hallo@gmail.com
// 
// Du darfst für die beiden Aufgaben mehrere preg_replace hintereinander 
// verwenden.
//
// Tipp: Bitte beachte, dass du das @-Zeichen und das +-Symbol beim Pattern 
//       (der erste Parameter vom preg_replace bzw. preg_match) mit einem 
//       Backslash escapen musst.

$emails = [
    "googlemail@web.de",
    "hallo@gmail.com",
    "hallo@googlemail.com",
    "welt+hallo@gmail.com",
    "max.mueller@t-online.de",
    "gmail@googlemail.com",
    "max+mueller@gmail.com",
    "welt@gmail.com"
];

foreach($emails AS $email) {
    // Schreibe hier den Code
    var_dump($email);
}