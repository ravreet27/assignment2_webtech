<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $query = "SELECT * FROM user WHERE userId='$userId'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve user']);
        }

        $data = mysqli_fetch_assoc($result);
        if (!$data) {
            sendResponse(['error' => 'User not found']);
        }
        
        sendResponse(['user' => $data]);
    } else {
        $query = "SELECT * FROM user";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            sendResponse(['error' => 'Failed to retrieve users']);
        }

        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        sendResponse(['users' => $users]);
    }
}

mysqli_close($conn);
?>
