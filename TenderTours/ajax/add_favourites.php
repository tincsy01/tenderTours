<?php

require_once '../includes/config.php';
require_once '../includes/db_config.php';
require_once 'ajax_helpers.php';

$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizd, hogy a felhasználó be van-e jelentkezve
session_start();

if (!isset($_SESSION['user_id'])) {
    // Felhasználó nincs bejelentkezve, hibaüzenetet küldünk
    $response = array('success' => false, 'message' => 'User not logged in.');
    echo json_encode($response);
    exit;
}

// Ellenőrizd, hogy megkapta-e az attraction_id-t az AJAX kéréssel
if (!isset($_POST['attraction_id'])) {
    // Hiányzó attrakció azonosító, hibaüzenetet küldünk
    $response = array('success' => false, 'message' => 'Attraction ID is missing.');
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user_id'];
$attraction_id = $_POST['attraction_id'];

// Ellenőrizd, hogy az attrakció már hozzá van-e adva a kedvencekhez
if (isAttractionInFavorites($pdo, $user_id, $attraction_id)) {
    // Az attrakció már hozzá van adva a kedvencekhez, hibaüzenetet küldünk
    $response = array('success' => false, 'message' => 'Attraction already added to favourites.');
    echo json_encode($response);
    exit;
}

// Hozzáadás az adatbázishoz
if (addToFavorites($pdo, $user_id, $attraction_id) AND $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sikeres hozzáadás
    $response = array('success' => true, 'message' => 'Attraction added to favourites.');
    echo json_encode($response);
    exit;
} else {
    // Hiba történt a hozzáadás során
    $response = array('success' => false, 'message' => 'Failed to add attraction to favourites.');
    echo json_encode($response);
    exit;
}
?>