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

    if ($row_count > 0){
        return true;

    }
    else{
        return false;
    }

}
function existsEmail($email)
{
    global $pdo;

    $sql = $pdo->prepare("SELECT user_id FROM users WHERE email = :email AND (reg_expire > NOW() OR active = '0')");
    $sql->bindParam(':email', $email);
    $sql->execute();
    $row_count = $sql->fetchColumn();

    if ($row_count > 0) {
        return true;
    } else {
        return false;
    }

}
function existCity($city){
    global $pdo;

    $sql = $pdo->query("SELECT city_name FROM cities
            WHERE city_name = '$city' ");

    $sql->execute();
    $row_count = $sql->fetchColumn();

    if ($row_count > 0)
        return true;
    else
        return false;
}

function existsOrganization($name)
{
    global $pdo;

//    $sql = "SELECT user_id FROM users
//            WHERE username = '$username' AND (reg_expire>now() OR active ='1')";
    $sql = "SELECT org_name FROM organizations
            WHERE org_name = '$name'";
    $query = $pdo->prepare($sql);
//    $result = $query->fetch();

    $query->execute();
    $row_count = $query->fetchColumn();

    //$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($row_count > 0)
        return true;
    else
        return false;

}

/** Letezo latvanyossag kiszurese
 * @param $city
 * @param $attraction
 * @param $longitude
 * @param $lattitude
 * @return bool
 */
function existAtrraction($city, $attraction, $longitude, $lattitude): bool
{
    global $pdo;

    $sql = "SELECT name, longitude, lattitude, city_id FROM attractions WHERE name = '$attraction' AND longitude = '$longitude'
            AND lattitude = '$lattitude' AND city_id = $city";
    $query = $pdo->prepare($sql);
    $query->execute();
    $row_count = $query->fetchColumn();
    if ($row_count > 0)
        return true;
    else
        return false;

}


/**
 * @param $category
 * @param $attraction
 * @param $longitude
 * @param $lattitude
 * @param $org_id
 * @param $description
 * @param $address
 * @param $newFileName
 * @return void
 */
function insertAttraction($category, $attraction, $longitude, $lattitude, $org_id, $description, $address, $newFileName){
    global $pdo;
    $sql1 = "SELECT city_id FROM organizations  WHERE org_id = :org_id";
    $query1 = $pdo->prepare($sql1);
    $query1->bindParam(':org_id', $org_id, PDO::PARAM_STR);
    $query1->execute();
    $city_id = $query1->fetch(PDO::FETCH_ASSOC)['city_id'];

    $sql2 = "INSERT INTO attractions (name, lattitude, longitude, category_id, org_id, city_id, description, address, image) VALUES (:name, :lattitude, :longitude, :category_id, :org_id, :city_id, :description, :address, :image)";
    $query2 = $pdo->prepare($sql2);
    $query2->bindParam(':name', $attraction, PDO::PARAM_STR);
    $query2->bindParam(':lattitude', $lattitude, PDO::PARAM_STR);
    $query2->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    $query2->bindParam(':category_id', $category, PDO::PARAM_STR);
    $query2->bindParam(':description', $description, PDO::PARAM_STR);
    $query2->bindParam(':address', $address, PDO::PARAM_STR);
    $query2->bindParam(':org_id', $org_id, PDO::PARAM_STR);
    $query2->bindParam(':city_id', $city_id, PDO::PARAM_INT);
    $query2->bindParam(':image', $newFileName, PDO::PARAM_STR);
    $query2->execute();


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
    $permission = 2;
    $sql = "INSERT INTO users
        (name, username, email, password, address, reg_expire, active, code, permission)
         VALUES
        (:name,:username,:email, :password, :address, :reg_expire, :active, :code, :permission)";

    $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
    $active = 0;
    $datetime = new DateTime('tomorrow');
    $reg_expire= $datetime->format('Y-m-d H:i:s');

    $query = $pdo->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
    $query->bindParam(':active', $active, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':permission', $permission, PDO::PARAM_STR);

    $query->execute();
    //var_dump("ok");

}


/**
 * Function tries to send email with activation code
 * Regisztraciohoz
 *
 * @param $email
 * @param $code
 * @return bool
 */
function sendData($email, $code)
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
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
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
        return true;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
    //return mail($to, $subject, $message, $header);
}

