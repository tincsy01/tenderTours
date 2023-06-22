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

</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<body>
<?php
include '../includes/header.php';
include '../ajax/maps.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
require_once '../ajax/ajax_helpers.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$user_id = $_SESSION['user_id'];
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

    $(document).ready(function() {
        $.ajax({
            url: "../ajax/get_comments.php",
            method: "GET",
            dataType: "json",
            data: {
                attraction_id: <?php echo $_GET['attraction_id']; ?>
            },
            success: function(response) {
                if (response.success) {
                    var comments = response.comments;

                    // Kommentek kilistázása
                    var commentsList = '<ul>';
                    for (var i = 0; i < comments.length; i++) {
                        var comment = comments[i];
                        commentsList += '<li>' + comment.comment + '</li>'; // Módosítás: comment.comment
                    }
                    commentsList += '</ul>';

                    $('#comments').html(commentsList);
                } else {
                    console.error("Failed to load comments.");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", error);
            }
        });

        // Ellenőrzés, hogy a felhasználó már volt-e az attrakciónál
        $.ajax({
            url: "../ajax/check_visit.php",
            method: "GET",
            dataType: "json",
            data: {
                user_id: <?php echo $_SESSION['user_id']; ?>,
                attraction_id: <?php echo $_GET['attraction_id']; ?>
            },
            success: function(response) {
                if (response.visited) {
                    // Felhasználó már volt az attrakciónál, lehetőség a komment írására
                    var commentForm = '<form id="comment-form" method="post" action="../ajax/add_comment.php">';
                    commentForm += '<textarea name="comment" placeholder="Write your comment..."></textarea>';
                    commentForm += '<input type="hidden" name="attraction_id" value="<?php echo $_GET['attraction_id']; ?>">'
                    commentForm += '<button type="submit">Submit</button>';
                    commentForm += '</form>';

                    $('#comment-section').html(commentForm);
                } else {
                    // Felhasználó még nem volt az attrakciónál, nem lehet kommentet írni
                    var notVisitedMessage = '<p>You need to visit this attraction to be able to leave a comment.</p>';

                    $('#comment-section').html(notVisitedMessage);
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
        <div class="row attractionOnly col-lg-10 col-sm-8 col-xs-8">
            <div class="attractionImage col-lg-4 col-sm-4 col-xs-4">
                <?php
                $attraction_id = $_GET['attraction_id'];
                $sql = "SELECT image FROM attractions WHERE attraction_id = :attraction_id";
                $query = $pdo->prepare($sql);
                $query->bindValue(':attraction_id', $attraction_id);
                $query->execute();
                $image = $query->fetchColumn();
                ?>
                <img src="../images/attractions/<?php echo $image; ?>" alt="Attraction image">
            </div>
            <div id="attraction" class="col-lg-6 col-sm-6 col-xs-6">
                <?php


                if (isAttractionInFavorites($pdo, $user_id, $attraction_id)) {
                    // Az attrakció már hozzá van adva a kedvencekhez
                    echo '<div class="attraction-name">' . getAttractionName($pdo, $attraction_id) . '</div>';
                    echo '<div class="favourit-button">';
                    echo '<button type="button" class="btn btn-primary deleteFromFavourites" data-attraction-id="' . $attraction_id . '">Delete from favourites</button>';
                    echo '</div>';
                    echo '<div class="favourit-button" style="display:none;">';
                    echo '<button type="button" class="btn btn-primary addToFavourites" data-attraction-id="' . $attraction_id . '">Add to favourites</button>';
                    echo '</div>';
                } else {
                    // Az attrakció még nincs hozzáadva a kedvencekhez
                    echo '<div class="attraction-name">' . getAttractionName($pdo, $attraction_id) . '</div>';
                    echo '<div class="favourit-button">';
                    echo '<button type="button" class="btn btn-primary addToFavourites" data-attraction-id="' . $attraction_id . '">Add to favourites</button>';
                    echo '</div>';
                    echo '<div class="favourit-button" style="display:none;">';
                    echo '<button type="button" class="btn btn-primary deleteFromFavourites" data-attraction-id="' . $attraction_id . '">Delete from favourites</button>';
                    echo '</div>';
                }

                echo '<div class="attraction-description">' . getAttractionDescription($pdo, $attraction_id) . '</div>';

                ?>

            </div>
            <div id="map" style="height: 400px;" class="col-lg-4 col-sm-4 col-xs-4"></div>
            <div id="comments"></div>
            <div id="comment-section" class="col-lg-4 col-sm-4 col-xs-4"></div>

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
