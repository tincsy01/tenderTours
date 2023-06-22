<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

if (isset($_POST['password'])) {
    $pw= $_POST['password'];
    $username = $_SESSION['username'];

    $sql= "SELECT username, password, permission, user_id FROM users WHERE username = :username AND permission = 1";
    $query = $pdo->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();
    $check_username = '';
    $check_password = '';
    $permission="";
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $check_username = $row['username'];
        $check_password = $row['password'];
        $permission= $row['permission'];
        $user_id = $row['user_id'];
    }
    if(password_verify($pw, $check_password)){
        $_SESSION['username'] = $username;
        $_SESSION['user_id']= $user_id;
        $_SESSION['permission'] = $permission;
        header("Location: ../admin_pages/index.php");
    }
    else {
        echo '<h3>Please write again your username and password</h3>';
    }
}