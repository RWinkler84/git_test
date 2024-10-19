<?php

session_start();

$_SESSION['name'] = 'Max Mustermann';

var_dump($_SESSION);

var_dump(session_save_path());