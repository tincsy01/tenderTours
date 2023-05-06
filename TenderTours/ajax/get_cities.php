<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$sql = "SELECT city_id, city_name, image FROM cities";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll();
$ret = [];
foreach ($result as $row) {
    $ret[] = [
        "city_id" => $row['city_id'],
        "city_name" => $row['city_name'],
        "image" => $row['image']
    ];
}
// Töröljük az adatpuffer tartalmát
ob_clean();

// Indítsuk újra az adatpuffert
ob_start();

// Állítsuk be a HTTP Content-Type fejlécét JSON formátumra
header('Content-Type: application/json');
echo json_encode($ret);

