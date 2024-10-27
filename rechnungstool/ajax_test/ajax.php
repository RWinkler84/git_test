<?php 
header('Content-Type: application/json');

if (isset($_POST)){
    $response = file_get_contents('data.txt');
}

// var_dump($response);

echo json_encode($response);
