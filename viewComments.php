<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT * FROM comments";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        sendResponse(['error' => 'Failed to retrieve comments']);
    }

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    sendResponse(['comments' => $data]);
}

mysqli_close($conn);
?>
