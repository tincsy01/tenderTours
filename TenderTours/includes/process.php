<?php
require_once 'config.php';
require_once 'db_config.php';
require_once 'functions.php';

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

            }

//                if ($data AND is_int($data['user_id'])) {
                if (isset($data)) {
//                    var_dump($username, $password);die();
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $data['user_id'];
                    if (array_key_exists('permission', $data)) {
                        $_SESSION['permission'] = $data['permission'];
                    }
//                    $_SESSION['permission'] = $data['permission'];

                    redirection('../pages/index.php');
                }
              else {
                    redirection('login.php?r=1');
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
            $image = $_FILES['image'];
            $newFileName = "";
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

            if(!empty($image['name'])){
                // Check if uploaded file is an image
                $image_info = getimagesize($image['tmp_name']);
                if (!$image_info) {
                    header("Location:make_attractions.php?r=16");
                    exit();
                }
                // Valid image format
                $valid_formats = ["jpg", "jpeg", "png", "gif"];
                $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $valid_formats)) {
                    header("Location:make_attractions.php?r=16");
                    exit();
                }
                // Valid image size
                $max_size = 1024*1024; // 1MB
                if ($image['size'] > $max_size) {
                    header("Location:make_attractions.php?r=16");
                    exit();
                }

                $directory = "../images/attractions/";
                $newFileName = time() . '-' . $attraction. '-' . mt_rand(10, 100) . '.' . $extension;

                if (!move_uploaded_file($image['tmp_name'], $directory . $newFileName)) {
                    header("Location:make_attractions.php?r=16");
                    exit();
                }
            }

            if(empty($_POST['attraction']) OR empty($_POST['category_id']) OR empty($_POST['longitude']) OR empty($_POST['lattitude']) OR empty($_POST['description']) OR empty($_POST['address'])){
                redirection('../pages/make_attraction.php?r=4');
            } else {
                if(!existAtrraction($category, $attraction, $longitude, $lattitude)) {
                    $attraction_id = insertAttraction($category, $attraction, $longitude, $lattitude, $org_id, $description, $address, $newFileName);
                    redirection('../pages/make_attraction.php?r=15');
                } else {
                    redirection('../pages/make_attraction.php?r=14');
                }
            }
            break;
        case "update_attraction":
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
        case "update_organization_admin":

            $org_id = $_POST['org_id'];
            if(isset($_POST['name'])){
                $name = $_POST['name'];
            }
            if(isset($_POST['banning'])){
                $banning = $_POST['banning'];
            }
            if(isset($_POST['visible'])){
                $visible = $_POST['visible'];
            }
            $data = updateOrganization($org_id,$name,$banning, $visible );
            break;
        case "make_tour":
            $city_id = $_POST['city'];
            $date = $_POST['date'];
            $time = $_POST['time'];
           // var_dump( $_POST['city'], $_POST['date'],$_POST['time'], $_POST['attraction_ids']);die();
            if(isset($_POST['attraction_ids'])){
                $selected_attractions = array();
                foreach ($_POST['attraction_ids'] as $value) {
                    $selected_attractions[] = $value;
                }
            }
//            var_dump( $city_id, $date,$time, $selected_attractions);die();
            if(empty($city_id) OR  empty($date) OR empty($time) OR empty($selected_attractions)){
                //var_dump( $city_id, $date,$time, $selected_attractions);die();
                redirection('../pages/make_tour.php?r=4');
            }

            else{
                $data = insertTour($city_id, $selected_attractions,$date, $time);
                redirection('../pages/make_tour.php?r=17');
            }

            //var_dump($selected_attractions); die();
            break;

        case "forget" :
            // To do
            break;

        default:
            redirection('../pages/index.php');
            break;
    }

} else {
    echo 'nem megy bele';
    //var_dump($action);
    //var_dump($_POST['action'],$_POST['name'],$_POST['banning'], $_POST['visible'] );die();

    //redirection('../pages/register.php');
}
