<?php
/*Bejelentkezes admin feluletre*/

if(isset($_POST['log_in']) AND isset($_POST['username']) AND isset($_POST['password']) AND !empty(($_POST['username'])) AND !empty(($_POST['password']))){
    $pw = $_POST['password'];
    $un = $_POST['username'];

    $sql = "SELECT username, password, permission,user_id, email, code, active, address FROM users WHERE username= :username AND active = 1";
    $sql -> bindValue(':username', $un);
    $query = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sql->execute();

    $check_username = '';
    $check_password = '';
    $permission="";
    $user_id = "";
    $active = "";
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $check_username = $row['username'];
        $check_password = $row['password'];
        $permission= $row['permission'];
        $user_id = $row['user_id'];
        $user_email = $row['email'];
        $address = $row['address'];
    }

    if ($un == $check_username and password_verify($pw, $check_password)) {

        $_SESSION['username'] = $un;
        $_SESSION['user_id']= $user_id;
        $_SESSION['permission'] = $permission;
        $_SESSION['email'] = $user_email;
        $_SESSION['address'] = $address;
        $_SESSION['cart'] = [];
        header("Location: front.php");
    } else {
        echo '<h3>Please write again your username and password</h3>';
    }
}

