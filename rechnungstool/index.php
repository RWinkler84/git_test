<?php 

session_start();

include 'src/paths.php';
include getPath('templateEngine');

include_once getPath('initialData');

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