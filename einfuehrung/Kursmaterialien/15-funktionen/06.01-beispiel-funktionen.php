<?php
header('Content-Type: text/plain');

$str = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam commodo condimentum libero, ornare ultrices erat egestas sit amet. In est metus, condimentum sit amet eros ut, sollicitudin volutpat velit. Ut finibus orci lorem, non congue massa consectetur aliquet. Vivamus efficitur eros enim, quis faucibus nibh pretium vitae. Nullam mattis lobortis ipsum sit amet tempus. Phasellus nisl justo, dictum at facilisis at, laoreet vel urna. Phasellus et nibh et augue ultricies aliquet. Vestibulum id massa nec quam molestie volutpat cursus semper neque. Praesent finibus imperdiet lobortis. Suspendisse sit amet lacus vel arcu imperdiet eleifend. Morbi sagittis libero at rutrum imperdiet. Maecenas vitae bibendum est. Integer sed nunc vitae est gravida hendrerit vel eget est. Pellentesque quis congue arcu. Nam ut lacus quam.";

// 1: Anzahl der Wörter zählen
// 2: Anzahl der Sekunden ausrechnen, um den Text zu lesen
// 3: Text ausgeben: "Sie brauchen im Schnitt 3 Minuten und 10 Sekunden, um diesen Text zu lesen."

function count_words($text) {
    $words = explode(' ', $text);
    return count($words);
}

function get_text_seconds($text) {
    $wordCount = count_words($text);
    return ceil($wordCount / 1.5);
}

function seconds_to_paragaph($seconds) {
    if ($seconds === 1) {
        return 'Sie benötigen eine Sekunde, um diesen Text zu lesen';
    }
    if ($seconds <= 59) {
        return "Sie benötigen {$seconds} Sekunden, um diesen Text zu lesen";
    }
    $minutes = floor($seconds / 60);
    $seconds = $seconds % 60;
    return "Sie benötigen {$minutes} Minute(n) und {$seconds} Sekunde(n), um diesen Text zu lesen";
}

// $seconds = get_text_seconds($str);
// var_dump($seconds);
/*
var_dump(seconds_to_paragaph(1));
var_dump(seconds_to_paragaph(55));
var_dump(seconds_to_paragaph(60));
var_dump(seconds_to_paragaph(61));
*/

$seconds = get_text_seconds($str);
echo seconds_to_paragaph($seconds);