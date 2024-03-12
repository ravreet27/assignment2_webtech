<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $orderId = $requestData['orderId'];
    $productId = $requestData['productId'];
    $userId = $requestData['userId'];
    $quantity = $requestData['quantity'];
    $totalCost = $requestData['totalCost'];

    $query = "UPDATE orders SET productId='$productId', userId='$userId', quantity='$quantity', totalCost='$totalCost' WHERE orderId='$orderId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Order updated successfully']);
    } else {
        sendResponse(['error' => 'Failed to update order']);
    }
}

mysqli_close($conn);
?>
