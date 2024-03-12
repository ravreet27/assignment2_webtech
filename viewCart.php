<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['cartId'])) {
        $cartId = $_GET['cartId'];
        $query = "SELECT * FROM cart WHERE cartId='$cartId'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve cart']);
        }

        $data = mysqli_fetch_assoc($result);
        if (!$data) {
            sendResponse(['error' => 'Cart not found']);
        }
        
        sendResponse(['cart' => $data]);
    } else {
        $query = "SELECT * FROM cart";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve carts']);
        }

        $carts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $carts[] = $row;
        }
        sendResponse(['carts' => $carts]);
    }
}

mysqli_close($conn);
?>
