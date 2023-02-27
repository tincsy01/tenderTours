<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forms / Elements - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../Admin/Admin/assets/img/favicon.png" rel="icon">
    <link href="../../Admin/Admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../Admin/Admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../../Admin/Admin/assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- ======= Header ======= -->
<?php
require 'header.php';
require 'sidebar.php';
require '../includes/db_config.php';
require '../includes/config.php';
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Elements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add a new city</h5>

                        <!-- General Form Elements -->
                        <form method="post" action="../includes/add_city.php">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="city">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Longitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="longitude">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Lattitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lattitude">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <!--                                <label class="col-sm-2 col-form-label">Submit</label>-->
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="add_button">Submit</button>
                                </div>
                            </div>
                            <?php
                            // index.php?r=1
                             $r = 0;

                            if (isset($_GET["r"]) and is_numeric($_GET['r'])) {

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
                            }      $r = (int)$_GET["r"];

                            ?>
                        </form><!-- End -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
require 'footer.php';
?>


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="../../Admin/Admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../Admin/Admin/assets/vendor/echarts/echarts.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/quill/quill.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../Admin/Admin/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/php-email-form/validate.js"></script>
<script src="../../Admin/Admin/assets/js/main.js"></script>

</body>

</html>

