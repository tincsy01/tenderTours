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
<!--    <script async defer src="https://maps.googleapis.com/maps/api/js?AIzaSyDdM9r54y8zfnzG36y0JMpayRCyQj1TU2o&callback=initMap"></script>-->
</head>
<body>
<script>
    // Létrehozzuk a térkép objektumot
    function initMap() {
        // Kezdő pozíció beállítása (például Budapest)
        var initialPosition = {lat: 47.4979, lng: 19.0402};

        // Térkép létrehozása és megjelenítése a "map" elemen belül
        var map = new google.maps.Map(document.getElementsByClassName('map'), {
            center: initialPosition,
            zoom: 12
        });

        // AJAX hívás a látványosságok lekérdezéséhez az adatbázisból
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../ajax/tour_parameters.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // JSON válasz feldolgozása
                var attractions = JSON.parse(xhr.responseText);
                if (attractions.success) {
                    var attractionsData = attractions.attractions;

                    // Látványosságok pontjainak megjelenítése a térképen
                    for (var i = 0; i < attractionsData.length; i++) {
                        var attraction = attractionsData[i];
                        var position = {lat: parseFloat(attraction.lattitude), lng: parseFloat(attraction.longitude)};
                        var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: attraction.name
                        });
                    }
                }
            }
        };
        xhr.send();
    }
</script>

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
            <div style="height: 400px;" class="map col-lg-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>
</div>


<?php
require_once '../includes/footer.php';
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?AIzaSyDdM9r54y8zfnzG36y0JMpayRCyQj1TU2o&callback=initMap"></script>


<!-- Scripts -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>