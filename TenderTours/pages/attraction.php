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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Libre+Baskerville&display=swap" rel="stylesheet">
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>




<body>
<?php
include '../includes/header.php';
include '../ajax/maps.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>
<script>
    var markers_array = [];
    const center = {lat: 47.4977975, lng: 19.0403225};
    var attraction_id = <?php echo json_encode($_GET['attraction_id']); ?>;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 8
        });
        $.ajax({
            url: "../ajax/maps.php",
            method: "POST",
            data: {
                attraction_id: attraction_id
            },
            dataType: "JSON",
        }).done(function (data) {
            manage_markers(data);
        }).fail(function (err) {
            console.log("error");
        });


    }
    function manage_markers(data) {
        for(var x in data) {
            draw_markers(data[x]);
        }
    }
    function draw_markers(positions) {
        new google.maps.Marker({
            position: {lat: parseFloat(positions['lattitude']), lng: parseFloat(positions['longitude'])},
            map: map
        });
    }
</script>
<div class="main-banner">
    <div class="container">
        <div class="row attractionOnly col-lg-10 col-sm-8 col-xs-8">
<!--            <div class="col-lg-12">-->
<!--                <div class="top-text header-text">-->
<!--                    <h2>List of your attractions</h2>-->
<!--                </div>-->
<!--            </div>-->
            <div id="map" style="height: 400px;" class="col-lg-4 col-sm-4 col-xs-4"></div>

            <div id="attraction" class="col-lg-6 col-sm-6 col-xs-6">
                <?php
                if(isset($_GET['attraction_id'])){
                    $attraction_id = $_GET['attraction_id'];
                    $sql = "SELECT attraction_id, image, popular, address, description, name, longitude, lattitude  FROM attractions WHERE attraction_id = :attraction_id";
                    $query = $pdo->prepare($sql);
                    $query->bindValue(':attraction_id', $attraction_id);
                    $query->execute();
                    $attractions = $query->fetchAll();

                    foreach ($attractions as $attraction){
                        echo '<b><div class="attraction-name">'.$attraction['name'].'</div></b>';
                        echo '<div class="attraction-description">'.$attraction['description'].'</div>';
                    }
                }
                ?>

            </div>
<!--            <div id="map" style="height: 400px"></div>-->

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
<!--<script src="../assets/js/script.js"></script>-->

</body>

</html>
