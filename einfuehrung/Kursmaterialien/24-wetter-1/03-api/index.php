<?php

$url = 'https://downloads.codingcoursestv.eu/052%20-%20php/wetter.json';

$fp = fsockopen("ssl://downloads.codingcoursestv.eu", 443, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "GET /052%20-%20php/wetter.json HTTP/1.1\r\n";
    $out .= "Host: downloads.codingcoursestv.eu\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);

    $responseArray = [];
    while (!feof($fp)) {
        $responseArray[] = fgets($fp, 128);
    }
    fclose($fp);

    $response = implode('', $responseArray);

    // In [0] liegt die Zeile für den HTTP-Status-Code, in [1] der gesamte Rest 
    // der gesamten Antwort vom Server (inkl. Header)
    $responseSplitted = explode("\r\n", $response, 2);

    if ($responseSplitted[0] === 'HTTP/1.1 200 OK') {
        // In [0] liegen die gesamten Header, in [1] der eigentliche Inhalt der
        // Antwort vom Server
        $responseSplitted2 = explode("\r\n\r\n", $responseSplitted[1], 2);
        
        $actualResponseContent = trim($responseSplitted2[1]);
        $decodedResponse = json_decode($actualResponseContent, true);

        if (!empty($decodedResponse)) {
            var_dump($decodedResponse);
        }
    }
}