<?php

class InvalidUserException extends Exception {}
class TitleTooShortException extends Exception {}

function edit_page($user, $title) {
    if ($user !== 'admin') {
        throw new InvalidUserException('Der Benutzer ist nicht "admin".');
    }
    if (strlen($title) < 3) {
        throw new TitleTooShortException('');
    }

    // Seite wird editiert
    return true;
}

try {
    edit_page('admin', 'S');
}
catch (InvalidUserException $e) {
    var_dump("Es ist ein Fehler aufgetreten");
    var_dump($e->getMessage());
}
catch (TitleTooShortException $e) {
    var_dump("Der Titel ist zu kurz...");
}