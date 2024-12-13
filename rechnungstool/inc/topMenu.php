<?php
//Speichert die zuletzt besuchte Seite in der Session

array_unshift($_SESSION['pageHistory'], ($_GET['a'] ?? 'invoiceForm'));
if (count($_SESSION['pageHistory']) > 2) {
    array_pop($_SESSION['pageHistory']);
}


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

    $priviousPage = isset($_SESSION['pageHistory'][1]) ? $_SESSION['pageHistory'][1] : 'false';

    foreach ($sites as $key) {

        $key == $currentPage ?
            $placeholders[$key] = 'scaled' : $placeholders[$key] = 'scalable';
        $key == $priviousPage && $priviousPage != 'false' && $key != $currentPage ?
            $placeholders[$key] = ' scaledown' : false;

    }

    if ($currentPage == 'invoiceView' || ($currentPage == 'invoiceView' && $priviousPage == 'invoiceView')) {
        $placeholders['invoiceOverview'] = ' scaled';
    }

    if ($priviousPage == 'invoiceView' && $currentPage != 'invoiceOverview' && $currentPage != 'invoiceView'){
        $placeholders['invoiceOverview'] = ' scaledown';
    }
}

echo $topMenuHTML;
