<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$city_id = $_GET['city_id'];

// Lekérjük az ahhoz tartozó látványosságokat az adatbázisból
$sql = "SELECT attraction_id, name FROM attractions WHERE city_id = :city_id";
$query = $pdo->prepare($sql);
$query->execute(array(':city_id' => $city_id));
$attractions = $query->fetchAll();

// Kilistázzuk a látványosságokat checkboxokban
foreach ($attractions as $attraction) {
    echo '<label>';
    echo '<input type="checkbox" name="attraction_ids[]" value="' . $attraction['attraction_id'] . '"> ' . $attraction['name'];
    echo '</label><br>';
}
?>