<?php
//Speichert die zuletzt besuchte Seite in der Session
array_unshift($_SESSION['pageHistory'], ($_GET['a'] ?? 'invoiceForm'));
array_pop($_SESSION['pageHistory']);

$currentPage = $_GET['a'] ?? 'invoiceForm';
$placeholders = [];
$sites = [
    'invoiceForm',
    'invoiceOverview',
    'costumerOverview',
    'productsOverview',
    'analysis',
];

$placeholders[] = getTopMenuEntryStyle($currentPage, $sites, $placeholders);
$template = file_get_contents(getPath('topMenuHTML'));
$topMenuHTML = templateEngine($template, $placeholders);

function getTopMenuEntryStyle($currentPage, $sites)
{
    global $placeholders;

    $priviousPage = $_SESSION['pageHistory'][1];

    foreach ($sites as $key) {

        $key == $currentPage ?
            $placeholders[$key] = 'scaled' : $placeholders[$key] = 'scalable';
        $key == $priviousPage && $key != $currentPage ?
            $placeholders[$key] .= ' scaledown' : false;    
    }
}

echo $topMenuHTML;
