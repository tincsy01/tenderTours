<?php
session_start();
require_once 'config.php';
require_once 'db_config.php';
require '../vendor/autoload.php';
$pdo = connectDatabase($dsn, $pdoOptions);

/*Regisztracio*/
if (isset($_POST['register_button'])){
    if (isset($_POST['name']) and !empty($_POST['name']) and
        isset($_POST['email']) and !empty($_POST['email']) and
        isset($_POST['username']) and !empty($_POST['username']) and
        isset($_POST['address']) and !empty($_POST['address']) and
        isset($_POST['password']) and !empty($_POST['password']))
    {


        $sql = "INSERT INTO users
        (name, username, email, password, address, reg_expire)
         VALUES
        (:name,:username,:email, :password, :address, :reg_expire)";

        $query = $pdo->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $reg_expire = date("Y-m-d h:i:sa");
        //        $reg_expire = mktime("Time + 1 day");
        $query->execute();
        var_dump("ok");
        if(isset($_POST['image'])){
            /* kep feltoltese ide kerul*/
        }


    }
}
