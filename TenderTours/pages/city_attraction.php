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
require_once '../includes/config.php';
require_once '../includes/db_config.php';
require_once '../ajax/ajax_helpers.php';
$pdo = connectDatabase($dsn, $pdoOptions);
$user_id = $_SESSION['user_id'];
?>
<div class="main-banner">
    <div class="container">
        <?php
        $city_id = $_GET['city_id'];
        $sql = "SELECT name, image, attraction_id FROM attractions WHERE city_id = :city_id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':city_id', $city_id);
        $query->execute();
        $attractions = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($attractions) > 0) {
            foreach ($attractions as $attraction) {
                echo '<div class="attraction-box">';
                echo '<a href="attraction.php?attraction_id=' . $attraction['attraction_id'] . '">';
                echo '<div class="attraction-name">' . $attraction['name'] . '</div>';
                echo '</a>';
                echo '<img src="../images/attractions/' . $attraction['image'] . '" alt="' . $attraction['name'] . '">';
                echo '</div>';
            }
        } else {
            echo 'Nincsenek látnivalók ehhez a városhoz.';
        }
        ?>
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
