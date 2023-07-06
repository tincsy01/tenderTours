<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);


if(isset($_POST['city_id'])){
    $city_id = $_POST['city_id'];
    $sql = "DELETE FROM cities WHERE city_id = :city_id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':city_id', $city_id);
    $query->execute();
    return json_encode(['success' => true, 'msg' => 'Deleted successfully']);
}
else{
    return json_encode(['success' => false, 'msg' => 'Missing cityId']);
}
