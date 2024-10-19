<?php

// var_dump(preg_replace('/a/', '-', 'Hallo Welt!'));

// var_dump(preg_replace('/l/', '-', 'Hallo Welt!', 2));

// var_dump(preg_replace('/[a-z]/', '-', 'Hallo Welt!'));

// var_dump(preg_replace('/[^a-z]/', '-', 'Hallo Welt!'));

// var_dump(preg_replace('/^.+\@/', '', 'asdfljkha@gmail.com'));

// var_dump(preg_replace('/^(.+)\@(.+)$/', '$2@$1', 'asdfljkha@gmail.com'));

$search = 'Hallo Welt %';
var_dump(preg_replace("/[^A-Za-z0-9\ \.öäüßÖÄÜ,]/", '', $search));
