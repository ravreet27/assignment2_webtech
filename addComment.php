<?php
include('dbConnection.php');

function sendResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestData = json_decode(file_get_contents('php://input'), true);

    $productId = $requestData['productId'];
    $userId = $requestData['userId'];
    $rating = $requestData['rating'];
    $image = $requestData['image'];
    $text = $requestData['text'];

    $productQuery = "SELECT * FROM product WHERE productId='$productId'";
    $userQuery = "SELECT * FROM user WHERE userId='$userId'";
    $productResult = mysqli_query($conn, $productQuery);
    $userResult = mysqli_query($conn, $userQuery);

    if (mysqli_num_rows($productResult) == 0) {
        sendResponse(['error' => 'Product with the provided ID does not exist']);
    }

    if (mysqli_num_rows($userResult) == 0) {
        sendResponse(['error' => 'User with the provided ID does not exist']);
    }

    $query = "INSERT INTO comments (productId, userId, rating, image, text) VALUES ('$productId', '$userId', '$rating', '$image', '$text')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        sendResponse(['success' => 'Comment added successfully']);
    } else {
        sendResponse(['error' => 'Failed to add comment']);
    }
}

mysqli_close($conn);
?>
