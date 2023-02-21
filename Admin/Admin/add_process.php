<?php
/*szervezet hozzaadasa*/
require 'config.php';
require 'db_config.php';
require 'functions.php';
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