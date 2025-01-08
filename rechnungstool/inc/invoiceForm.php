<?php

$product = fetchAllProducts(true);
$costumer = fetchAllCostumers(true);



$allCostumerOptions = "";
$allProductOptions = "";

$placeholders = [
    'costumerOptions' => getCostumerOptions($costumer, $allCostumerOptions),
    'productOptions' => getProductOptions($product, $allProductOptions)
];

$template = file_get_contents(getPath('invoiceFormHTML'));

echo templateEngine($template, $placeholders);

function getCostumerOptions($costumer, $allCostumerOptions)
{
    foreach ($costumer as $item) {

        $option = "<option name='costumerSelect' value='" . $item['id'] . "'>" . $item['name'] . "</option>";
        $allCostumerOptions .= $option;
    };

    return $allCostumerOptions;
}


function getProductOptions($product, $allProductOptions)
{
    foreach ($product as $item) {
        if (empty($item['productDescription'])) {
            $option = "<option name='productSelect' value='" . $item['id'] . "' price='" . $item['productPrice'] . "'>" . $item['productTitle'] . "  -  " . $item['productPrice'] . "€</option>";
        } else {
            $option = "<option name='productSelect' value='" . $item['id'] . "' price='" . $item['productPrice'] . "' description='" . $item['productDescription'] . "'>" . $item['productTitle'] . "  -  " . $item['productPrice'] . "€</option>";
        }
        $allProductOptions .= $option;
    };

    return $allProductOptions;
}
