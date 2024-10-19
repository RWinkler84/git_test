<?php

function edit_page($user, $title) {
    if ($user !== 'admin') {
        throw new Exception('Der Benutzer ist nicht "admin".');
    }

    // Seite wird editiert
    return true;
}

try {
    edit_page('max', 'Startseite');
}
catch (Exception $e) {
    var_dump("Es ist ein Fehler aufgetreten");
    var_dump($e->getMessage());
}