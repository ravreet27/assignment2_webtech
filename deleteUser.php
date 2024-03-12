<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (!isset($requestData['userId'])) {
        sendResponse(['error' => 'User ID is missing']);
    }

    $userId = $requestData['userId'];

    $query = "DELETE FROM user WHERE userId=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($affectedRows > 0) {
        sendResponse(['success' => 'User deleted successfully']);
    } else {
        sendResponse(['error' => 'Failed to delete user']);
    }
}

mysqli_close($conn);
?>
