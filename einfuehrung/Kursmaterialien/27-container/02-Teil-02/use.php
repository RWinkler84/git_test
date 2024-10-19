<?php

function execute($func) {
    $func();
}

function f() {
    $name = 'Max Müller';

    execute(function() use($name) {
        var_dump($name);
        var_dump("Funktion wird ausgeführt");
    });
}

f();