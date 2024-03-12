<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $requestData = json_decode(file_get_contents('php://input'), true);
    $cartId = $requestData['cartId'];

    $query = "DELETE FROM cart WHERE cartId='$cartId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Cart deleted successfully']);
    } else {
        sendResponse(['error' => 'Failed to delete cart']);
    }
}

mysqli_close($conn);
?>
