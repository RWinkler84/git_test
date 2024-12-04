<?php


$invoiceData = fetchAllInvoices();
$placeholders = [
    'tableContent' => getTableContent($invoiceData),
    'totalCount' => getDataTotalCount($invoiceData)
];

$template = file_get_contents(getPath('invoiceOverviewHTML'));

$invoiceOverviewHTML = templateEngine($template, $placeholders);

echo $invoiceOverviewHTML;



function getTableContent($invoiceData)
{
    $tableBody = "";

    $tableHead = <<<TABLEHEAD
        <table id="invoiceOverviewTable">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Rechnungs-nummer</th>
                    <th>Kunde</th>
                    <th>Rechnungsbetrag</th>
                    <th>bezahlt</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    TABLEHEAD;

    foreach ($invoiceData as $key => $data) {

        $invoiceViewPath = "index.php?a=invoiceView&id=" . $invoiceData[$key]['id'];
        $invoiceDate = processDate($data['date']);
        $invoiceTotalAmount = getInvoiceTotalAmount($data);
        $invoicePayed = getPaymentStatus($data['paymentStatus'], $data['receivedPayments']);


        $tableRow = <<<TABLEROW
                <tr>
                    <td>{$invoiceDate}</td>
                    <td id style="width: 10%">{$data['id']}</td>
                    <td>{$data['costumerName']}</td>
                    <td>{$invoiceTotalAmount} €</td>
                    <td onclick="getReceivedPayments(this)">{$invoicePayed}</td>
                    <td><a href="{$invoiceViewPath}" target="_blank">&#128269</a></td>
                </tr>
        TABLEROW;

        $tableBody .= $tableRow;
    }

    $tableEnd = "</tbody></table>";

    return $tableHead . $tableBody . $tableEnd;
}


function processDate($dateString)
{
    $invoiceDate = strtotime($dateString);
    return date('d.m.Y', $invoiceDate);
}


function getInvoiceTotalAmount($data)
{
    return $data['smallBusinessTax'] == 1 || $data['reverseCharge'] == 1 ?
        $data['invoiceNetAmount'] : $data['invoiceGrossAmount'];
}


function getPaymentStatus($status, $receivedPayments)
{
    $receivedPayments = htmlspecialchars_decode($receivedPayments);
    $receivedPayments = json_decode($receivedPayments, true);
    
    if ($status == '0' && !isset($receivedPayments[0]['payment'])){
        return "<span style='color: red; cursor: pointer;' title='offen'>&#10008</span>";
    } else if ($status == '1'){
        return "<span style='color: green; cursor: pointer;' title='bezahlt'>&#10004;</span>";
    } else if ($status == '0' && isset($receivedPayments[0]['payment'])){
        return "<span style='color: var(--status-pending); cursor: pointer;' title='Anzahlung erhalten'>&#10004;</span>";
    }     
}

function getDataTotalCount($invoiceData){

    return count($invoiceData) . ' Datenssätze ingesamt';
}

//invoiceGrossAmount muss durch getInvoiceAmoun-Funktion ersetzt werden, damit keine Brutto-Preise
//bei Netto-Rechnungen angezeigt werden