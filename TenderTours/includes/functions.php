<?php
session_start();
require_once 'config.php';
require_once 'db_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


$pdo = connectDatabase($dsn, $pdoOptions);


/**
 * "Atiranyitas masik oldalra"
 *
 * @param string $url
 */
function redirection($url)
{
    header("Location:$url");
    exit();
}


/**
 * Function checks that user exists in users table
 *
 * @param $username
 * @return bool
 */
function existsUser($username)
{
    global $pdo;

//    $sql = "SELECT user_id FROM users
//            WHERE username = '$username' AND (reg_expire>now() OR active ='1')";
    $sql = $pdo->query("SELECT user_id FROM users
            WHERE username = '$username' AND (reg_expire>now() OR active ='0')");
//    $query = $pdo->prepare($sql);
//    $result = $query->fetch();

    $sql->execute();
    $row_count = $sql->fetchColumn();

    //$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($row_count > 0)
        return true;
    else
        return false;
}



/**
 * Kod letrehozo fuggveny
 *
 * @param $length
 * @return string
 */
function createCode($length)
{
    $down = 48;
    $up = 57;
    $i = 0;
    $code = "";

    /*
      48-57  = 0 - 9
      65-90  = A - Z
      97-122 = a - z
    */

    $div = mt_rand(3, 9); // 3

    while ($i < $length) {
        if ($i % $div == 0)
            $character = strtoupper(chr(mt_rand($down, $up)));
        else
            $character = chr(mt_rand($down, $up)); // mt_rand(97,122) chr(98)
        $code .= $character; // $code = $code.$character; //
        $i++;
    }
    return $code;
}


/**
 * Function registers user and returns id of created user
 *
 * @param $username
 * @param $password
 * @param $name
 * @param $address
 * @param $email
 * @param $code
 * @return int
 */
function registerUser($username, $password, $name, $address, $email, $code)
{

    global $pdo;

    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users
        (name, username, email, password, address, reg_expire, active, code)
         VALUES
        (:name,:username,:email, :password, :address, :reg_expire, :active, :code)";

    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
    $query->bindParam(':active', $active, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);


    $name = $_POST['name'];
    $email = $_POST['email'];
    $passwordHashed = $_POST['password'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $active = 0;
    $datetime = new DateTime('tomorrow');
    $reg_expire= $datetime->format('Y-m-d H:i:s');
    //$reg_expire =  //mktime("Today + 1 day");
    $code = $_GET['code'];

    $query->execute();
    //var_dump("ok");

}


/**
 * Function tries to send email with activation code
 *
 * @param $username
 * @param $email
 * @param $code
 * @return bool
 */
function sendData($username, $email, $code)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'em.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'em';                     //SMTP username
        $mail->Password   = 'h3waxBgfAQHM6dk';                               //SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


        //Recipients
        $mail->setFrom('kriszta@em.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($_POST['email'], 'User');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Activation';
        $mail->Body    = "\n\n to activate your account click on the link: " . SITE . "active.php?code=$code";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


    $header = "From: TenderTours <tenderTours@gmail.com>\n";
    $header .= "X-Sender: tenderTours@gmail.com\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $header .= "X-Priority: 1\n";
    $header .= "Reply-To:support@vts.su.ac.rs\r\n";
    $header .= "Content-Type: text/html; charset=UTF-8\n";

    $message = "Data:\n\n user: $username \n \n www.vts.su.ac.rs";
    $message .= "\n\n to activate your account click on the link: " . SITE . "active.php?code=$code";
    $to = $email;
    $subject = "Registration at VTS";
    return mail($to, $subject, $message, $header);
}



function addEmailFailure($user_id)
{

    global $pdo;

    $sql = "INSERT INTO user_email_failure (user_id, date_time_added)
             VALUES (:user_id, :date_time_added)";

    $query = $pdo->prepare($sql);

    $user_id = $_POST['user_id'];
    $date_time_added = mktime("now");

    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->bindParam(':date_time_added', $date_time_added, PDO::PARAM_STR);



    $query->execute();

    //$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

}

//
//if (isset($_POST['register_button'])){
//    if (isset($_POST['name']) and !empty($_POST['name']) and
//        isset($_POST['email']) and !empty($_POST['email']) and
//        isset($_POST['username']) and !empty($_POST['username']) and
//        isset($_POST['address']) and !empty($_POST['address']) and
//        isset($_POST['password']) and !empty($_POST['password']))
//    {
//
//
//        $sql = "INSERT INTO users
//        (name, username, email, password, address, reg_expire)
//         VALUES
//        (:name,:username,:email, :password, :address, :reg_expire)";
//
//        $query = $pdo->prepare($sql);
//        $query->bindParam(':name', $name, PDO::PARAM_STR);
//        $query->bindParam(':username', $username, PDO::PARAM_STR);
//        $query->bindParam(':email', $email, PDO::PARAM_STR);
//        $query->bindParam(':password', $password, PDO::PARAM_STR);
//        $query->bindParam(':address', $address, PDO::PARAM_STR);
//        $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
//
//        $name = $_POST['name'];
//        $email = $_POST['email'];
//        $password = $_POST['password'];
//        $username = $_POST['username'];
//        $address = $_POST['address'];
//        $reg_expire = date("Y-m-d h:i:sa");
//        //        $reg_expire = mktime("Time + 1 day");
//        $query->execute();
//        var_dump("ok");
//        if(isset($_POST['image'])){
//            /* kep feltoltese ide kerul*/
//        }
//
//
//    }
//}
