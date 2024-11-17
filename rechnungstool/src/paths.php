<?php 
$path = [
    'database' => 'src/db.php',
    'initialData' => 'core/initialData.php',
    'ajax' => 'core/ajax.php',
    'templateEngine' => 'core/templateEngine.php',

    // HTML Template für das Rechnungslayout
    'invoiceLayoutHTML' => 'html_templates/invoice/invoiceLayout.html',

    // HTML Templates für das Seitenlayout
    'footerHTML' => 'html_templates/footer.html',
    'headerHTML' => 'html_templates/header.html',
    'topMenuHTML'  => 'html_templates/topMenu.html',
    'invoiceFormHTML' => 'html_templates/invoiceForm.html',
    'invoiceOverviewHTML' => 'html_templates/invoiceOverview.html',

    // einzelne Seiten und Seitenelemente
    'topMenu' => 'inc/topMenu.php',
    'invoiceView' => 'inc/invoiceView.php',
    'invoiceOverview' => 'inc/invoiceOverview.php',
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