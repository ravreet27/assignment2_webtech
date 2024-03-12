<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $commentId = $requestData['commentId'];

    $query = "DELETE FROM comments WHERE commentId='$commentId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Comment deleted successfully']);
    } else {
        sendResponse(['error' => 'Failed to delete comment']);
    }
}

mysqli_close($conn);
?>
