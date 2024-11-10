<?php 
$path = [
    'database' => 'src/db.php',
    'initialData' => 'core/initialData.php',
    'ajax' => 'core/ajax.php',
    'templateEngine' => 'core/templateEngine.php',
    
    // HTML Templates für das Rechnungslayout
    'invoiceLayout' => 'html_templates/invoice/invoiceLayout.html',
    'productsBlockTaxed' => 'html_templates/invoice/productsBlockTaxed.html',
    'productsBlockUntaxed' => 'html_templates/invoice/productsBlockUntaxed.html',
    'totalAmountBlockTaxed' => 'html_templates/invoice/totalAmountBlockTaxed.html',
    'totalAmountBlockUntaxed' => 'html_templates/invoice/totalAmountBlockUntaxed.html',

    // HTML Templates für das Seitenlayout
    'footer' => 'html_templates/footer.html',
    'header' => 'html_templates/header.html',
    'topMenu'  => 'html_templates/topMenu.html',
    'invoiceForm' => 'html_templates/invoiceForm.html'
];

function path($requestedSite){
    global $path;
    $requestedPath =  dirname(__DIR__) . '/' . $path[$requestedSite];
    return $requestedPath;
}