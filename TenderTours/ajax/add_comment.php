<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$user_id = $_SESSION['user_id'];
$attraction_id = $_POST['attraction_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (user_id, attraction_id, comment) VALUES (:user_id, :attraction_id, :comment)";
$query = $pdo->prepare($sql);
$query->bindParam(':user_id', $user_id);
$query->bindParam(':attraction_id', $attraction_id);
$query->bindParam(':comment', $comment);

$response = array();

if ($query->execute()) {
    // Komment sikeresen hozzáadva
    $response['success'] = true;
    $response['message'] = "Comment added successfully.";
} else {
    // Hiba történt a komment hozzáadása közben
    $response['success'] = false;
    $response['message'] = "Failed to add comment.";
}

header('Content-Type: application/json');
echo json_encode($response);