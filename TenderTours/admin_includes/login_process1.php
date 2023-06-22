<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

// Ellenőrizd, hogy a felhasználónév megadva van-e
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $sql= "SELECT username FROM users WHERE username = :username AND permission = 1";
    $query = $pdo->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();
    $count = $query->fetchColumn();
    if($count > 0){
        $isValidUsername = true;
    }

    if ($isValidUsername) {
        $_SESSION['username'] = $username;

        // Továbblendít a jelszó bekéréséhez
        header('Location: ../admin_pages/login2.php');
        exit();
    } else {
        // Hibás felhasználónév, visszatér az első lépéshez
        header('Location: ../admin_pages/login1.php?r=1');
        exit();
    }
} else {
    // Ha nincs felhasználónév, visszatér az első lépéshez
    header('Location: ../admin_pages/login1.php');
    exit();
}
