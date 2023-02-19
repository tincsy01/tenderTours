 <?php

require "../includes/config.php";
require "../includes/db_config.php";
require "../includes/functions.php";

$code = "";

if (isset($_GET['code'])){
    $code = trim($_GET['code']);
}
// gettype($reg_expire); die();
if (!empty($code) AND strlen($code) === 40) {

//    $selectsql = $pdo->query("SELECT reg_expire FROM users WHERE code = :code");
   // $reg_expire = $pdo->prepare($selectsql);


    $sql = "UPDATE users SET active='1', code='', reg_expire=''
            WHERE  code = :code AND reg_expire>now()";
//    var_dump($reg_expire); die();


    $query = $pdo->prepare($sql);


    //$query->bindParam(':reg_expire', $reg_expire,PDO::PARAM_STR);

    //$query->bindParam(':active', $active, PDO::PARAM_INT);
    $query->bindParam(':code', $code, PDO::PARAM_STR);

    //$code = $_GET['code'];

    /* ide lehet kell a definiálás*/
//    $datetime = $reg_expire;
//    $reg_expire= $datetime->format('Y-m-d H:i:s');

    $query->execute();
    $count = $query->fetchAll();
    $query = $pdo->prepare($sql);
    if ($count > 0) {
       redirection('register.php?r=6');
    }
    else {
        redirection('register.php?r=11');
    }

}

else {
    redirection('index.php?r=0');
}