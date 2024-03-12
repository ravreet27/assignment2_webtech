<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $userId = $requestData['userId'];
    $email = $requestData['email'];
    $password = $requestData['password'];
    $username = $requestData['username'];
    $purchaseHistory = $requestData['purchaseHistory'];
    $shippingAddress = $requestData['shippingAddress'];

    $query = "UPDATE user SET email='$email', password='$password', username='$username', purchaseHistory='$purchaseHistory', shippingAddress='$shippingAddress' WHERE userId='$userId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'User updated successfully']);
    } else {
        sendResponse(['error' => 'Failed to update user']);
    }
}

mysqli_close($conn);
?>
