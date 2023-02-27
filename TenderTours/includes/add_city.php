<?php
require 'db_config.php';
require 'config.php';
require 'functions.php';

if (isset($_POST['city'])){
    $city = trim($_POST["city"]);
}
if (isset($_POST['lattitude'])){
    $lattitude = trim($_POST["lattitude"]);
}
if (isset($_POST['longitude'])){
    $longitude = trim($_POST["longitude"]);
}
if (!empty($city) OR !empty($lattitude) OR !empty($longitude)){
    $city_id = addCity($city, $lattitude, $longitude);
    redirection('../add_city.php?r=12');

}
else{
    redirection('../add_city.php?r=4');

}