<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $productId = $requestData['productId'];
    $userId = $requestData['userId'];
    $quantity = $requestData['quantity'];
    $totalCost = $requestData['totalCost'];

    // Check if productId exists
    $checkProductQuery = "SELECT * FROM product WHERE productId='$productId'";
    $checkProductResult = mysqli_query($conn, $checkProductQuery);
    if (!$checkProductResult || mysqli_num_rows($checkProductResult) === 0) {
        sendResponse(['error' => 'Product with the specified ID does not exist']);
    }

    $checkUserQuery = "SELECT * FROM user WHERE userId='$userId'";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);
    if (!$checkUserResult || mysqli_num_rows($checkUserResult) === 0) {
        sendResponse(['error' => 'User with the specified ID does not exist']);
    }

    $query = "INSERT INTO orders (productId, userId, quantity, totalCost) VALUES ('$productId', '$userId', '$quantity', '$totalCost')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Order added successfully']);
    } else {
        sendResponse(['error' => 'Failed to add order']);
    }
}

mysqli_close($conn);
?>
