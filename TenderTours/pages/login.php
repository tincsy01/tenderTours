<?php
session_start();
?>
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
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>

<body>
<!-- ***** Preloader Start ***** -->
<!--<div id="js-preloader" class="js-preloader">-->
<!--    <div class="preloader-inner">-->
<!--        <span class="dot"></span>-->
<!--        <div class="dots">-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--            <span></span>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php
require_once '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
?>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h6>Login</h6>
<!--                    <h2>Find Tours Places &amp; Things</h2>-->
                </div>
            </div>
            <div class="col-lg-12">
                <form id="login-form" name="login" method="post" role="login" action="../includes/process.php">
                    <div class="row">
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" name="loginUsername" class="searchText" placeholder="Enter username" autocomplete="on" required>
<!--                                <input type="password" name="address" class="searchText" placeholder="Enter password" autocomplete="on" required>-->
                            </fieldset>
                            <fieldset>
                                <input type="password" name="loginPassword" class="searchText" placeholder="Enter password" autocomplete="on" required>
                            </fieldset>
                            <?php
                            // index.php?r=1
                            $r = 0;

                            if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                                $r = (int)$_GET["r"];

                                if (array_key_exists($r, $messages)) {
                                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3 col-lg-8 align-self-center" role="alert">
                        '.$messages[$r].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                                }
                            }
                            ?>
                        </div>

                        <div class="col-lg-3">
                            <fieldset>
                                <input type="hidden" name="action" value="login">
                                <button class="main-button" type="submit"><i class="bi bi-send"></i> Login Now</button>
                            </fieldset>

                            <fieldset>
                                <h6>If you don't have an account yet, register:</h6>
                                <!--<input type="button" href="register.php" class="bi bi-send">-->
                                <button class="main-button col-" type="submit" onclick="location.href='register.php'"><i class="bi bi-send"></i> Register Now</button>
                            </fieldset>

                        </div>
                    </div>
                </form>
<!--                <div class="col-lg-3 center">-->
<!--                    <fieldset>-->
<!--                        <h6>If you don't have an account yet, register:</h6>-->
<!--                        <input type="button" href="register.php" class="bi bi-send">-->
<!--                        <button class="main-button col-" type="submit"><a href="register.php"></a><i class="bi bi-send"></i> Register Now</button>-->
<!--                    </fieldset>-->
<!--                </div>-->

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