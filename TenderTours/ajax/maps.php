<?php
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
if (isset($_POST['attraction_id'])) {
    $attraction_id = $_POST['attraction_id'];
    $sql = "SELECT attraction_id, longitude, lattitude FROM attractions WHERE attraction_id = :attraction_id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':attraction_id', $attraction_id);
    $query->execute();
    $result = $query->fetchAll();

    $ret = [];
    foreach ($result as $row) {
        $ret[] = [
            "lattitude" => $row['lattitude'],
            "longitude" => $row['longitude']
        ];
    }
    echo json_encode($ret);
}

//require_once '../includes/config.php';
//require_once '../includes/db_config.php';
//$pdo = connectDatabase($dsn, $pdoOptions);
//
//$sql = "SELECT attraction_id,  longitude, lattitude  FROM attractions WHERE attraction_id = :attraction_id";
//$query = $pdo->prepare($sql);
//$query->bindValue(':attraction_id', $attraction_id);
//$result = $query->execute();
//$index = 0;
//$ret = [];
//if($result){
//    while($row = $result->fetchAll()){
//        $ret[$index]["lattitude"] = $row['lattitude'];
//        $ret[$index]["longitude"] = $row['longitude'];
//        ++$index;
//    }
//}
//echo json_encode($ret);
//
//