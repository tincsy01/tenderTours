<?php
//session_start();
header('Content-Type: application/json; charset=utf-8');
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

$sql = "SELECT c.city_name, t.tour_id, t.user_id, ta.attraction_id, a.name, c.city_id, t.date
        FROM tours t 
        INNER JOIN tour_attraction ta ON t.tour_id = ta.tour_id 
        INNER JOIN attractions a ON a.attraction_id = ta.attraction_id 
        INNER JOIN cities c ON c.city_id = a.city_id";

$query = $pdo->query($sql);
$tours = $query->fetchAll(PDO::FETCH_ASSOC);

// Group attractions by tour ID
$groupedTours = array();
foreach ($tours as $tour) {
    $attraction = array(
        'attraction_id' => $tour['attraction_id'],
        'name' => $tour['name']
    );
    if (!isset($groupedTours[$tour['tour_id']])) {
        $groupedTours[$tour['tour_id']] = array(
            'tour_id' => $tour['tour_id'],
            'user_id' => $tour['user_id'],
            'city_id' => $tour['city_id'],
            'city_name' => $tour['city_name'],
            'attractions' => array(),
            'date' => $tour['date']
        );
    }
    $groupedTours[$tour['tour_id']]['attractions'][] = $attraction;
}

echo json_encode(array_values($groupedTours));

?>