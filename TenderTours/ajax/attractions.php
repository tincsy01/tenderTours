<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$org_id = $_SESSION['user_id'];
$data = [];
$number = 1;

$sql = "SELECT name, num_of_visitors, popular, attraction_id FROM attractions WHERE org_id = :org_id";
$query = $pdo->prepare($sql);
$query->bindParam(':org_id', $org_id);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $data[] = [
        $number,
        $row['name'],
        $row['num_of_visitors'],
        $row['popular'],
        '<i class="bi bi-pencil-fill editAttraction pointer" data-id="' . $row['attraction_id'] . '" title="Edit"></i> &nbsp; <i class="bi bi-trash-fill deleteAttraction pointer" data-id="' . $row['attraction_id'] . '" data-name="' . $row['name'] . '" title="Delete"></i> '
    ];
    $number++;
}
$json_data = [
    "draw" => 1,
    "data" => $data
];

echo json_encode($json_data);



