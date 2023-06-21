<?php

require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT a.attraction_id, a.name
        FROM attractions a 
        INNER JOIN favourites f ON a.attraction_id = f.attraction_id";
$query = $pdo->prepare($sql);
$query->execute();
$attractions = $query->fetchAll(PDO::FETCH_ASSOC);
$response = array();

if ($attractions) {
    $response['success'] = true;
    $response['attractions'] = $attractions;
} else {
    $response['success'] = false;
}

header('Content-Type: application/json');
echo json_encode($response);
