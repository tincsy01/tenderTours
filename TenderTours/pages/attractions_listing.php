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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--    <script src="../assets/js/attraction_listing.js"></script>-->
</head>
<body>
<?php
include '../includes/header.php';
include '../ajax/maps.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

<script>
    $(document).ready(function() {
        $.ajax({
            url: "../ajax/get_attractionlist.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    var attractions = response.attractions;

                    // Attractions table
                    var table = '<table class="table table-striped">';
                    table += '<thead>';
                    table += '<tr>';
                    table += '<th scope="col">Name of attraction</th>';
                    table += '<th scope="col">Number of visitors</th>';
                    table += '<th scope="col">Popularity</th>';
                    table += '<th scope="col">Type</th>';
                    table += '</tr>';
                    table += '</thead>';
                    table += '<tbody>';

                    for (var i = 0; i < attractions.length; i++) {
                        var attraction = attractions[i];
                        table += '<tr>';
                        table += '<td><a href="attraction.php?attraction_id=' + attraction.attraction_id + '">' + attraction.name + '</a></td>';
                        table += '<td>' + attraction.num_of_visitors + '</td>';
                        table += '<td>' + attraction.popular + '</td>';
                        table += '<td>' + attraction.category + '</td>';
                        table += '</tr>';
                    }
                    table += '</tbody>';
                    table += '</table>';

                    $('#allAttraction').html(table);
                } else {
                    console.error("Failed to load attractions.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", error);
            }
        });
    });
</script>

<div class="main-banner">
    <div class="container">
        <div class="row table-responsive">
            <div id="allAttraction" class=" attractionOnly table-responsive"></div>
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