function sendEmail($email, $subject, $message) {
    require 'path/to/PHPMailer/PHPMailer.php';
    require 'path/to/PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    // Email küldő beállítások
    //$mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'em.stud.vts.su.ac.rs'; // Az SMTP szerver címe
    $mail->SMTPAuth = true;
    $mail->Username   = 'em';                     //SMTP username
    $mail->Password   = 'h3waxBgfAQHM6dk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('kriszta@em.stud.vts.su.ac.rs', 'Mailer');
    $mail->addAddress($_POST['email'], 'User');     //Add a recipient

    // Email tartalmának beállítása
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Email küldése
    if ($mail->send()) {
        return true; // Sikeres email küldés
    } else {
        return false; // Sikertelen email küldés
    }
}

function addEmailFailure($user_id)
{

    global $pdo;

//    $sql = "INSERT INTO user_email_failure (user_id, date_time_added)
//             VALUES (:user_id, :date_time_added)";
//
//    $query = $pdo->prepare($sql);
//
//    $user_id = $_POST['user_id'];
//    $date_time_added = date("Y-m-d h:i:sa");
//
//    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
//    $query->bindParam(':date_time_added', $date_time_added, PDO::PARAM_STR);
//
//
//
//    $query->execute();
echo 'email failure';
    //$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

}



function registerOrganization($name, $city, $username,$email, $password, $phone, $address, $description, $code){
    global $pdo;
    if (isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['city']) AND !empty($_POST['city']) AND
        isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['username']) AND !empty($_POST['username']) AND
        isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['phone']) AND !empty($_POST['phone']) AND
        isset($_POST['description']) AND !empty($_POST['description']) AND isset($_POST['address']) AND !empty($_POST['address'])) {

        $sql1 = "UPDATE cities SET organization_name = :org_name WHERE city_name = :city_name";
        $query1 = $pdo->prepare($sql1); // másik változó nevet használunk

        $query1->bindParam(':org_name', $name, PDO::PARAM_STR);
        $query1->bindParam(':city_name', $city, PDO::PARAM_STR);
        $query1->execute();

// a city_id lekérdezésekor nincs szükség prepare-re, elég a query-t futtatni
        $sql2 = "SELECT city_id FROM cities WHERE city_name = '$city'";
        $query2 = $pdo->query($sql2);
        $city_id = $query2->fetchColumn(); // a city_id-nek egyetlen értéket adunk át, ezért fetchColumn-t használunk

        $sql3 = "INSERT INTO organizations(org_name, city_id, username, email, password, phone, address, description, code, reg_expire) VALUES
                (:org_name, :city_id,  :username, :email, :password, :phone, :address , :description, :code, :reg_expire)";

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        $active = 0;
        $datetime = new DateTime('tomorrow');
        $reg_expire= $datetime->format('Y-m-d H:i:s');

        $query3 = $pdo->prepare($sql3);
        $query3->bindParam(':org_name', $name, PDO::PARAM_STR);
        $query3->bindParam(':city_id', $city_id, PDO::PARAM_INT); // a city_id egy integer érték, ezért PARAM_INT
        $query3->bindParam(':username', $username, PDO::PARAM_STR);
        $query3->bindParam(':email', $email, PDO::PARAM_STR);
        $query3->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
        $query3->bindParam(':address', $address, PDO::PARAM_STR);
        $query3->bindParam(':description', $description, PDO::PARAM_STR);
        $query3->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query3->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
        $query3->bindParam(':code', $code, PDO::PARAM_STR);

        $query3->execute();
//        $sql1 = "UPDATE cities SET organization_name = :org_name WHERE city_name = :city_name";
//        $query = $pdo->prepare($sql1);
//
//        $query->bindParam(':org_name', $name, PDO::PARAM_STR);
//        $query->bindParam(':city_name', $city, PDO::PARAM_STR);
//        $query->execute();


//        $sql2 = "SELECT city_id FROM cities WHERE city_name = '$city'";
//        $query = $pdo->prepare($sql2);
//        $city_id = $query->execute();
//        $query->execute();

//        $sql3 = "INSERT INTO organizations(org_name, city_id, username, email, password, phone, address, description, code, reg_expire) VALUES
//                            (:org_name, :city_id,  :username, :email, :password, :phone, :address , :description, :code, :reg_expire)";
//
//        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
//        $active = 0;
//        $datetime = new DateTime('tomorrow');
//        $reg_expire= $datetime->format('Y-m-d H:i:s');
//        $city_id = $pdo->lastInsertId();
//
//        $query = $pdo->prepare($sql3);
//        $query->bindParam(':org_name', $name, PDO::PARAM_STR);
//        $query->bindParam(':city_id', $city_id, PDO::PARAM_STR);
//        $query->bindParam(':username', $username, PDO::PARAM_STR);
//        $query->bindParam(':email', $email, PDO::PARAM_STR);
//        $query->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
//        $query->bindParam(':address', $address, PDO::PARAM_STR);
//        $query->bindParam(':description', $description, PDO::PARAM_STR);
//        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
//        $query->bindParam(':reg_expire', $reg_expire, PDO::PARAM_STR);
        //$query->bindParam(':active', $active, PDO::PARAM_STR); mar eleve kommentelve volt
//        $query->bindParam(':code', $code, PDO::PARAM_STR);
//
//        $query->execute();

        //var_dump($name, $city,$city_id, $username, $email,$passwordHashed, $address,$description, $phone, $reg_expire, $code   );die();
    }
}
function addCity($city, $lattitude, $longitude, $newFileName){
    global $pdo;
    $checked = 1;
    $sql = "INSERT INTO cities (city_name, longitude, lattitude, image, checked) VALUES (:city, :longitude, :lattitude, :image, :checked)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':city', $city);
    $query->bindParam(':longitude', $longitude);
    $query->bindParam(':lattitude', $lattitude);
    $query->bindParam(':image', $newFileName);
    $query->bindParam(':checked', $checked);
    $query->execute();


}



