<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
//$sql = "SELECT city_id, city_name, organization_name, checked FROM cities";
$sql = "SELECT organizations.org_id ,organizations.org_name, cities.city_name,organizations.active, organizations.status, organizations.city_id FROM organizations INNER JOIN cities  ON organizations.city_id = cities.city_id ";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row){
    $ret[] = [
        'org_id' => $row['org_id'],
        "org_name" => $row['org_name'],
        "city_name" => $row['city_name'],
        "active" => $row['active'],
        "status" => $row['status'],
        "city_id" => $row['city_id'],
    ];
}
header('Content-Type: application/json');
echo json_encode($result);
