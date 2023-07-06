<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);


    $cityId = $_POST['city_id'];
    $newCityName = $_POST['name'];

    // Városnév frissítése az adatbázisban
    $sql = "UPDATE cities SET city_name = :cityName WHERE city_id = :cityId";
    $query = $pdo->prepare($sql);
    $query->bindParam(':cityName', $newCityName, PDO::PARAM_STR);
    $query->bindParam(':cityId', $cityId, PDO::PARAM_INT);
    $result = $query->execute();

    if ($result) {
        // Sikeres frissítés esetén visszatérítjük a success választ
        $response = array('success' => true, 'msg' => 'City updated successfully.');
    } else {
        // Hiba esetén hibaüzenetet küldünk vissza
        $response = array('success' => false, 'msg' => 'Failed to update city.');
    }

    // JSON válasz küldése
    header('Content-Type: application/json');
    echo json_encode($response);
