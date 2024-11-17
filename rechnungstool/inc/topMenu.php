<?php

$currentPage = $_GET['a'] ?? 'invoiceForm';
$placeholders = [];
$sites = [
    'invoiceForm',
    'invoiceOverview',
    'costumerOverview',
    'productOverview',
    'analysis',
];

$placeholders[] = getTopMenuEntryStyle($currentPage, $sites, $placeholders);
$template = file_get_contents(getPath('topMenuHTML'));
$topMenuHTML = templateEngine($template, $placeholders);

function getTopMenuEntryStyle($currentPage, $sites)
{
    global $placeholders;

    foreach ($sites as $key) {

        $key == $currentPage ?
            $placeholders[$key] = 'scaled' : $placeholders[$key] = 'scalable';
    }
}

echo $topMenuHTML;
