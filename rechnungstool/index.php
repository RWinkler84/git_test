<?php 
include 'src/paths.php';
include getPath('templateEngine');

include_once getPath('initialData');

include_once getPath('headerHTML');

include_once getPath('topMenuHTML');

//Beginn des Seiteninhaltes

if (!isset($_GET['a'])){
    $calledSite = 'invoiceFormHTML';

} else {
    $calledSite = $_GET['a'];
} 

include_once getPath($calledSite);

include_once getPath('footerHTML');