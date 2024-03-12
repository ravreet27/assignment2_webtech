<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (!isset($requestData['orderId'])) {
        sendResponse(['error' => 'orderId is missing']);
    }

    $orderId = $requestData['orderId'];

    $query = "DELETE FROM orders WHERE orderId='$orderId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Order deleted successfully']);
    } else {
        sendResponse(['error' => 'Failed to delete order']);
    }
} else {
    sendResponse(['error' => 'Invalid request method']);
}

mysqli_close($conn);
?>
