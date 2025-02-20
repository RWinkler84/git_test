<?php 
$path = [
    'database' => 'core/db.php',
    'dataqueries' => 'core/dataqueries.php',
    'templateEngine' => 'core/templateEngine.php',

    // HTML Template für das Rechnungslayout
    'invoiceLayoutHTML' => 'html_templates/invoice/invoiceLayout.html',

    // HTML Templates für das Seitenlayout
    'footerHTML' => 'html_templates/footer.html',
    'headerHTML' => 'html_templates/header.html',
    'topMenuHTML'  => 'html_templates/topMenu.html',
    'invoiceFormHTML' => 'html_templates/invoiceForm.html',
    'invoiceOverviewHTML' => 'html_templates/invoiceOverview.html',
    'costumerOverviewHTML' => 'html_templates/costumerOverview.html',
    'productsOverviewHTML' => 'html_templates/productsOverview.html',


    // einzelne Seiten und Seitenelemente
    'header' => 'inc/header.php',
    'topMenu' => 'inc/topMenu.php',
    'invoiceView' => 'inc/invoiceView.php',
    'invoiceOverview' => 'inc/invoiceOverview.php',
    'costumerOverview' => 'inc/costumerOverview.php',
    'productsOverview' => 'inc/productsOverview.php',
    'invoiceForm' => 'inc/invoiceform.php',
    'index' => 'index.php',
    // nicht existierende oder externe Seite aufgerufen
    'notFoundHTML' => 'html_templates/404.html'
];

function getPath($requestedSite){

    global $path;
    $requestedPath = !empty($path[$requestedSite]) ? dirname(__DIR__) . '/' . $path[$requestedSite] : dirname(__DIR__) . '/' . $path['notFoundHTML'];
   
    return $requestedPath;
}