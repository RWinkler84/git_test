<?php
if (!function_exists('getPath')) {
    require 'paths.php';
};
require getPath('database');
global $conn;

$result = [];

if (isset($_POST['action'])) {

    switch ($_POST['action']) {

        case 'addProductSelect':
            $result = fetchAllProducts(true);
            echo json_encode($result);
            break;

        case 'getCostumer':
            fetchAllCostumers(true);
            break;

        case 'createProduct':
            createProduct();
            break;

        case 'updateProduct':
            $result = updateProduct();
            echo $result;
            break;

        case 'deleteProduct':
            $result = deleteProduct();
            break;

        case 'createCostumer':
            createCostumer();
            break;

        case 'updateCostumer':
            updateCostumer();
            break;

        case 'deleteCostumer':
            deleteCostumer();
            break;

        case 'createInvoice':
            $result = processInvoiceData();
            echo json_encode($result);
            break;

        case 'getProductDataToEdit':
            $result = fetchProductById();
            echo json_encode($result);
            break;

        case 'getCostumerDataToEdit':
            $result = fetchCostumerById();
            echo json_encode($result);
            break;

    }
}


function dataQueryPrepStmt($sqlQuery, $paramType, $param)
{
    global $conn;

    try {
    $stmt = $conn->prepare($sqlQuery);
    
    if (!empty($param)) $stmt->bind_param($paramType, ...$param);
    
    $stmt->execute();
     
    } catch (Exception $e){
        http_response_code(500);
        return json_encode(['errorMessage' => 'Es gab da ein Problem...']);
    }

    $fetchedData = $stmt->get_result();

    return $fetchedData;
}


