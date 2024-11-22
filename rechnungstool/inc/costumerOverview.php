<?php

$costumerData = fetchAllCostumers(false);
$placeholders = [
    'logdata' => print_r($costumerData, true),
    'tableContent' => getTableContent($costumerData),
    'totalCount' => getDataTotalCount($costumerData)
];

$template = file_get_contents(getPath('costumerOverviewHTML'));

$costumerOverviewHTML = templateEngine($template, $placeholders);

echo $costumerOverviewHTML;



function getTableContent($costumerData)
{
    $tableBody = "";

    $tableHead = <<<TABLEHEAD
        <table id="invoiceOverviewTable">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th>Kunde</th>
                    <th>Adresse</th>
                    <th>Steuer-Id</th>
                    <th>Umsatzsteuer-Id</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    TABLEHEAD;

    foreach ($costumerData as $key => $data) {

        foreach ($data as $key => $value){
            $data[$key] = $value != '' ? $value : '-'; 
        }

        $tableRow = <<<TABLEROW
                <tr>
                    <td id>{$data['id']}</td>
                    <td style="padding-right: 1em;">{$data['name']}</td>
                    <td class="multiline" style="padding-right: 1em;">{$data['address']}</td>
                    <td style="padding-right: 1em;">{$data['taxId']}</td>
                    <td style="padding-right: 1em;">{$data['salesTaxId']}</td>
                    <td style="padding-right: 0.5em; cursor: pointer" onclick="editCostumer(this)">&#9997;</a></td>
                     <td style="cursor: pointer" onclick="optInCostumerDeletion(this)">&#x1F5D1;</td>
                </tr>
        TABLEROW;

        $tableBody .= $tableRow;
    }

    $tableEnd = "</tbody></table>";

    return $tableHead . $tableBody . $tableEnd;
}

function getDataTotalCount($costumerData){

    return count($costumerData) . ' Datenssätze ingesamt';
}