<?php
require 'db_config.php';
require 'config.php';
require 'functions.php';
$image = $_FILES['image'];
$newFileName = "";
//$referer = $_SERVER['HTTP_REFERER'];
if (isset($_POST['city'])){
    $city = trim($_POST["city"]);
}
if (isset($_POST['lattitude'])){
    $lattitude = trim($_POST["lattitude"]);
}
if (isset($_POST['longitude'])){
    $longitude = trim($_POST["longitude"]);
}
if(!empty($image['name'])) {
    // Check if uploaded file is an image
    $image_info = getimagesize($image['tmp_name']);
    if (!$image_info) {
        header("Location:add_city.php?r=16");
        exit();
    }
    // Valid image format
    $valid_formats = ["jpg", "jpeg", "png", "gif"];
    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $valid_formats)) {
        header("Location:add_city.php?r=16");
        exit();
    }
    // Valid image size
    $max_size = 1024 * 1024; // 1MB
    if ($image['size'] > $max_size) {
        header("Location:add_city.php?r=16");
        exit();
    }

    $directory = "../images/cities/";
    $newFileName = time() . '-' . $city. '-' . mt_rand(10, 100) . '.' . $extension;

    if (!move_uploaded_file($image['tmp_name'], $directory . $newFileName)) {
        header("Location:add_city.php?r=16");
        exit();
    }
}
if (!empty($city) OR !empty($lattitude) OR !empty($longitude)){
    if(!existCity($city)){
//        var_dump($_POST["lattitude"], $_POST['city'], $_POST["longitude"], $_FILES['image']); die();
        $city_id = addCity($city, $lattitude, $longitude, $newFileName);
        redirection('../admin_pages/add_city.php?r=12');
    }
    else{
        redirection('../admin_pages/add_city.php?r=13');
    }
}
else{
    redirection('../admin_pages/add_city.php?r=4');

}