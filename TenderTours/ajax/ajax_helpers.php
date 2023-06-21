<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

function isAttractionInFavorites($pdo, $user_id, $attraction_id) {
    $sql = "SELECT * FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();

    return $query->rowCount() > 0;
}

function addToFavorites($pdo, $user_id, $attraction_id) {
    $sql = "INSERT INTO favourites (user_id, attraction_id) VALUES (:user_id, :attraction_id)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':attraction_id', $attraction_id);

    return $query->execute();
}

function deleteFromFavorites($pdo, $user_id, $attraction_id) {
    $sql = "DELETE FROM favourites WHERE user_id = :user_id AND attraction_id = :attraction_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id', $user_id);
    $query->bindValue(':attraction_id', $attraction_id);

    return $query->execute();
}

function getAttractionName($pdo, $attraction_id) {
    $sql = "SELECT name FROM attractions WHERE attraction_id = :attraction_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();

    $result = $query->fetch();

    return $result['name'];
}

function getAttractionDescription($pdo, $attraction_id) {
    $sql = "SELECT description FROM attractions WHERE attraction_id = :attraction_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();

    $result = $query->fetch();

    return $result['description'];
}
?>
