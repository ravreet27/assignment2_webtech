<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $productId = $requestData['productId'];
    $description = $requestData['description'];
    $image = $requestData['image'];
    $pricing = $requestData['pricing'];
    $shippingCost = $requestData['shippingCost'];

    $query = "UPDATE product SET description='$description', image='$image', pricing='$pricing', shippingCost='$shippingCost' WHERE productId='$productId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Product updated successfully']);
    } else {
        sendResponse(['error' => 'Failed to update product']);
    }
}

mysqli_close($conn);
?>
