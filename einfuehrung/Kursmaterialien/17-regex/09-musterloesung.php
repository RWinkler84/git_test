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

$task1 = [
    "Am 04.03.1990 bin ich geboren",
    "The Black Monday was on the 10/19/1987",
    "On the 10/22/2010, the first physical good has been paid with bitcoin",
];

foreach($task1 as $x) {
    var_dump(preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$2.$1.$3', $x));
    // var_dump(preg_replace('/([01]?\d{1})\/([0-9]{2})\/(\d{4})/', '$2.$1.$3', $x));
}



echo "-------\nAufgabe 2:\n";
// Aufgabe 2: 
// Extrahiere alle E-Mail-Adressen aus folgenden Texten:
$texts = [
    "Hallo asdfaf@web.de",
    "Ich bin eine andere E-Mail-Adresse: asdfasdf@gmail.com",
    "Und das hier ist keine E-Mail-Adresse: Lass uns um 8 Uhr @ München Hbf treffen"
];
foreach($texts AS $text) {
    // var_dump(preg_match('/[^\s]+\@[^\s]+/', $text, $m));
    var_dump(preg_match('/\S+\@\S+\.\S+/', $text, $m));
    if (count($m) === 1) {
        var_dump($m[0]);
    }
}

echo "-------\nAufgabe 3:\n";
// Aufgabe 3
//
// In einem Text sollen alle Links durch Hyperlinks ersetzt werden.
// Beispiel, aus:
// "Hallo, das hier ist ein Link zu Google: https://google.com" 
// soll folgender Code werden:
// "Hallo, das hier ist ein Link zu Google: <a href='https://google.com'>https://google.com</a>"
//
$text = "Hallo, das hier ist ein Link zu Google: https://google.com.\n" . 
  "Und das hier ist ein Link zu Facebook: https://facebook.com";

echo preg_replace('/(https?.*\.[a-zA-Z]+)/', '<a href="$1">$1</a>', $text);
// echo preg_replace('/(https?.*\.[a-zA-Z]+)/', "<a href='$1'>$1</a>", $text);
// echo preg_replace('/(https?.*\.[a-zA-Z]+)/', '<a href=\'$1\'>$1</a>', $text);


echo "\n-------\nAufgabe 4:\n";
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
    $email = preg_replace('/\@googlemail\.com$/', '@gmail.com', $email);
    $email = preg_replace('/^(.*)\+.*\@gmail\.com$/', '$1@gmail.com', $email);
    var_dump($email);
}