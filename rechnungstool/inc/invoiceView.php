<?php
// require_once 'src/paths.php';
// require_once getPath('templateEngine');
// require getPath('database');

$invoiceData = fetchInvoiceDataById($_GET['id']);


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
    'costumerTaxId' => getCostumerTaxId($invoiceData[0]['costumerTaxId']),
    'costumerSalesTaxId' => getCostumerSalesTaxId($invoiceData[0]['costumerSalesTaxId']),
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

$template = file_get_contents(getPath('invoiceLayoutHTML'));
$invoiceHTML = templateEngine($template, $placeholders);

function processDate($dateString)
{
    $invoiceDate = strtotime($dateString);
    return date('d.m.Y', $invoiceDate);
}


function getFullfillmentDate($startDate, $endDate)
{

    if (!empty($endDate)) {
        $result = "<span>Leistungszeitraum:</span><span class='bold' style='text-wrap: nowrap;'>" . processDate($startDate) . " - " . processDate($endDate) . "</span>";
    } else {
        $result = "<span>Leistungsdatum:</span><span class='bold'>" . processDate($startDate) . "</span>";
    }

    return $result;
}


function getCostumerTaxId($taxId)
{

    return empty($taxId) ? "" : "<span>St-Nr: </span><span class='bold'>" . $taxId . '</span>';
}


function getCostumerSalesTaxId($salesTaxId)
{

    return empty($salesTaxId) ? "" : "<span>USt-IdNr: </span><span class='bold'>" . $salesTaxId . '</span>';
}


function getPaymentDate($terms, $dateString)
{
    // global $placeholder;

    if ($terms == 0) {
        $result = '';
    } else {
        $invoiceDate = strtotime($dateString);
        $paymentDate = strtotime('+' . $terms . ' days', $invoiceDate);
        $result = "<span>Zahlungsziel:</span><span class='bold'>" . date('d.m.Y', $paymentDate) . "</span>";
    }

    return $result;
}


function getProductsTableHead($invoiceData)
{

    if ($invoiceData[0]['smallBusinessTax'] || $invoiceData[0]['reverseCharge']) {
        $tableHeadHTML = '
                    <th style="text-align: left; width: 40%">Beschreibung</th>
                    <th>Einzelpreis</th>
                    <th>Menge</th>
                    <th style="text-align: right;">Betrag</th>
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
            logger($product);
            $placeholders = [
                'productTitle' => $product['productTitle'],
                'productPrice' => number_format($product['productPrice'], 2, "."),
                'taxRate' => $product['taxRate'],
                'productAmount' => $product['amount'],
                'productTotalNetPrice' => number_format($product['productTotalNetPrice'], 2, "."),
                'productTotalGrossPrice' => number_format($product['productTotalGrossPrice'], 2, "."),
                'productDescription' => $product['productDescription']
            ];

            $template = 
                $invoiceData[0]['smallBusinessTax'] == 1 || $invoiceData[0]['reverseCharge'] == 1 
                ?
                <<<productsBlockUntaxed
                <tr>
                    <td style="text-align: left;"><span class="bold">{productTitle}</span><br>{productDescription}</td>
                    <td>{productPrice} €</td>
                    <td>{productAmount}</td>
                    <td style="text-align: right;">{productTotalNetPrice} €</td>
                </tr>
                productsBlockUntaxed
                :
                <<<productsBlockTaxed
                <tr>
                    <td style="text-align: left;"><span class="bold">{productTitle}</span><br>{productDescription}</td>
                    <td>{productPrice} €</td>
                    <td>{taxRate}%</td>
                    <td>{productAmount}</td>
                    <td>{productTotalNetPrice} €</td>
                    <td style="text-align: right;">{productTotalGrossPrice} €</td>
                </tr>
                productsBlockTaxed
                ;
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

    $template =
        $invoiceData[0]['smallBusinessTax'] == 1 || $invoiceData[0]['reverseCharge'] == 1 
        ?
        <<<totalAmountBlockUntaxed
        <div class="flex spaceBetween" id="totalAmountBlock">
            <div></div>
            <div style="width: 40%">
                <div class="flex spaceBetween"><span>gesamt:</span><span>{invoiceNetAmount} €</span></div>
                <div class="flex" style="justify-content: right;">
                    <h3>zu bezahlen: {invoiceNetAmount} €</h3>
                </div>
            </div>
        </div>
        totalAmountBlockUntaxed
        :
        <<<totalAmountBlockTaxed
        <div class="flex spaceBetween" id="totalAmountBlock">
            <div></div>
            <div style="width: 40%">
                <div class="flex spaceBetween"><span>gesamt netto:</span><span>{invoiceNetAmount} €</span></div>
                <div class="flex spaceBetween"><span>USt. 7%:</span><span>{totalTax7} €</span></div>
                <div class="flex spaceBetween"><span>USt. 19%:</span><span>{totalTax19} €</span></div>
                <div class="flex spaceBetween"><span>gesamt brutto:</span><span>{invoiceGrossAmount} €</span></div>
                <div class="flex" style="justify-content: right;">
                    <h3>zu bezahlen: {invoiceGrossAmount} €</h3>
                </div>
            </div>
        </div>
        totalAmountBlockTaxed;

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


echo $invoiceHTML;
