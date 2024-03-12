<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $email = $requestData['email'];
    $password = $requestData['password'];
    $username = $requestData['username'];
    $purchaseHistory = $requestData['purchaseHistory'];
    $shippingAddress = $requestData['shippingAddress'];

    $query = "INSERT INTO user (email, password, username, purchaseHistory, shippingAddress) VALUES ('$email', '$password', '$username', '$purchaseHistory', '$shippingAddress')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'User added successfully']);
    } else {
        sendResponse(['error' => 'Failed to add user']);
    }
}

mysqli_close($conn);
?>
