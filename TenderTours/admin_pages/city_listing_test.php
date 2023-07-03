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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!--    <script src="../vendor/jquery/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


</head>
<body>
<!-- ======= Header ======= -->
<?php
require '../admin_includes/header.php';
require '../admin_includes/sidebar.php';
require '../includes/config.php';
require '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

?>
<script>
    $(document).ready(function () {
        // DataTables inicializálása
        $('#myTable').DataTable();

        // AJAX kérés elküldése a get_cities_test.php fájlnak
        $.ajax({
            url: "../ajax/get_cities_test.php",
            method: "GET",
            dataType: "json"
        }).done(function (data) {
            // Adatok beillesztése a táblázatba
            var table = $('#myTable').DataTable();
            table.clear().draw();
            $.each(data, function (index, value) {
                table.row.add([
                    value.organization_name,
                    value.city_name,
                    value.checked,
                    '<button class="btn btn-primary btn-sm">Update</button>',
                    '<button class="btn btn-danger btn-sm">Delete</button>'
                ]).draw(false);
            });
        }).fail(function (err) {
            console.log("Error:", err);
        });
    });
</script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">City listing</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of cities</h5>
                         <table id="myTable" class="display">
                             <thead>
                             <tr>
                                 <th>Organization name</th>
                                 <th>City</th>
                                 <th>Active</th>
                                 <th>Update</th>
                                 <th>Delete</th>
                             </tr>
                             </thead>
                             <tbody>

                             </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
require '../admin_includes/footer.php';
?>
<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/js/main.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
</body>
</html>