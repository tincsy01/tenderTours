<?php
require_once 'config.php';
require_once 'db_config.php';
require_once 'functions.php';

//session_start();

//require '../vendor/autoload.php';

$pdo = connectDatabase($dsn, $pdoOptions);
$referer = $_SERVER['HTTP_REFERER'];
$action = $_POST["action"];

//if(isset($_POST['search'])){
//    $attractionName = isset($_GET['attraction_name']) ? $_GET['attraction_name'] : '';
//    $popularityRating = isset($_GET['popularity_rating']) ? $_GET['popularity_rating'] : '';
//    $numOfVisitors = isset($_GET['num_of_visitors']) ? $_GET['num_of_visitors'] : '';
//
//
//// Keresési lekérdezés összeállítása
//    $sql = "SELECT name, popularity_rating, num_of_visitors FROM attractions WHERE 1=1";
//    $params = array();
//    if (!empty($attractionName)) {
//        $sql .= " OR name LIKE :attractionName";
//        $params['attractionName'] = "%$attractionName%";
//    }
//    if (!empty($popularityRating)) {
//        $sql .= " OR popularity_rating LIKE :popularityRating";
//        $params['popularityRating'] = "%$popularityRating%";
//    }
//    if (!empty($numOfVisitors)) {
//        $sql .= " OR num_of_visitors LIKE :numOfVisitors";
//        $params['numOfVisitors'] = "%$numOfVisitors%";
//    }
//
//    $query = $dbh->prepare($sql);
//    $query->execute($params);
//
//// Eredmények visszaadása JSON formátumban
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//    echo json_encode($results);
//}


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
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $data['user_id'];
                    if (array_key_exists('permission', $data)) {
                        $_SESSION['permission'] = $data['permission'];
                    }
                    //$_SESSION['permission'] = $data['permission'];

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
        case "make_attraction":
            $org_id = $_SESSION['user_id'];
            if(isset($_POST['attraction'])){
                $attraction = trim($_POST['attraction']);
            }
            if(isset($_POST['category_id'])){
                $category = trim($_POST['category_id']);
            }
            if(isset($_POST['longitude'])){
                $longitude = trim($_POST['longitude']);
            }
            if(isset($_POST['lattitude'])){
                $lattitude = trim($_POST['lattitude']);
            }
            if(isset($_POST['description'])){
                $description = trim($_POST['description']);
            }
            if(isset($_POST['address'])){
                $address = trim($_POST['address']);
            }

            if(empty($_POST['attraction']) OR empty($_POST['category_id']) OR empty($_POST['longitude']) OR empty($_POST['lattitude']) OR empty($_POST['description']) OR empty($_POST['address'])){

                redirection('../pages/make_attraction.php?r=4');
            }
            else{
                if(!existAtrraction($category, $attraction, $longitude, $lattitude)) {
                    $attraction_id= insertAttraction($category, $attraction, $longitude, $lattitude, $org_id, $description, $address);
                    redirection('../pages/make_attraction.php?r=15');

                }
                else{
                    redirection('../pages/make_attraction.php?r=14');
                }
            }
            break;
        case "update_attraction":
            //var_dump("Akarmi",$_POST['name'], $_POST['attraction_id'], $_POST['lattitude'], $_POST['longitude']);die();

            $attraction_id = $_POST['attraction_id'];
            if(isset($_POST['name'])){
                $name = $_POST['name'];
            }
            if(isset($_POST['longitude'])){
                $longitude = $_POST['longitude'];
            }
            if(isset($_POST['lattitude'])){
                $lattitude = $_POST['lattitude'];
            }
            $data = updateAttraction($attraction_id, $name, $longitude, $lattitude);
            echo json_encode(['success'=> true, 'msg'=> 'Updated successfully']);
            break;
        case "delete_attraction":
            //var_dump($_POST['attraction_id']);die();
            $attraction_id = $_POST['attraction_id'];
            if(isset($attraction_id)){
                //$attraction_id = $_POST['attraction_id'];
                $data = deleteAttraction($attraction_id);
            }
            break;
        case "forget" :
            // To do
            break;

        default:
            redirection('../pages/index.php');
            break;
    }

} else {
    echo 'nem men bele';
    //redirection('../pages/register.php');
}
