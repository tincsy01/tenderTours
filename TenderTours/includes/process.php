<?php
require_once 'config.php';
require_once 'db_config.php';
require_once 'functions.php';
//require '../vendor/autoload.php';

$pdo = connectDatabase($dsn, $pdoOptions);
$referer = $_SERVER['HTTP_REFERER'];
$action = $_POST["action"];


if ($action != "" AND in_array($action, $actions) AND strpos($referer, SITE) === false) {


    switch ($action) {
        case "login":
            $username = trim($_POST["loginUsername"]);
            $password = trim($_POST["loginPassword"]);
//

            if (!empty($username) AND !empty($password)) {

                $data = checkUserLogin($username, $password);
                //var_dump($username, $password);die();

            }

                if ($data AND is_int($data['user_id'])) {
//                    // session_regenerate_id();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $data['user_id'];
                    $_SESSION['permission'] = $data['permission'];
                    redirection('../pages/index.php');
                }
              else {
                    redirection('login.php?l=1');
                }
//
//            } else {
//                redirection('register.php?l=1');
            //
            break;


        case "register":

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

            if (isset($_POST['email'])) {
                $email = trim($_POST["email"]);
            }

            if (isset($_POST['address'])) {
                $address = trim($_POST["address"]);
            }
            if (empty($username)) {
                redirection('../pages/register.php?r=4');
            }

            //var_dump($username, $address, $name, $email, $password); die();
            if (empty($_POST['address'])) {
                redirection('../pages/register.php?r=4');
            }

            if (empty($name)) {
                redirection('../pages/register.php?r=4');
            }

            if (empty($password) OR strlen($password) < 7) {
                redirection('../pages/register.php?r=9');
            }

            if (empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirection('../pages/register.php?r=8');
            }

            if (!existsUser($username)) {
                $code = createCode(40);
                $user_id = registerUser($username, $password, $name, $address, $email, $code);
                if (sendData($username, $email, $code)) {
                    redirection("../pages/register.php?r=3");
                } else {
                    addEmailFailure($user_id);
                    redirection("../pages/register.php?r=10");
                }

            } else {
                redirection('../pages/register.php?r=2');
            }

            break;

        case "forget" :
            // To do
            break;

        default:
            redirection('../pages/register.php?l=0');
            break;
    }

} else {
    echo 'nem men bele';
    //redirection('../pages/register.php');
}
