<?php
require 'db.php';
header('Content-Type: application/json');
$result = [];
            error_log('bin drin');
        error_log(print_r($_POST,true));

if (isset($_POST['action'])) {

    switch ($_POST['action']) {

        case 'addProduct':
            $fetchProduct = $conn->query("SELECT id, productTitle, productPrice FROM products");
            $product = $fetchProduct->fetch_all(MYSQLI_ASSOC);
            usort($product, function ($a, $b) {
                return strcmp($b['id'], $a['id']);
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

        // error_log(print_r($_POST,true));
            // $stmt = $conn->prepare("INSERT INTO products (productTitle, productPrice, taxRate, productDescription) VALUES (?,?,?,?)");
            // $stmt->bind_param('ssss', $_POST['productTitle'], $_POST['productPrice'], $_POST['taxRate'], $_POST['productDescription']);
            // $result = $stmt->execute();

    }
}

echo json_encode($result);