//Belepes felhasznaloknak meg szervezeteknek
function checkUserLogin($username, $password){
    global $pdo;

    $sql = "SELECT user_id, password, permission FROM users WHERE username = :username AND permission = 2 AND active = 1";

    $query = $pdo->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
//    $query->bindParam(':permission', $permission, PDO::PARAM_INT);
    $query->execute();

    $data =  [];
    if ($query->rowCount() > 0) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data['user_id'] = (int)$row['user_id'];
            $registeredPassword = $row['password'];
            $data['permission'] = $row['permission'];
        }

        if (!password_verify($password, $registeredPassword)) {
            $data = [];
        }
    }
    else{
        $sql = "SELECT org_id, password, permission FROM organizations WHERE username = :username AND permission = 3 AND active = 1";
        $query = $pdo->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data['user_id'] = (int)$row['org_id'];
            $registeredPassword = $row['password'];
            $data['permission'] = $row['permission'];
        }

        if (!password_verify($password, $registeredPassword)) {
            $data = [];
        }
    }
    return $data;

}

/*Modositas a latvanyossagokra*/
/**
 * @param $attraction_id
 * @param $name
 * @param $longitude
 * @param $lattitude
 * @return void
 */
function updateAttraction($attraction_id, $name, $longitude, $lattitude){
    global $pdo;
    $sql = "UPDATE attractions SET name = :name, longitude = :longitude, lattitude = :lattitude 
                   WHERE attraction_id = :attraction_id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':longitude', $longitude);
    $query->bindValue(':lattitude', $lattitude);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();
    //return json_encode(['success'=> true, 'msg'=> 'Updated successfully']);
}

