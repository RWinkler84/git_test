<?php

require 'db.php';

$stmt = $conn->prepare("SELECT * FROM invoices WHERE id=?");
$stmt->bind_param('i', $_GET['id']);
$stmt->execute();
$fetchedInvoiceData = $stmt->get_result();
$invoiceData = $fetchedInvoiceData->fetch_all(MYSQLI_ASSOC);

print_r($invoiceData[0]['products7']);
