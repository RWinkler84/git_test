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

            $stmt = $conn->prepare("INSERT INTO products (productTitle, productPrice, taxRate, productDescription) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription']);
            $result = $stmt->execute();
            break;
        case 'createInvoice':
            $fetchSelf = $conn->query('SELECT * FROM businessInfo');
            $fetchcostumer = $conn->query('SELECT * FROM costumer WHERE id=\'' . $_POST('costumerSelect') . '\'');
            
            $costumer = $fetchCostumer->fetch_all(MYSQLI_ASSOC);
            $self = $fetchCostumer->fetch_all(MYSQLI_ASSOC);
            $result = [$costumer, $self];
    }
}

echo json_encode($result);

// Sortierfuntion überarbeiten, Feld mit Zeitstempel für das Erstellen und Ändern von Produkten einführen, um geänderte Produkte oben in der Liste zu
// zu haben, auch wenn sie schon vor längerer Zeit erzeugt wurden