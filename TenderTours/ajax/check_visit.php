<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in");
}

// Ellenőrizzük, hogy az attraction_id megléte
if (!isset($_GET['attraction_id'])) {
    die("Missing attraction ID");
}

$user_id = $_SESSION['user_id'];
$attraction_id = $_GET['attraction_id'];

$sql = "SELECT COUNT(*) FROM tours t
        INNER JOIN tour_attraction ta ON t.tour_id = ta.tour_id
        WHERE t.user_id = :user_id AND ta.attraction_id = :attraction_id";
$query = $pdo->prepare($sql);
$query->bindParam(':user_id', $user_id);
$query->bindParam(':attraction_id', $attraction_id);
$query->execute();
$count = $query->fetchColumn();

// A látogatás státuszának alapján válasz küldése
$response = array();
if ($count > 0) {
    $response['visited'] = true;
} else {
    $response['visited'] = false;
}

// Válasz elküldése JSON formátumban
header('Content-Type: application/json');
echo json_encode($response);
?>



