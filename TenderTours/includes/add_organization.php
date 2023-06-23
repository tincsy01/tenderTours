<?php
require 'db_config.php';
require 'config.php';
require 'functions.php';
//        var_dump($username);die();
if(isset($_POST['name'])) {
    $name = trim($_POST["name"]);
}
if (isset($_POST['city'])) {
    $city = $_POST["city"];
}
if(isset($_POST['username'])) {
    $username = trim($_POST["username"]);
}
if (isset($_POST['email'])) {
    $email = trim($_POST["email"]);
}
if (isset($_POST['password'])) {
    $password = trim($_POST["password"]);
}
if (isset($_POST['phone'])) {
    $phone = trim($_POST["phone"]);
}
if (isset($_POST['address'])) {
    $address = trim($_POST["address"]);
}
if (isset($_POST['description'])) {
    $description = trim($_POST["description"]);
}
//var_dump($name, $city, $username, $email,$address,$description, $phone);die();
if (empty($name)) {
    redirection('../add_organizations.php?r=4');
}
if (empty($city)) {
    redirection('../add_organizations.php?r=4');
}
if (empty($username)) {
    redirection('../add_organizations.php?r=4');
}
if (empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirection('../add_organizations.php?r=8');
}
if (empty($password) OR strlen($password) < 7) {
    redirection('../add_organizations.php?r=9');
}
if (empty($phone)) {
    redirection('../add_organizations.php?r=4');
}
if (empty($address)) {
    redirection('../add_organizations.php?r=4');
}
if (empty($description)) {
    redirection('../add_organizations.php?r=4');
}
if (!existsOrganization($name)) {
    $code = createCode(40);
    //var_dump($name, $city, $username, $email, $address,$description, $phone, $reg_expire, $code   );die();

    $org_id = registerOrganization( $name, $city, $username, $email, $password, $phone, $address, $description,  $code);
    if (sendData($username, $email, $code)) {
        redirection("../admin_pages/add_organizations.php?r=3");
    } else {
        //addEmailFailure($user_id);
        redirection("../admin_pages/add_organizations.php?r=10");
    }

} else {
    redirection('../admin_pages/add_organizations.php?r=2');
}