<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $description = $requestData['description'];
    $image = $requestData['image'];
    $pricing = $requestData['pricing'];
    $shippingCost = $requestData['shippingCost'];

    $query = "INSERT INTO product (description, image, pricing, shippingCost) VALUES ('$description', '$image', '$pricing', '$shippingCost')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Product added successfully']);
    } else {
        sendResponse(['error' => 'Failed to add product']);
    }
}

mysqli_close($conn);
?>
