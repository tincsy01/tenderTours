<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$sql = "SELECT city_id, city_name, organization_name FROM cities ";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row){
    $ret[] = [
        "city_name" => $row['city_name'],
        "organization_name" => $row['organization_name'],
        "city_id" => $row['city_id'],
    ];
}
header('Content-Type: application/json');
echo json_encode($result);