function deleteAttraction($attraction_id){
    global $pdo;
    $sql = "DELETE * FROM attractions WHERE attraction_id = :attraction_id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();
    return json_encode(['success' => true, 'msg' => 'Deleted successfully']);

}
function deleteOrganization($org_id){
    global $pdo;
    $sql1 = "DELETE FROM organizations WHERE org_id = :org_id ";
    $query = $pdo->prepare($sql1);
    $query->bindValue(':org_id', $org_id);
    $query->execute();

    $sql2 = "DELETE FROM attractions WHERE org_id = :org_id";
    $query = $pdo->prepare($sql2);
    $query->bindValue(':org_id', $org_id);
    $query->execute();

    $sql2 = "DELETE organization_name FROM cities WHERE org_id = :org_id";
    $query = $pdo->prepare($sql2);
    $query->bindValue(':org_id', $org_id);
    $query->execute();

    return json_encode(['success' => true, 'msg' => 'Deleted successfully']);

}
function updateOrganization($org_id, $name, $banning, $visible) {
    global $pdo;
    $sql = "UPDATE organizations SET org_name = :name, active = :banning, status = :visible WHERE org_id = :org_id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':banning', $banning);
    $query->bindValue(':visible', $visible);
    $query->bindValue(':org_id', $org_id);
    $query->execute();
    return json_encode(['success' => true, 'msg' => 'Updated successfully']);
}
function updateUser($user_id, $banning){
    global $pdo;
    $sql = "UPDATE users SET active = :banning WHERE user_id = :user_id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':banning', $banning);
    $query->bindValue(':user_id', $user_id);
    $query->execute();
    return json_encode(['success'=> true, 'msg'=> 'Updated successfully']);
}

function insertTour($city_id, $selected_attractions, $date, $time){
    global $pdo;
    $user_id = $_SESSION['user_id'];
    $datetime = date('Y-m-d H:i:s', strtotime("$date $time"));
    $sql1 = "INSERT INTO tours(city_id, user_id, date) VALUES (:city_id, :user_id, :date)";
    $query1 = $pdo->prepare($sql1);
    $query1->bindParam(':city_id', $city_id);
    $query1->bindParam(':user_id', $user_id);
    $query1->bindParam(':date', $datetime);
    $query1->execute();

    $tour_id = $pdo->lastInsertId();
    foreach ($selected_attractions as $value){
        $attraction_id = $value;

        $sql2 = "INSERT INTO tour_attraction(tour_id, attraction_id) VALUES (:tour_id, :attraction_id)";
        $query2 = $pdo->prepare($sql2);
        $query2->bindParam(':tour_id', $tour_id);
        $query2->bindParam(':attraction_id', $attraction_id);
        $query2->execute();

        $sql3 = "UPDATE attractions SET num_of_visitors = num_of_visitors + 1 WHERE attraction_id = :attraction_id";
        $query3 = $pdo->prepare($sql3);
        $query3->bindParam(':attraction_id', $attraction_id);
        $query3->execute();
    }
}

function forgot_password($email){
    global $pdo;

    if (existsEmail($email)) {
        // Generáljon egy új jelszót
        $newPassword = generatePassword();

        // Módosítsa az adatbázisban a felhasználó jelszavát
        changePassword($email, $newPassword);

        // Elküldi az új jelszót az email címre
        if (sendPasswordResetEmail($email, $newPassword)) {
            // Sikeresen elküldte az emailt
            return true;
        } else {
            // Sikertelen volt az email küldése
            return false;
        }
    } else {
        // Az email cím nem található az adatbázisban
        return false;
    }
}

function sendPasswordResetEmail($email, $newPassword) {
    // Az aktivációs kód generálása
    $activationCode = createCode(40);

    // Az új jelszó és az aktivációs kód beágyazása a linkbe
    $resetLink = SITE . "reset_password.php?code=" . $activationCode;

    // Az email küldése
    $subject = "Change your password";
    $message = "Click the link below to set a new password: <a href='$resetLink'>$resetLink</a>";

    if (sendEmail($email, $subject, $message)) {
        // Sikeres email küldés
        return true;
    } else {
        // Sikertelen email küldés
        return false;
    }
}
