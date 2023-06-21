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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
?>
</script>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>Forgotten password</h2>
                </div>
            </div>
            <div class="col-lg-10 col-sm-10 col-xs-10">
                <form id="login-form" name="login" method="post" role="login" action="../includes/process.php">
                    <div class="row">
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" name="email" class="searchText" placeholder="Enter email" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-3">
                            <fieldset>
                                <input type="hidden" name="action" value="forget">
                                <button class="main-button" type="submit"><i class="bi bi-send"></i>Send now</button>
                            </fieldset>
                        </div>
                    </div>

                </form>
            </div>
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
