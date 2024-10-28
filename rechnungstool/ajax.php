<?php
require 'db.php';
header('Content-Type: application/json');
$result = [];

if (isset($_POST['action'])) {

    switch ($_POST['action']) {

        case 'addProductSelect':
            $fetchProduct = $conn->query("SELECT id, productTitle, productPrice, lastEdited FROM products");
            $product = $fetchProduct->fetch_all(MYSQLI_ASSOC);
            usort($product, function ($a, $b) {
                return strcmp($b['lastEdited'], $a['lastEdited']);
            });
            $result = $product;
            break;

        case 'getCostumer':
            $fetchCostumer = $conn->query("SELECT id, name FROM costumer");
            $costumer = $fetchCostumer->fetch_all(MYSQLI_ASSOC);
            usort($costumer, function ($a, $b) {
                return strcmp($a['name'], $b['name']);
            });
            $result = $costumer;
            break;

        case 'createProduct':
            $sqlQuery = "INSERT INTO products (productTitle, productPrice, taxRate, productDescription) VALUES (?,?,?,?)";
            $paramType = "ssss";
            $param = [$_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription']];
            $result = fetchDataPrepStmt($sqlQuery, $paramType, $param);
            break;
        case 'createInvoice':

            $costumer = fetchCostumer();
            $self = fetchSelf(); //self sind die Daten des eigenen Unternehmens
            processInvoiceData($self, $costumer);

            $result = $self;
    }
}

echo json_encode($result);



function fetchDataPrepStmt($sqlQuery, $paramType, $param)
{
    global $conn;

    $stmt = $conn->prepare($sqlQuery);
    $stmt->bind_param($paramType, ...$param);
    $stmt->execute();
    $fetchedData = $stmt->get_result();

    return $fetchedData;
}


function fetchCostumer()
{
    $sqlQuery = "SELECT * FROM costumer WHERE id=?";
    $param = [$_POST['invoiceData']['costumerSelect']];
    $paramType = "i";
    $fetchCostumer = fetchDataPrepStmt($sqlQuery, $paramType, $param);

    return $fetchCostumer->fetch_all(MYSQLI_ASSOC);    
}

function fetchSelf(){

    $sqlQuery = "SELECT * FROM businessInfo WHERE id=?";
    $fetchSelf = fetchDataPrepStmt($sqlQuery, "i", [1]);

    return $fetchSelf->fetch_all(MYSQLI_ASSOC);

}

function processInvoiceData($self, $costumer){
    error_log(print_r($_POST, true));

//erzeugt Variablen aus den Key-Value-Pairs mit dem Präfix self_ und costumer
    extract($self[0],EXTR_PREFIX_ALL, "self"); 
    extract($costumer[0],EXTR_PREFIX_ALL, "costumer");

    $paymentTerms = $_POST['invoiceData']['paymentTerms'];
    $smallBusinessTax = $_POST['invoiceData']['smallBusinessTax'] ?? false;

}
             
// Methode suchen, um das Post-Array nach product-Select und Product-Ammount Keys zu durchsuchen
// und über diese die zugehörigen Daten aus der Datenbank zu holen. Neue Funktion 
// fetchProduct() dafür erstellen

//ODER Preis aus dem Frontend holen. ein entsprechendes Costum Attribute ist angelegt. Mach dir nen Kopp!