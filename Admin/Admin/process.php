<?php
//session_start();
require 'config.php';
require 'db_config.php';
//require 'functions.php';
$pdo = connectDatabase($dsn, $pdoOptions);

/*Bejelentkezes  admin feluletre*/
//var_dump("kivul van");

//$in =  $_POST['log_in'];
//var_dump($pw, $un);

/*Admin bejelentkzes*/
if($_POST['login-button']){
    if(isset($_POST['username']) AND isset($_POST['password']) AND !empty(($_POST['username'])) AND !empty(($_POST['password']))){
        $pw = $_POST['password'];
        $un = $_POST['username'];
        //var_dump($pw, $un);

        $sql = "SELECT username, password, permission,user_id, email, code, active, address FROM users WHERE username= :username AND active = 1 AND permission = 1";
        $query = $pdo->prepare($sql);
        $query -> bindParam(':username', $un, PDO::PARAM_STR);
        $query->execute();

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
        //var_dump($check_username,$permission,$check_password,$active ); die();
        if ($un == $check_username and password_verify($pw, $check_password)) {

            $_SESSION['username'] = $un;
            $_SESSION['user_id']= $user_id;
            $_SESSION['permission'] = $permission;
            $_SESSION['email'] = $user_email;
            $_SESSION['address'] = $address;
            header("Location: index.php");
        } else {
            echo '<h3>Please write again your username and password</h3>';
        }
    }
}


/*szervezet hozzaadasa*/

if(isset($_POST['add_button'])){
    if(isset($_POST['username'])) {
        $username = trim($_POST["username"]);
    }
//        var_dump($username);die();
    if(isset($_POST['name'])) {
        $name = trim($_POST["name"]);
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST["password"]);
    }
    if (isset($_POST['phone'])) {
        $phone = trim($_POST["phone"]);
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST["email"]);
    }

    if (isset($_POST['city'])) {
        $city = trim($_POST["city"]);
    }
    if (isset($_POST['description'])) {
        $description = trim($_POST["description"]);
    }
    if (empty($username)) {
        redirection('add_organization.php?r=4');
    }
    if (empty($phone)) {
        redirection('add_organization.php?r=4');
    }

    if (empty($name)) {
        redirection('add_organization.php?r=4');
    }
    if (empty($phone)) {
        redirection('add_organization.php?r=4');
    }
    if (empty($password) OR strlen($password) < 7) {
        redirection('add_organization.php?r=9');
    }
    if (empty($description)) {
        redirection('add_organization.php?r=4');
    }
    if (empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirection('add_organization.php?r=8');
    }
    if (!existsOrganization($username)) {
        $code = createCode(40);
        $org_id = registerOrganization($username, $password, $name, $city,$phone, $email, $code, $description);
        if (sendData($username, $email, $code)) {
            redirection("add_organization.php?r=3");
        } else {
            //addEmailFailure($user_id);
            redirection("add_organization.php?r=10");
        }

    } else {
        redirection('add_organization.php?r=2');
    }
}
/*szervezet hozzaadasa*/
//if (isset($_POST['add_button'])){
//    if (isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['city']) AND !empty($_POST['city']) AND
//        isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['username']) AND !empty($_POST['username']) AND
//        isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['phone']) AND !empty($_POST['phone']) AND
//        isset($_POST['description']) AND !empty($_POST['description'])) {
//
//        $sql = "INSERT INTO organizations(org_name,city_id, username, email, password, phone, description, code) VALUES
//                            (:org_name, :city_id, :username, :email, :password, :phone, :description, :code)";
//    }
//}