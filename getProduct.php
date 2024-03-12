<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['productId'])) {
        $productId = $_GET['productId'];
        $query = "SELECT * FROM product WHERE productId='$productId'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve product']);
        }

        $data = mysqli_fetch_assoc($result);
        if (!$data) {
            sendResponse(['error' => 'Product not found']);
        }
        
        sendResponse(['product' => $data]);
    } else {
        $query = "SELECT * FROM product";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve products']);
        }

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        sendResponse(['products' => $products]);
    }
}

mysqli_close($conn);
?>
