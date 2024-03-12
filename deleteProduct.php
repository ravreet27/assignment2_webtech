<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $productId = $_GET['productId'] ?? null;

    if (!$productId) {
        sendResponse(['error' => 'Product ID is missing']);
    }

    $query = "DELETE FROM product WHERE productId='$productId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Product deleted successfully']);
    } else {
        sendResponse(['error' => 'Failed to delete product']);
    }
} else {
    sendResponse(['error' => 'Invalid request method']);
}

mysqli_close($conn);
?>

