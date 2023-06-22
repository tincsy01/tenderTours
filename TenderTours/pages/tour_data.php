<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>TenderTours</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script async defer src="https://maps.googleapis.com/maps/api/js?AIzaSyDdM9r54y8zfnzG36y0JMpayRCyQj1TU2o&callback=initMap"></script>
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>
<body>
<script>
    var markersArray = [];
    const center = {lat: 47.4977975, lng: 19.0403225};
    var tour_id = <?php echo json_encode($_GET['tour_id']); ?>;
    console.log(tour_id);
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 8
        });
        $.ajax({
            url: "../ajax/tour_parameters.php",
            method: "POST",
            data: {
                tour_id: tour_id
            },
            dataType: "JSON",
        }).done(function (data) {
            manageMarkers(data);
        }).fail(function (err) {
            console.log("error");
        });
    }

    function manageMarkers(data) {
        for (var i = 0; i < data.length; i++) {
            drawMarker(data[i]);
        }
    }

    function drawMarker(position) {
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(position['latitude']), lng: parseFloat(position['longitude'])},
            map: map
        });
        markersArray.push(marker);
    }
</script>



<!--<script>-->
<!--    var markers_array = [];-->
<!--    const center = {lat: 47.4977975, lng: 19.0403225};-->
<!--    var tour_id = --><?php //echo json_encode($_GET['tour_id']); ?>//;
//    function initMap() {
//        map = new google.maps.Map(document.getElementById('map'), {
//            center: center,
//            zoom: 8
//        });
//        $.ajax({
//            url: "../ajax/tour_parameters.php",
//            method: "POST",
//            data: {
//                tour_id: tour_id
//            },
//            dataType: "JSON",
//        }).done(function (data) {
//            manage_markers(data);
//        }).fail(function (err) {
//            console.log("error");
//        });
//
//
//    }
//    function manage_markers(data) {
//        for(var x in data) {
//            draw_markers(data[x]);
//        }
//    }
//    function draw_markers(positions) {
//        new google.maps.Marker({
//            position: {lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude'])},
//            map: map
//        });
//    }
//</script>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
include '../ajax/tour_parameters.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$user_id = $_SESSION['user_id'];
?>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>Data of Tour</h2>
                </div>
            </div>
            <div id="map" style="height: 400px;" class="col-lg-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>
</div>

<!--<div class="main-banner">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <div class="top-text header-text">-->
<!--                    <h2>Data of Tour</h2>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="tour_data col-lg-4 col-sm-4 col-xs-4">-->
<!--                --><?php
//                $tour_id = $_GET['tour_id'];
//                $sql = "SELECT a.attraction_id, a.longitude, a.lattitude, t.date FROM attractions a
//                        INNER JOIN tour_attraction ta ON a.attraction_id = ta.attraction_id INNER JOIN tours t ON t.tour_id = ta.tour_id
//                        WHERE ta.tour_id = :tour_id";
//                $query = $pdo->prepare($sql);
//                $query->bindValue(':tour_id', $tour_id);
//                $query->execute();
//
//                $tours = $query->fetchColumn();

                ?>
<!--            </div>-->
<!--            <div id="map" style="height: 400px;" class="col-lg-4 col-sm-4 col-xs-4"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php
require_once '../includes/footer.php';
?>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?AIzaSyDdM9r54y8zfnzG36y0JMpayRCyQj1TU2o&callback=initMap"></script>-->


<!-- Scripts -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>