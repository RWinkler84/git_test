<?php
$placeholders = [];
$pageTitle =  'Rechnung erstellen';
$template = file_get_contents(getPath('headerHTML'));

if (isset($_GET['a'])) {
    switch ($_GET['a']) {
        case 'invoiceForm':
            $pageTitle = 'Rechnung erstellen';
            break;

        case 'invoiceOverview':
            $pageTitle = 'Rechnungsübersicht';
            break;

        case 'productsOverview':
            $pageTitle = 'Produktübersicht';
            break;

        case 'costumerOverview':
            $pageTitle = 'Kundenübersicht';
            break;

        case 'invoiceView':
            $pageTitle = 'Rechnung ' . $_GET['id'];
            break;
    }
} 

$placeholders = [
    'pageTitle' => $pageTitle
];

echo templateEngine($template, $placeholders);
