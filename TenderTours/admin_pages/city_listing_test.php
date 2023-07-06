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

    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            responsive: true
        });

        $.ajax({
            url: "../ajax/get_cities_data.php",
            method: "GET",
            dataType: "json"
        }).done(function(data) {
            var table = $('#myTable').DataTable();
            table.clear().draw();

            $.each(data, function(index, value) {
                var updateBtn = $('<button class="btn btn-primary btn-sm updateBtn">Update</button>');
                updateBtn.attr('value', value.city_id); // Módosított attribútum név
                updateBtn.attr('city-data', value.city_name);

                var deleteBtn = $('<button class="btn btn-danger btn-sm deleteBtn">Delete</button>');
                deleteBtn.attr('id-data', value.city_id);
                deleteBtn.attr('city-data', value.city_name);

                table.row.add([
                    value.organization_name,
                    value.city_name,
                    updateBtn.prop('outerHTML'),
                    deleteBtn.prop('outerHTML')
                ]).draw(false);
            });
        }).fail(function(err) {
            console.log("Error:", err);
        });

        $(document).on("click", ".updateBtn", function() {
            var cityId = $(this).attr('value'); // Módosított attribútum név
            var cityData = $(this).attr('city-data');

            $('input[name="city_name"]').val(cityData);

            $('#update_window').css({
                display: "block"
            });
            $('.backdrop').css({
                display: "block"
            });

            $('.update_save').click(function() {
                var cityName = $('input[name="city_name"]').val();

                $.post("../ajax/update_city_test.php", {
                    city_id: cityId,
                    name: cityName
                }, function(data) {
                    if (data.success) {
                        alert(data.msg);
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            });
        });

        $('.close').click(function() {
            $('.modal').css({
                display: "none"
            });
            $('.backdrop').css({
                display: "none"
            });
        });
    });

    $(document).on('click', '.deleteBtn', function() {
        var cityId = $(this).attr('id-data');
        var cityName = $(this).attr('city-data');

        $('#confirmDelete').css({
            display: "block"
        });
        $('.backdrop').css({
            display: "block"
        });

        $('.deleteBtnConfirm').click(function() {
            $.post("../ajax/delete_city.php", {
                city_id: cityId,
                city_name: cityName,

            }, function(data) {
                if (data.success) {
                    location.reload();
                    alert(data.msg);
                } else {
                    alert(data.msg);
                }
            }, 'json');
            window.location.reload();
        });
        $('.deleteBtnCancel').click(function() {
            $('#confirmDelete').css({
                display: "none"
            });
            $('.backdrop').css({
                display: "none"
            });
        });
    });


</script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">City listing</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="card-title">List of cities</h5>
                        <table id="myTable" class="display">
                            <thead>
                            <tr>
                                <th>Organization name</th>
                                <th>City</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="backdrop"></div>
                        <div id="update_window" class="modal">
                            <div class="close">x</div>
                            <h3>Update city</h3>
                            <div class="col-lg-9 align-self-center">
                                <fieldset>
                                    <input type="text" id="update_name" name="city_name" class="searchText city_name" placeholder="Organization name" autocomplete="on" required>
                                </fieldset>
                                <div class="col-lg-4">
                                    <fieldset>
                                        <button class="main-button update_save" type="submit"><i class="fa fa-search"></i>Update Now</button>
                                    </fieldset>
                                </div>

                            </div>
                        </div>
                        <div id="confirmDelete" class="modal">
                            <div class="close">x</div>
                            <h2>Are you sure you want to delete it?</h2>
                            <button class="btn btn-danger btn-sm deleteBtnConfirm">Delete</button>
                            <button class="btn btn-secondary btn-sm deleteBtnCancel">Cancel</button>
                        </div>
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

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
</body>