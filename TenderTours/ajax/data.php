<?php

// Adatbázis kapcsolat beállítása
require_once '../includes/config.php';
require_once '../includes/db_config.php';

try {
    $pdo = connectDatabase($dsn, $pdoOptions);

    // Adatok lekérdezése az adatbázisból
    $sql = "SELECT name, num_of_visitors FROM attractions";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // JSON válasz elkészítése
    $response = [
        'success' => true,
        'data' => $result
    ];
} catch (PDOException $e) {
    // Hiba esetén JSON válasz elkészítése
    $response = [
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ];
}

// JSON válasz kimenete
header('Content-Type: application/json');
echo json_encode($response);
