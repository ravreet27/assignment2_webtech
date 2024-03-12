<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM orders";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        sendResponse(['error' => 'Failed to retrieve orders']);
    }

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    sendResponse(['orders' => $data]);
}

mysqli_close($conn);
?>
