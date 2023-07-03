<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>TenderTours</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
</head>

<body>

<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>
<!--<script>-->
<!--    function getCities() {-->
<!--        $.ajax({-->
<!--            url: "../ajax/get_cities.php",-->
<!--            method: "GET",-->
<!--            dataType: "json"-->
<!--        }).done(function (data) {-->
<!--            insertCities(data);-->
<!--        }).fail(function (err) {-->
<!--            console.log("error");-->
<!--        });-->
<!--    }-->
<!---->
<!--    function insertCities(cities) {-->
<!--        const cityContainer = document.querySelector('.city-container');-->
<!--        var listing = document.getElementById("listing");-->
<!--        for (var i = 0; i < cities.length; i++) {-->
<!--            var city = cities[i];-->
<!--            var item = document.createElement("div");-->
<!--            item.classList.add("listing-item");-->
<!--            item.innerHTML = `-->
<!--                    <div class="left-image">-->
<!--                        <a href="#"><img src="../images/cities/${city.image}" alt="City image"></a>-->
<!--                    </div>-->
<!--                    <div class="right-content align-self-center">-->
<!--                        <a href="city_attraction.php?city_id=${city.city_id}"><h4>${city.city_name}</h4></a>-->
<!--                        <div class="main-white-button">-->
<!--                            <a href="../contact.html"><i class="fa fa-eye"></i> View Now</a>-->
<!--                        </div>-->
<!--                    </div>`;-->
<!--            listing.appendChild(item);-->
<!--        }-->
<!--    }-->
<!---->
<!--    getCities();-->
<!--</script>-->
<script>

    function getCities() {
        $.ajax({
            url: "../ajax/get_cities.php",
            method: "GET",
            dataType: "json" // Itt jelezzük, hogy JSON formátumban várjuk a választ
        }).done(function (data) {
            insertCities(data);
        }).fail(function (err) {
            console.log("error");
        });
    }
    function insertCities(cities) {
        const cityContainer = document.querySelector('.city-container');
        var listing = document.getElementById("listing");
        for (var i = 0; i < cities.length; i++) {
        var city = cities[i];
        var item = document.createElement("div");
        item.classList.add("listing-item");
        item.innerHTML = `
                <div class="left-image">
                    <a href="#"><img src="../images/cities/${city.image}" alt="City image" ></a>
                </div>
                <div class="right-content align-self-center">
                    <a href="city_attraction.php?city_id=${city.city_id}"><h4>${city.city_name}</h4></a>
                    <div class="main-white-button">
                        <a href="../contact.html"><i class="fa fa-eye"></i> View Now</a>
                    </div>
                </div>`;
        listing.appendChild(item);
        }
    }
    getCities();
</script>

<div class="main-banner">
    <div class="recent-listing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Cities</h2>
                        <h6>Check Them Out</h6>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-carousel owl-listing">
                        <div class="item">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div id="listing">

                                    </div>
<!--                                    <div class="listing-item">-->

<!--                                        <div class="left-image">-->
<!--                                            <a href="#"><img src="../budapest.jpg" alt=""></a>-->
<!--                                        </div>-->
<!--                                        <div class="right-content align-self-center">-->
<!--                                            <a href="#"><h4>Budapest</h4></a>-->
                                            <!--                                        <h6>by: Sale Agent</h6>-->
<!--                                            <ul class="rate">-->
<!--                                                <li><i class="fa fa-star-o"></i></li>-->
<!--                                                <li><i class="fa fa-star-o"></i></li>-->
<!--                                                <li><i class="fa fa-star-o"></i></li>-->
<!--                                                <li><i class="fa fa-star-o"></i></li>-->
<!--                                                <li><i class="fa fa-star-o"></i></li>-->
<!--                                                <li>(18) Reviews</li>-->
<!--                                            </ul>-->
<!--                                            <div class="main-white-button">-->
<!--                                                <a href="../contact.html"><i class="fa fa-eye"></i> View Now</a>-->
<!--                                            </div>-->
<!--                                        </div>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php
require_once '../includes/footer.php';
?>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>

</body>
</html>

