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
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>
<body>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>
<script >

    function redirectToTourPage(tourId) {
        window.location.href = 'tour_data.php?tour_id=' + tourId;
    }

    function getTours() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../ajax/get_tours.php');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var tours = JSON.parse(xhr.responseText);
                var toursList = document.querySelector('.tours-list');
                toursList.innerHTML = '';
                for (var i = 0; i < tours.length; i++) {
                    var tour = tours[i];
                    var tourElement = document.createElement('div');
                    tourElement.setAttribute('class', 'tour');
                    var cityHeader = document.createElement('h2');
                    cityHeader.textContent = tour.city_name;
                    cityHeader.setAttribute('data-tour-id', tour.tour_id);
                    cityHeader.addEventListener('click', function() {
                        var tourId = this.getAttribute('data-tour-id');
                        redirectToTourPage(tourId);
                    });
                    tourElement.appendChild(cityHeader);
                    var tourId = document.createElement('p');
                    tourId.textContent = 'Tour ID: ' + tour.tour_id;
                    tourElement.appendChild(tourId);
                    var date = document.createElement('p');
                    date.textContent = 'Date and time: ' + tour.date;
                    tourElement.appendChild(date);
                    var attractionsHeader = document.createElement('p');
                    attractionsHeader.textContent = 'Attractions:';
                    tourElement.appendChild(attractionsHeader);
                    var attractionsList = document.createElement('ul');
                    var attractions = tour.attractions;
                    for (var j = 0; j < attractions.length; j++) {
                        var attraction = attractions[j];
                        var attractionItem = document.createElement('li');
                        attractionItem.textContent = attraction.name;
                        attractionsList.appendChild(attractionItem);
                    }
                    tourElement.appendChild(attractionsList);
                    toursList.appendChild(tourElement);
                }
            } else {
                console.error('Hiba történt: ' + xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Hiba történt az AJAX kérés során');
        };
        xhr.send();
    }

    window.onload = function() {
        getTours();
    };
</script>

<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>Tours archive</h2>
                </div>
            </div>
            <div class="tours-list"></div>
        </div>
    </div>
</div>
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