function fetchAllCostumers(bool $sorted)
{
    $sqlQuery = 'SELECT * FROM costumer';
    $paramType = '';
    $param = [];
    $fetchCostumers = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $costumers = $fetchCostumers->fetch_all(MYSQLI_ASSOC);

    if ($sorted) {
        usort($costumers, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
    }

    return $costumers;
}

function fetchAllProducts(bool $sorted)
{
    $sqlQuery = 'SELECT * FROM products';
    $paramType = '';
    $param = [];
    $fetchProducts = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $products = $fetchProducts->fetch_all(MYSQLI_ASSOC);

    if ($sorted) {
        usort($products, function ($a, $b) {
            return strcmp($b['lastEdited'], $a['lastEdited']);
        });
    }

    return $products;
}

function fetchAllInvoices()
{
    $sqlQuery = 'SELECT * FROM invoices';
    $paramType = '';
    $param = [];

    $fetchedInvoiceData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $invoiceData = $fetchedInvoiceData->fetch_all(MYSQLI_ASSOC);
    Logger($invoiceData);
    usort($invoiceData, function ($a, $b){
        return $b['id'] - $a['id'];
    });

    return $invoiceData;
}

function fetchCostumerById()
{
    $sqlQuery = "SELECT * FROM costumer WHERE id=?";
    $param = !empty($_POST['invoiceData']) ? [$_POST['invoiceData']['costumerSelect']] : [$_POST['id']];
    $paramType = "i";
    $fetchCostumer = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $fetchCostumer->fetch_all(MYSQLI_ASSOC);
}

function fetchProductById()
{
    $sqlQuery = "SELECT * FROM products WHERE id=?";
    $paramType = 'i';
    $param = [$_POST['id']];
    $fetchProduct = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $result = $fetchProduct->fetch_all(MYSQLI_ASSOC);

    return $result;
}


function fetchSelfFromDB()
{

    $sqlQuery = "SELECT * FROM businessInfo WHERE id=?";
    $fetchSelf = dataQueryPrepStmt($sqlQuery, "i", [1]);

    return $fetchSelf->fetch_all(MYSQLI_ASSOC);
}


// wertet aus, welche Produkte im Invoice-Form ausgewählt wurden und holt die notwendigen Daten (Preis, Beschreibung) aus der Datenbank
function fetchSelectedProductData()
{
    $allSelectedProducts = array_filter($_POST['invoiceData'], 'filterForSelectedProducts', ARRAY_FILTER_USE_KEY);

    for ($i = 0; $i < count($allSelectedProducts); $i++) {
        $sqlQuery = "SELECT * FROM products WHERE id=?";
        $paramType = 'i';
        $param = [$allSelectedProducts['productSelect_' . $i]];

        $productsData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
        $productsData = $productsData->fetch_all(MYSQLI_ASSOC);

        $selectedProductsData[] = $productsData[0];
        $selectedProductsData[$i]['amount'] = $_POST['invoiceData']['productAmount_' . $i];
    }

    return $selectedProductsData;
}

//Callback-Funktion für fetchSelectedProductData(), die das $_POST nach Keys durchsucht, die productSelect enthalten
function filterForSelectedProducts($key)
{
    return str_contains($key, 'productSelect');
}


//Funktionen zur Verwaltung von Produkten
function createProduct()
{
    $sqlQuery = "INSERT INTO products (productTitle, productPrice, taxRate, productDescription) VALUES (?,?,?,?)";
    $paramType = "ssss";
    $param = [$_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}

function updateProduct()
{
    $sqlQuery = "UPDATE products SET productTitle=?, productPrice=?, taxRate=?, productDescription=? WHERE id=?";
    $paramType = "sdssi";
    $param = [$_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription'], $_POST['productId']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);
 
    return $result;
}

function deleteProduct()
{
    $sqlQuery = "DELETE FROM products WHERE id=?";
    $paramType = "i";
    $param = [$_POST['id']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


function createCostumer()
{
    $sqlQuery = "INSERT INTO costumer (name, address, taxId, salesTaxid) VALUES (?,?,?,?)";
    $paramType = 'ssss';
    $param = [$_POST['name'], $_POST['address'], $_POST['taxId'], $_POST['salesTaxId']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


function updateCostumer()
{
    $sqlQuery = "UPDATE costumer SET name=?, address=?, taxId=?, salesTaxid=? WHERE id=?";
    $paramType = 'ssssi';
    $param = [$_POST['name'], $_POST['address'], $_POST['taxId'], $_POST['salesTaxId'], $_POST['id']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


function deleteCostumer()
{
    $sqlQuery = "DELETE FROM costumer WHERE id=?";
    $paramType = "i";
    $param = [$_POST['id']];
    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


//füllt die invoice-Tabelle mit Daten
function processInvoiceData()
{
    $selectedProductsData = fetchSelectedProductData(); //holt die Daten der ausgewählten Produkte
    $costumer = fetchCostumerById();
    $self = fetchSelfFromDB(); //self sind die Daten des eigenen Unternehmens
    $products0 = [];
    $products7 = [];
    $products19 = [];
    $totalTax7 = 0;
    $totalTax19 = 0;
    $allProductsTotalPrice0 = 0;
    $allProductsTotalPrice7 = 0;
    $allProductsTotalPrice19 = 0;
    $invoiceNetAmount = 0;
    $invoiceGrossAmunt = 0;

    //erzeugt Variablen aus den Key-Value-Pairs mit dem Präfix self_ und costumer_
    extract($self[0], EXTR_PREFIX_ALL, "self");
    extract($costumer[0], EXTR_PREFIX_ALL, "costumer");

    //checkt, ob beim Kunden eine UStId gesetzt ist, wenn Reverse Charge ausgewählt wurde
    if (isset($_POST['invoiceData']['reverseCharge']) && empty($costumer_salesTaxId)) {
        $result = 'salesTaxId not set';
        return $result;
    }

    //erzeugt Arrays mit den gewählten Produkten je nach Steuersatz
    foreach ($selectedProductsData as $product) {
        switch ($product['taxRate']) {
            case '0':
                $products0[] = $product;
                break;

            case '7':
                $products7[] = $product;
                break;

            case '19':
                $products19[] = $product;
                break;
        }
    }

    //berechnet die Netto/Brutto-Gesamtpreis und Steueranteile

    //0 Prozent
    if (isset($products0[0])) {
        for ($i = 0; $i < count($products0); $i++) {
            $singleProductTotalPrice0 = round($products0[$i]['productPrice'] * $products0[$i]['amount'], 2);
            $allProductsTotalPrice0 += $singleProductTotalPrice0;
            $products0[$i]['productTotalPrice'] = $singleProductTotalPrice0;
        }
    }

    //7 Prozent
    if (isset($products7[0])) {
        for ($i = 0; $i < count($products7); $i++) {
            $singleProductTotalPrice7 = round($products7[$i]['productPrice'] * $products7[$i]['amount'], 2); //Netto-Preis aller Exemplare eines Produkts
            $allProductsTotalPrice7 += $singleProductTotalPrice7; //Netto-Preis aller Produkte
            $totalTax7 = round($allProductsTotalPrice7 * 0.07, 2);
            $products7[$i]['productTotalNetPrice'] = $singleProductTotalPrice7;
            $products7[$i]['productTotalGrossPrice'] = round($singleProductTotalPrice7 * 1.07, 2);
        }
    }

    //19 Prozent
    if (isset($products19[0])) {
        for ($i = 0; $i < count($products19); $i++) {
            $singleProductTotalPrice19 = round($products19[$i]['productPrice'] * $products19[$i]['amount'], 2); //Netto-Preis aller Exemplare eines Produkts
            $allProductsTotalPrice19 += $singleProductTotalPrice19; //Netto-Preis aller Produkte
            $totalTax19 = round($allProductsTotalPrice19 * 0.19, 2);
            $products19[$i]['productTotalNetPrice'] = $singleProductTotalPrice19;
            $products19[$i]['productTotalGrossPrice'] = round($singleProductTotalPrice19 * 1.19, 2);
        }
    }

    $invoiceNetAmount = $allProductsTotalPrice0 + $allProductsTotalPrice7 + $allProductsTotalPrice19;
    $invoiceGrossAmunt = isset($_POST['invoiceData']['smallBusinessTax']) || isset($_POST['invoiceData']['reverseCharge']) ?
        0 : $invoiceNetAmount + $totalTax7 + $totalTax19;

    //bereitet Daten für Datenbank-Query vor

    $products0 = json_encode($products0);
    $products7 = json_encode($products7);
    $products19 = json_encode($products19);

    $paymentTerms = $_POST['invoiceData']['paymentTerms'];
    $smallBusinessTax = $_POST['invoiceData']['smallBusinessTax'] ?? 0;
    $reverseCharge = $_POST['invoiceData']['reverseCharge'] ?? 0;
    $invoiceComment = $_POST['invoiceData']['invoiceComment'];
    $fullfillmentDateStart = $_POST['invoiceData']['startDate'];
    $fullfillmentDateEnd = $_POST['invoiceData']['endDate'];
    $paymentStatus = 0;

    $sqlQuery = "INSERT INTO invoices (selfName, selfAddress, selfTaxId, selfSalesTaxId, selfBankAccountNumber, selfIBAN, selfBIC, selfBankName, selfMail, selfPhoneNumber,
                 costumerName, costumerAddress, costumerTaxId, costumerSalesTaxId, products0, products7, products19, totalTax7, totalTax19, invoiceNetAmount, invoiceGrossAmount,
                 paymentTerms, smallBusinessTax, reverseCharge, invoiceComment, fullfillmentDateStart, FullfillmentDateEnd, paymentStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = 'sssssssssssssssssddddiiisssi';
    $param = [
        $self_name,
        $self_address,
        $self_taxId,
        $self_salesTaxId,
        $self_bankAccountNumber,
        $self_IBAN,
        $self_BIC,
        $self_bankName,
        $self_mail,
        $self_phoneNumber,
        $costumer_name,
        $costumer_address,
        $costumer_taxId,
        $costumer_salesTaxId,
        $products0,
        $products7,
        $products19,
        $totalTax7,
        $totalTax19,
        $invoiceNetAmount,
        $invoiceGrossAmunt,
        $paymentTerms,
        $smallBusinessTax,
        $reverseCharge,
        $invoiceComment,
        $fullfillmentDateStart,
        $fullfillmentDateEnd,
        $paymentStatus
    ];

    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


//simple Error-Logging

function logger($valueToLog)
{
    error_log('file: ' . __FILE__);
    error_log('Logger: ' . print_r($valueToLog, true));
}
