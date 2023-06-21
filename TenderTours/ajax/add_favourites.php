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
if (addToFavorites($pdo, $user_id, $attraction_id)) {
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


//require_once '../includes/config.php';
//require_once '../includes/db_config.php';
//$pdo = connectDatabase($dsn, $pdoOptions);
//
//
//// Ellenőrizd, hogy be van-e jelentkezve a felhasználó
//session_start();
//
//if (!isset($_SESSION['user_id'])) {
//    $response = array('success' => false, 'message' => 'User not logged in.');
//    echo json_encode($response);
//    exit;
//}
//
//// Ellenőrizd, hogy megkapta-e az attraction_id-t az AJAX kéréssel
//if (!isset($_POST['attraction_id'])) {
//    $response = array('success' => false, 'message' => 'Attraction ID is missing.');
//    echo json_encode($response);
//    exit;
//}
//
//$attraction_id = $_POST['attraction_id'];
//$user_id = $_SESSION['user_id'];
//
//// Ellenőrizd, hogy az attrakció már hozzá van-e adva a kedvencekhez
//$sql = "SELECT * FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
//$query = $pdo->prepare($sql);
//$query->bindParam(':user_id', $user_id);
//$query->bindParam(':attraction_id', $attraction_id);
//$query->execute();
//
//if ($query->rowCount() > 0) {
//    // Az attrakció már hozzá van adva a kedvencekhez, visszatérünk a válasszal
//    $response = array('success' => false, 'message' => 'Attraction already added to favourites.');
//    echo json_encode($response);
//    exit;
//}
//
//// Hozzáadás az adatbázishoz
//$sql = "INSERT INTO favourites (user_id, attraction_id) VALUES (:user_id, :attraction_id)";
//$query = $pdo->prepare($sql);
//$query->bindParam(':user_id', $user_id);
//$query->bindParam(':attraction_id', $attraction_id);
//
//if ($query->execute()) {
//    $response = array('success' => true, 'message' => 'Attraction added to favourites.');
//    echo json_encode($response);
//    exit;
//} else {
//    $response = array('success' => false, 'message' => 'Failed to add attraction to favourites.');
//    echo json_encode($response);
//    exit;
//}

//mukodo1
// Ellenőrizd, hogy be van-e jelentkezve a felhasználó
//session_start();
//if (!isset($_SESSION['user_id'])) {
//    $response = array('success' => false, 'message' => 'User not logged in.');
//    echo json_encode($response);
//    exit;
//}
//
//// Ellenőrizd, hogy megkapta-e az attraction_id-t az AJAX kéréssel
//if (!isset($_POST['attraction_id'])) {
//    $response = array('success' => false, 'message' => 'Attraction ID is missing.');
//    echo json_encode($response);
//    exit;
//}
//
//$attraction_id = $_POST['attraction_id'];
//$user_id = $_SESSION['user_id'];
//
//// Itt végezheted el a kedvencekhez adást vagy adatbázisba mentést
// $sql = "INSERT INTO favorites (user_id, attraction_id) VALUES (:user_id, :attraction_id)";
// $query = $pdo->prepare($sql);
// $query->bindValue(':user_id', $user_id);
// $query->bindValue(':attraction_id', $attraction_id);
// $result = $query->execute();
//
//// Ellenőrizd, hogy sikerült-e hozzáadni a kedvencekhez
//if ($result) {
//    $response = array('success' => true, 'message' => 'Attraction added to favourites.');
//    echo json_encode($response);
//} else {
//    $response = array('success' => false, 'message' => 'Failed to add attraction to favourites.');
//    echo json_encode($response);
//}
?>