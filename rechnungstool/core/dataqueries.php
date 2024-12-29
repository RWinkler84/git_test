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

        case 'createPaymentReminder':
            $result = createPaymentReminder();
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

        case 'getReceivedPayments':
            $result = fetchPaymentDataByInvoiceId($_POST['id']);
            echo json_encode($result);
            break;

        case 'createIncomingPayment':
            $result = createIncomingPayment();
            echo json_encode($result);
            break;

        case 'getPaymentReminders':
            $result = fetchPaymentRemindersById();
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
    } catch (Exception $e) {
        http_response_code(500);
        return json_encode(['errorMessage' => 'Es gab da ein Problem...' . $e]);
    }

    $fetchedData = $stmt->get_result();

    return $fetchedData;
}

function cleanedData($dataToClean)
{

    foreach ($dataToClean as $key => $value) {
        foreach ($value as $subKey => $subValue) {
            $dataToClean[$key][$subKey] = htmlspecialchars($subValue);
        }
    }

    return $dataToClean;
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
    $costumers = cleanedData($costumers);

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

    $products = cleanedData($products);

    return $products;
}

function fetchAllInvoices()
{
    $sqlQuery = 'SELECT * FROM invoices';
    $paramType = '';
    $param = [];

    $fetchedInvoiceData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $invoiceData = $fetchedInvoiceData->fetch_all(MYSQLI_ASSOC);
    usort($invoiceData, function ($a, $b) {
        return $b['id'] - $a['id'];
    });

    $invoiceData = cleanedData($invoiceData);

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


function fetchInvoiceDataById($id)
{
    $sqlQuery = "SELECT * FROM invoices WHERE id=?";
    $param = [$id];
    $paramType = 'i';

    $fetchedInvoiceData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $invoiceData = $fetchedInvoiceData->fetch_all(MYSQLI_ASSOC);

    //eliminiert htmlspecialchars auf der invoiceView
    foreach ($invoiceData[0] as $key => $value) {

        if ($key == 'products0' || $key == 'products7' || $key == 'products19') {
            $products = json_decode($value, true);

            foreach ($products as $productProperties => $value) {
                foreach ($value as $subKey => $subValue) {
                    $products[$productProperties][$subKey] = htmlspecialchars($subValue);
                }
            }

            $products = json_encode($products);
            $invoiceData[0][$key] = $products;
        }

        if ($key != 'products0' && $key != 'products7' && $key != 'products19' && $key != 'receivedPayments') {
            $invoiceData[0][$key] = htmlspecialchars($value);
        }
    }

    return $invoiceData;
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

function fetchBaseInterestRate($invoiceDueDate)
{
    $invoiceDueDate = new DateTime($invoiceDueDate);
    $invoiceDueDate = $invoiceDueDate->format('Y-m-d');
    
    $sqlQuery = 'SELECT * FROM baseInterestRate WHERE date >= ?';
    $paramType = 's';
    $param = [$invoiceDueDate];

    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $result = $result->fetch_all(MYSQLI_ASSOC);

    return $result;
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



function fetchPaymentDataByInvoiceId($id)
{
    $sqlQuery = 'SELECT receivedPayments, invoiceGrossAmount FROM invoices WHERE id=?';
    $paramType = 'i';
    $param = [$id];
    $fetchedPaymentData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $paymentData = $fetchedPaymentData->fetch_all(MYSQLI_ASSOC);

    return $paymentData;
}

function createIncomingPayment()
{
    $paymentData = fetchPaymentDataByInvoiceId($_POST['id']);
    $paymentData = $paymentData[0]['receivedPayments'];
    $paymentData = json_decode($paymentData, true);
    $paymentToAdd = [
        'payment' => [
            'date' => $_POST['paymentDate'],
            'amount' => $_POST['paymentAmount']
        ]
    ];


    $paymentData[] = $paymentToAdd;

    $paymentData = json_encode($paymentData);

    $sqlQuery = "UPDATE invoices SET receivedPayments=? WHERE id=?";
    $paramType = 'si';
    $param = [$paymentData, $_POST['id']];

    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    isInvoicePayed();

    return $result;
}


function isInvoicePayed()
{
    $receivedPayments = 0;
    $paymentData = fetchPaymentDataByInvoiceId($_POST['id']);
    $allReceivedPayments = json_decode($paymentData[0]['receivedPayments'], true);

    for ($i = 0; $i < count($allReceivedPayments); $i++) {
        $receivedPayments += $allReceivedPayments[$i]['payment']['amount'];
    }

    if ($paymentData[0]['invoiceGrossAmount'] <= $receivedPayments) {
        $sqlQuery = 'UPDATE invoices SET paymentStatus="1" WHERE id=?';
        $paramType = 'i';
        $param = [$_POST['id']];

        dataQueryPrepStmt($sqlQuery, $paramType, $param);
    }
}


function fetchPaymentRemindersById()
{
    $sqlQuery = 'SELECT * FROM paymentReminder WHERE invoiceId =?';
    $paramType = 'i';
    $param = [$_POST['id']];

    $paymentReminders = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $result['paymentReminders'] = $paymentReminders->fetch_all(MYSQLI_ASSOC);

    $sqlQuery = 'SELECT * FROM invoices WHERE id =?';

    $invoiceData = dataQueryPrepStmt($sqlQuery, $paramType, $param);
    $result['invoiceData'] = $invoiceData->fetch_all(MYSQLI_ASSOC);

    return $result;
}


function createPaymentReminder()
{
    $paymentReminderFee = $_POST['paymentReminder']['paymentReminderFee'] == '1' ? '2.50' : '0';
    $paymentReminderInterest = $_POST['paymentReminder']['paymentReminderFee'] == '1' ? getPaymentReminderInterest($_POST['paymentReminder']['invoiceDueDate'], $_POST['paymentReminder']['costumerType'], $_POST['paymentReminder']['invoiceId']) : '0';

    $sqlQuery = 'INSERT INTO paymentReminder (invoiceId, reminderDueDate, reminderTitle, reminderContent, reminderInterest, reminderFee) VALUES (?,?,?,?,?,?)';
    $paramType = 'isssdd';
    $param = [$_POST['paymentReminder']['invoiceId'], $_POST['paymentReminder']['paymentReminderDueDate'], $_POST['paymentReminder']['paymentReminderTitle'], $_POST['paymentReminder']['paymentReminderContent'], $paymentReminderFee, $paymentReminderInterest];

    // logger($paymentReminderInterest);
}


function getPaymentReminderInterest($invoiceDueDate, $costumerType, $invoiceId)
{
    $baseInterestRate = fetchBaseInterestRate($invoiceDueDate);  //BaseInterestRate ist jetzt ein Array, das alle relevanten Basiszinssätze enthält Berechnung anpassen, wenn Datumsgrenzen überschritten werden
    $invoiceData = fetchInvoiceDataById($invoiceId);
    $invoiceGrossAmount = $invoiceData[0]['invoiceGrossAmount'];
    $paymentReminderInterest = 0;
    $receivedPayments = json_decode($invoiceData[0]['receivedPayments'], true);
    $invoiceDueDate = new DateTime($invoiceDueDate);
    $today = new DateTime;
    $numberOfDaysInYear = isLeapYear() ? 366 : 365;

    if ($costumerType == 'b2c' && count($baseInterestRate) == 1) {
        $paymentReminderInterestRate = $baseInterestRate[0]['baseInterestRate'] + 5;
    } else if ($costumerType == 'b2b' && count($baseInterestRate) == 1) {
        $paymentReminderInterestRate = $baseInterestRate[0]['baseInterestRate'] + 9;
    }

    //Berechnung, wenn Teilzahlungen gemacht wurden
    if (count($receivedPayments) > 0) {
        for ($i = 0; $i <= count($receivedPayments); $i++) {
            $startDate = $i == 0 ? $invoiceDueDate : new DateTime($receivedPayments[$i - 1]['payment']['date']);
            $receivedPayment = $receivedPayments[$i]['payment']['amount'] ?? 0;
            $dateOfPayment = new DateTime($receivedPayments[$i]['payment']['date'] ?? 'now');

            if ($dateOfPayment <= $invoiceDueDate) {
                $invoiceGrossAmount -= $receivedPayment;
            }
            /* wenn DatumBasiszins < DatumFälligkeit && DatumJetzt < nächsteDatumBasiszins {
             Basiszins = alter Basiszins 
             StartDatum = Fälligkeitsdatum
            } 
                wenn aber DatumBasiszins < DatumFälligkeit && DatumJetzt > nächsteDatumBasiszins 
            {
             Basiszins = alter Basiszins
             StartDatum = Fälligkeitsdatum
             EndDatum = nächstesBasiszinsDatum

             Tage = Differenz von Start und Enddatum

             Zinssatz = Rate bis Enddatum

             Basiszins = neuer Basiszins
             StartDatum = Enddatum
             EndDatum = nächstes nächstesDatumBasisZins || heute wenn nächstesDatumBasisZins > als heute ist

             Tage = Differenz von Start und Enddatum

             Zinssatz = Zinssatz + neue Rate zwischen Start und Enddatum    
            }
            */
            if ($dateOfPayment > $invoiceDueDate) {
                $numberOfDaysBetween = $startDate->diff($dateOfPayment)->format('%d');
                $paymentReminderInterest += $invoiceGrossAmount * $paymentReminderInterestRate / 100 / $numberOfDaysInYear * $numberOfDaysBetween;

                if ($paymentReminderInterest < $receivedPayment) {
                    $receivedPayment = $receivedPayment - $paymentReminderInterest;
                    $paymentReminderInterest = 0;
                }

                $invoiceGrossAmount += $paymentReminderInterest;
                $invoiceGrossAmount -= $receivedPayment;
            }
        }
        setAmountToPayByInvoiceId($invoiceGrossAmount, $invoiceId);

        return $paymentReminderInterest;
    }

    //Berechnung, wenn keine Teilzahlung gemacht wurde
    if (count($receivedPayments) == 0) {
        $numberOfDaysBetween = $invoiceDueDate->diff($today)->format('%d');
        
        $paymentReminderInterest += $invoiceGrossAmount * $paymentReminderInterestRate / 100 / $numberOfDaysInYear * $numberOfDaysBetween;
        $invoiceGrossAmount += $paymentReminderInterest;

        setAmountToPayByInvoiceId($invoiceGrossAmount, $invoiceId);

        return $paymentReminderInterest;
    }



    // logger($invoiceData);
}


function setAmountToPayByInvoiceId($invoiceGrossAmount, $invoiceId)
{
    $sqlQuery = 'UPDATE invoices SET amountToPay = ? WHERE id = ?';
    $paramType = 'di';
    $param = [$invoiceGrossAmount, $invoiceId];

    dataQueryPrepStmt($sqlQuery, $paramType, $param);
}


function isLeapYear()
{
    $date = new DateTime();
    $year = $date->format('L');

    return $year;
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
    $receivedPayments = '[]';

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
            $products0[$i]['productTotalNetPrice'] = $singleProductTotalPrice0;
            $products0[$i]['productTotalGrossPrice'] = $singleProductTotalPrice0;
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
    $invoiceGrossAmount = isset($_POST['invoiceData']['smallBusinessTax']) || isset($_POST['invoiceData']['reverseCharge']) ?
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
    $amountToPay = $invoiceGrossAmount;

    $sqlQuery = "INSERT INTO invoices (selfName, selfAddress, selfTaxId, selfSalesTaxId, selfBankAccountNumber, selfIBAN, selfBIC, selfBankName, selfMail, selfPhoneNumber,
                 costumerName, costumerAddress, costumerTaxId, costumerSalesTaxId, products0, products7, products19, totalTax7, totalTax19, invoiceNetAmount, invoiceGrossAmount,
                 paymentTerms, smallBusinessTax, reverseCharge, invoiceComment, fullfillmentDateStart, FullfillmentDateEnd, paymentStatus, receivedPayments, amountToPay) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramType = 'sssssssssssssssssddddiiisssisd';
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
        $invoiceGrossAmount,
        $paymentTerms,
        $smallBusinessTax,
        $reverseCharge,
        $invoiceComment,
        $fullfillmentDateStart,
        $fullfillmentDateEnd,
        $paymentStatus,
        $receivedPayments,
        $amountToPay
    ];

    $result = dataQueryPrepStmt($sqlQuery, $paramType, $param);

    return $result;
}


//simple Error-Logging

function logger($valueToLog, $string = '')
{
    // error_log('file: ' . __FILE__);
    error_log('Logger: ' . $string . ': ' . print_r($valueToLog, true));
}
