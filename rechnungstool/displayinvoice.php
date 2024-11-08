<?php

require 'db.php';

$stmt = $conn->prepare("SELECT * FROM invoices WHERE id=?");
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$fetchedInvoiceData = $stmt->get_result();
$invoiceData = $fetchedInvoiceData->fetch_all(MYSQLI_ASSOC);


$placeholders = [
    'invoiceId' => $invoiceData[0]['id'],
    'invoiceDate' => processDate($invoiceData[0]['date']),
    'fullfillmentDate' => getFullfillmentDate($invoiceData[0]['fullfillmentDateStart'], $invoiceData[0]['fullfillmentDateEnd']),
    'selfName' => $invoiceData[0]['selfName'],
    'selfAddress' => $invoiceData[0]['selfAddress'],
    'selfTaxId' => $invoiceData[0]['selfTaxId'],
    'selfSalesTaxId' => $invoiceData[0]['selfSalesTaxId'],
    'selfBankAccountNumber' => $invoiceData[0]['selfBankAccountNumber'],
    'selfIBAN' => $invoiceData[0]['selfIBAN'],
    'selfBIC' => $invoiceData[0]['selfBIC'],
    'selfBankName' => $invoiceData[0]['selfBankName'],
    'selfMail' => $invoiceData[0]['selfMail'],
    'selfPhoneNumber' => $invoiceData[0]['selfPhoneNumber'],
    'costumerName' => $invoiceData[0]['costumerName'],
    'costumerAddress' => $invoiceData[0]['costumerAddress'],
    'costumerTaxId' => $invoiceData[0]['costumerTaxId'],
    'costumerSalesTaxId' => $invoiceData[0]['costumerSalesTaxId'],
    'tablehead' => getProductsTableHead($invoiceData),
    'products0' => getProducts($invoiceData[0]['products0']),
    'products7' => getProducts($invoiceData[0]['products7']),
    'products19' => getProducts($invoiceData[0]['products19']),
    'paymentTerms' => getPaymentDate($invoiceData[0]['paymentTerms'], $invoiceData[0]['date']),
    'smallBusinessTax' => smallBusinessTax($invoiceData[0]['smallBusinessTax']),
    'reverseCharge' => reverseCharge($invoiceData[0]['reverseCharge']),
    'invoiceComment' => getInvoiceComment($invoiceData[0]['invoiceComment']),
    'totalAmountBlock' => getTotalAmountBlock($invoiceData)
];

$template = file_get_contents('html_templates/invoice.html');
$invoiceHTML = templateEngine($template, $placeholders);

function processDate($dateString)
{
    $invoiceDate = strtotime($dateString);
    return date('d.m.Y', $invoiceDate);
}


function getFullfillmentDate($startDate, $endDate){

    if (!empty($endDate)){
        $result = "<span>Leistungszeitraum:</span><span class='bold' style='text-wrap: nowrap;'>" . processDate($startDate) . " - " . processDate($endDate) . "</span>";
    } else {
        $result = "<span>Leistungsdatum:</span><span class='bold'>" . processDate($startDate) . "</span>";
    }

    return $result;

}


function getPaymentDate($terms, $dateString)
{
    global $placeholder;

    if ($terms == 0) {
        $result = '';
    } else {
        $invoiceDate = strtotime($dateString);
        $paymentDate = strtotime('+' . $terms . ' days', $invoiceDate);
        $result = "<span>Zahlungsziel:</span><span class='bold'>" . date('d.m.Y', $paymentDate) . "</span>";
    }

    return $result;
}


function getProductsTableHead($invoiceData){

    if ($invoiceData[0]['smallBusinessTax'] || $invoiceData[0]['reverseCharge']){
        $tableHeadHTML = '
                    <th style="text-align: left; width: 40%">Beschreibung</th>
                    <th>Einzelpreis netto</th>
                    <th>MwSt</th>
                    <th>Menge</th>
                    <th style="text-align: right;">Betrag netto</th>
        ';
    } else {
        $tableHeadHTML = '
                    <th style="text-align: left; width: 40%">Beschreibung</th>
                    <th>Einzelpreis netto</th>
                    <th>MwSt</th>
                    <th>Menge</th>
                    <th>Betrag netto</th>
                    <th style="text-align: right;">Betrag brutto</th>
        ';
    }
    return $tableHeadHTML;
}


function getProducts($productJson)
{
    global $invoiceData;
    $productsArray = [];
    $productsArray = json_decode($productJson, true);
    $productsHTML = "";

    if (isset($productsArray[0])) {
        foreach ($productsArray as $product) {
            $placeholders = [
                'productTitle' => $product['productTitle'],
                'productPrice' => $product['productPrice'],
                'taxRate' => $product['taxRate'],
                'productAmount' => $product['amount'],
                'productTotalNetPrice' => $product['productTotalNetPrice'],
                'productTotalGrossPrice' => $product['productTotalGrossPrice'],
                'productDescription' => $product['productDescription']
            ];

            $template = file_get_contents(
                $invoiceData[0]['smallBusinessTax'] == 1 || $invoiceData[0]['reverseCharge'] == 1 ?
                'html_templates/productsBlockUntaxed.html' : 'html_templates/productsBlockTaxed.html');
            $productsHTML .= templateEngine($template, $placeholders);
        }
    }

    return $productsHTML;
}


function getTotalAmountBlock($invoiceData)
{
    $placeholders = [
        'totalTax7' => $invoiceData[0]['totalTax7'],
        'totalTax19' => $invoiceData[0]['totalTax19'],
        'invoiceNetAmount' => $invoiceData[0]['invoiceNetAmount'],
        'invoiceGrossAmount' => $invoiceData[0]['invoiceGrossAmount'],
    ];

    $template = file_get_contents(
        $invoiceData[0]['smallBusinessTax'] == 1 || $invoiceData[0]['reverseCharge'] == 1 ?
        'html_templates/totalAmountBlockUntaxed.html' : 'html_templates/totalAmountBlockTaxed.html'
    );

    return templateEngine($template, $placeholders);
}


function smallBusinessTax($status)
{
    return $status == 1 ? 'Kein Umsatzsteuerausweis aufgrund Anwendung der Klein­unternehmer­regelung gemäß § 19 UStG.' : '';
}


function reverseCharge($status)
{
    return $status == 1 ? 'Der Rechnungsausweis erfolgt ohne Umsatzsteuer, da vorliegend der Wechsel der Steuerschuldnerschaft (Reverse-Charge-Verfahren) greift. Die Umsatzsteuer ist vom Leistungsempfänger anzumelden und abzuführen.' : '';
}


function getInvoiceComment($comment)
{
    return !empty($comment) ? "<b>Anmerkungen:</b><br>" . $comment : '';
}


function templateEngine($template, $placeholders)
{
    foreach ($placeholders as $placeholder => $value) {
        $placeholder = '{' . $placeholder . '}';
        $template = str_replace($placeholder, $value, $template);
    }

    return $template;
}



echo $invoiceHTML;
