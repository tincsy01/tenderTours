<?php

require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizzük, hogy az attraction_id megléte
if (!isset($_GET['attraction_id'])) {
    die("Missing attraction ID");
}

$attraction_id = $_GET['attraction_id'];

// Lekérdezzük a kommenteket az adott attraction-höz
$sql = "SELECT * FROM comments WHERE attraction_id = :attraction_id";
$query = $pdo->prepare($sql);
$query->bindParam(':attraction_id', $attraction_id);
$query->execute();
$comments = $query->fetchAll(PDO::FETCH_ASSOC);

// Válasz elküldése JSON formátumban
header('Content-Type: application/json');
echo json_encode(array('success' => true, 'comments' => $comments));