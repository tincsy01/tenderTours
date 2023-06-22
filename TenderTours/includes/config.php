<?php
define("SITE",'https://localhost/tourist/TenderTours/pages/');
define("SECRET",'gfhUi34xVbds23Qgk');
const PARAMS = [
    "HOST" => 'localhost',
    "USER" => 'root',
    "PASS" => '',
    "DBNAME" => 'tendertours',

];

$dsn = "mysql:host=".PARAMS['HOST'].";dbname=".PARAMS['DBNAME'].";charset=utf8mb4";

$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$actions = ['login', 'register', 'forget', 'make_attraction', 'update_attraction', 'delete_attraction', 'update_organization_admin',
            'make_tour', 'update_user_admin'];

$messages = [
    0 => 'No direct access!',
    1 => 'Unknown user!',
    2 => 'User with this name already exists, choose another one!',
    3 => 'Check your email to active your account!',
    4 => 'Fill all the fields!',
    5 => 'You are logged out!!',
    6 => 'Your account is activated, you can login now!',
    7 => 'Passwords are not equal!',
    8 => 'Format of e-mail address is not valid!',
    9 => 'Password is too short! It must be minimum 8 characters long!',
    10 => 'Something went wrong with mail server. We will try to send email later!',
    11 => 'Your account is already activated!',
    12 => 'The city is added.',
    13 => 'City with this name already exists.',
    14 => 'Attraction with this location and name already exists.',
    15 => 'The attraction is added.',
    16 => 'Something went wrong during image upload. Please try again.',
    17 => 'The tour is added.',
    18 => 'Check your email to change password!',
];