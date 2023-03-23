
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Make an attraction</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>
<body>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
//var_dump($_SESSION['permission']);
//gettype($_SESSION['permission']);die();
?>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
<!--                    <h6>Make attraction</h6>-->
                    <h2>Make attraction</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <form id="search-form" name="gs" method="submit" role="search" action="#">
                    <div class="row">

<!--                            <div class="input-group">-->
<!--                                <span class="input-group-text">Name of attraction</span>-->
<!--                                <input type="text" aria-label="First name" class="form-control">-->
<!--                            </div>-->
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
<!--                                <label for="attraction">Name of attraction</label>-->
                                <input type="text" id="attraction" name="attraction" class="searchText" placeholder="Attraction name" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
<!--                                <label for="attraction">Name of attraction</label>-->
                                <input type="text" id="city" name="attraction" class="searchText" placeholder="Attraction name" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-3">
                            <fieldset>
                                <button class="main-button"><i class="fa fa-search"></i> Search Now</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
<!--            <div class="col-lg-10 offset-lg-1">-->
<!--                <ul class="categories">-->
<!--                    <li><a href="cities.php"><span class="icon"><img src="../assets/images/search-icon-01.png" alt="Home"></span> Cities</a></li>-->
<!--                    <li><a href="#"><span class="icon"><img src="../assets/images/search-icon-02.png" alt="Food"></span> Restaurants</a></li>-->
                    <!--                    <li><a href="#"><span class="icon"><img src="assets/images/search-icon-03.png" alt="Vehicle"></span> Cars</a></li>-->
                    <!--                    <li><a href="#"><span class="icon"><img src="assets/images/search-icon-04.png" alt="Shopping"></span> Shopping</a></li>-->
<!--                    <li><a href="#"><span class="icon"><img src="../assets/images/search-icon-05.png" alt="Travel"></span> Tours</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</div>


<?php
require_once '../includes/footer.php';
?>

<!-- Scripts -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>

</body>

</html>

