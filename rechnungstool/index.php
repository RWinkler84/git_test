<?php 

session_start();

require_once 'core/paths.php';
include getPath('templateEngine');

require getPath('database');

require getPath('ajax');

include_once getPath('headerHTML');

include_once getPath('topMenu');

//Beginn des Seiteninhaltes

if (!isset($_GET['a'])){
    $calledPage = 'invoiceFormHTML';

} else {
    $calledPage = $_GET['a'];
} 

include_once getPath($calledPage);

include_once getPath('footerHTML');