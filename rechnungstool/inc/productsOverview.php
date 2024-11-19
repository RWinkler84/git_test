<?php

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$fetchedproductsData = $stmt->get_result();
$productsData = $fetchedproductsData->fetch_all(MYSQLI_ASSOC);


$placeholders = [
    'logdata' => print_r($productsData, true),
    'tableContent' => getTableContent($productsData),
    'totalCount' => getDataTotalCount($productsData)
];

$template = file_get_contents(getPath('productsOverviewHTML'));

$productsOverviewHTML = templateEngine($template, $placeholders);

echo $productsOverviewHTML;



function getTableContent($productsData)
{
    $tableBody = "";

    $tableHead = <<<TABLEHEAD
        <table id="invoiceOverviewTable">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th>Produktname</th>
                    <th>Netto-Preis</th>
                    <th>Umsatzsteuer-satz</th>
                    <th>Beschreibung</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    TABLEHEAD;

    foreach ($productsData as $key => $data) {

        foreach ($data as $key => $value){
            $data[$key] = $value != '' ? $value : '-'; 
        }

        $tableRow = <<<TABLEROW
                <tr>
                    <td id>{$data['id']}</td>
                    <td style="padding-right: 1em;">{$data['productTitle']}</td>
                    <td class="multiline" style="padding-right: 1em;">{$data['productPrice']} €</td>
                    <td style="padding-right: 1em;">{$data['taxRate']}%</td>
                    <td style="padding-right: 1em;">{$data['productDescription']}</td>
                    <td style="cursor: pointer" onclick="editProduct(this)">&#9997;</td>
                    <td style="cursor: pointer" onclick="optInProductDeletion(this)">&#x1F5D1;</td>
                </tr>
        TABLEROW;

        $tableBody .= $tableRow;
    }

    $tableEnd = "</tbody></table>";

    return $tableHead . $tableBody . $tableEnd;
}

function getDataTotalCount($productsData){

    return count($productsData) . ' Datenssätze ingesamt';
}