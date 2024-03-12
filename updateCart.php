<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $cartId = $requestData['cartId'];
    $productId = $requestData['productId'];
    $userId = $requestData['userId'];
    $quantity = $requestData['quantity'];

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

    $query = "UPDATE cart SET productId='$productId', userId='$userId', quantity='$quantity' WHERE cartId='$cartId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Cart updated successfully']);
    } else {
        sendResponse(['error' => 'Failed to update cart']);
    }
}

mysqli_close($conn);
?>
