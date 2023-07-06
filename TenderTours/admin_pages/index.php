<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Index</title>
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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <label for="citySelect">Select City:</label>
                                <?php
                                $query = $pdo->prepare("SELECT city_id, city_name FROM cities");
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <select id="citySelect" class="form-select">

                                    <!-- Options will be populated dynamically -->

                                    <?php foreach ($results as $row): ?>
                                        <option value="<?php echo $row['city_name']; ?>" name="city"><?php echo $row['city_name']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <canvas id="myChart"></canvas>
                            <script>
                                // AJAX hívás az adatok lekérdezéséhez
                                $.ajax({
                                    url: '../ajax/data.php',
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            var data = response.ata;

                                            // Adatok feldolgozása
                                            var labels = [];
                                            var visitors = [];
                                            for (var i = 0; i < data.length; i++) {
                                                labels.push(data[i].name);
                                                visitors.push(data[i].num_of_visitors);
                                            }

                                            // Oszlopdiagram konfiguráció
                                            var config = {
                                                type: 'bar',
                                                data: {
                                                    labels: labels,
                                                    datasets: [{
                                                        label: 'Number of Visitors',
                                                        data: visitors,
                                                        backgroundColor: 'rgba(0, 123, 255, 0.6)',
                                                        borderColor: 'rgba(0, 123, 255, 1)',
                                                        borderWidth: 1
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    }
                                                }
                                            };

                                            // Diagram rajzolása
                                            var ctx = document.getElementById('myChart').getContext('2d');
                                            var myChart = new Chart(ctx, config);
                                        } else {
                                            console.log('Error:', response.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.log('AJAX Error:', error);
                                    }
                                });
                            </script>
                        </div>
                    </div><!-- End Reports -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
require '../admin_includes/footer.php';
?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../Admin/Admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../Admin/Admin/assets/vendor/echarts/echarts.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/quill/quill.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../Admin/Admin/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../Admin/Admin/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../Admin/Admin/assets/js/main.js"></script>

</body>

</html>




<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!---->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta content="width=device-width, initial-scale=1.0" name="viewport">-->
<!---->
<!--    <title>Forms / Elements - NiceAdmin Bootstrap Template</title>-->
<!--    <meta content="" name="description">-->
<!--    <meta content="" name="keywords">-->
<!---->
<!--    <!-- Favicons -->-->
<!--    <link href="../../Admin/Admin/assets/img/favicon.png" rel="icon">-->
<!--    <link href="../../Admin/Admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->
<!---->
<!--    <!-- Google Fonts -->-->
<!--    <link href="https://fonts.gstatic.com" rel="preconnect">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">-->
<!---->
<!--    <!-- Vendor CSS Files -->-->
<!--    <link href="../../Admin/Admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">-->
<!--    <link href="../../Admin/Admin/assets/css/style.css" rel="stylesheet">-->
<!--</head>-->
<!---->
<!--<body>-->
<!---->
<!--<!-- ======= Header ======= -->-->
<?php
//require '../admin_includes/header.php';
//require '../admin_includes/sidebar.php';
//require '../includes/config.php';
//require '../includes/db_config.php';
//$pdo = connectDatabase($dsn, $pdoOptions);
////global $pdo;
//?>
<!--<main id="main" class="main">-->
<!---->
<!--    <div class="pagetitle">-->
<!--        <h1>Dashboard</h1>-->
<!--        <nav>-->
<!--            <ol class="breadcrumb">-->
<!--                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>-->
<!--                <li class="breadcrumb-item active">Dashboard</li>-->
<!--            </ol>-->
<!--        </nav>-->
<!--    </div><!-- End Page Title -->-->
<!---->
<!--    <section class="section dashboard">-->
<!--        <div class="row">-->
<!---->
<!--            <!-- Left side columns -->-->
<!--            <div class="col-lg-8">-->
<!--                <div class="row">-->
<!---->
<!--                    <!-- Select City -->-->
<!--                    <div class="col-12">-->
<!--                        <div class="card">-->
<!--                            <div class="card-body">-->
<!--                                <label for="citySelect">Select City:</label>-->
<!--                                --><?php
//                                $query = $pdo->prepare("SELECT city_id, city_name FROM cities");
//                                $query->execute();
//                                $results = $query->fetchAll(PDO::FETCH_ASSOC);
//                                ?>
<!--                                <select id="citySelect" class="form-select">-->
<!---->
<!--                                    <!-- Options will be populated dynamically -->-->
<!---->
<!--                                    --><?php //foreach ($results as $row): ?>
<!--                                        <option value="--><?php //echo $row['city_name']; ?><!--" name="city">--><?php //echo $row['city_name']; ?><!--</option>-->
<!--                                    --><?php //endforeach; ?>
<!---->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div><!-- End Select City -->-->
<!---->
<!--                    <!-- Reports -->-->
<!--                    <div class="col-12">-->
<!--                        <div class="card">-->
<!--                            <div class="chart-container">-->
<!--                                <canvas id="myChart"></canvas>-->
<!--                            </div>-->
<!--                            <script>-->
<!--                                // AJAX hívás az adatok lekérdezéséhez-->
<!--                                $.ajax({-->
<!--                                    url: '../ajax/data.php',-->
<!--                                    type: 'GET',-->
<!--                                    dataType: 'json',-->
<!--                                    success: function(response) {-->
<!--                                        if (response.success) {-->
<!--                                            var data = response.data;-->
<!---->
<!--                                            // Adatok feldolgozása-->
<!--                                            var labels = [];-->
<!--                                            var visitors = [];-->
<!--                                            for (var i = 0; i < data.length; i++) {-->
<!--                                                labels.push(data[i].name);-->
<!--                                                visitors.push(data[i].num_of_visitors);-->
<!--                                            }-->
<!---->
<!--                                            // Oszlopdiagram konfiguráció-->
<!--                                            var config = {-->
<!--                                                type: 'bar',-->
<!--                                                data: {-->
<!--                                                    labels: labels,-->
<!--                                                    datasets: [{-->
<!--                                                        label: 'Number of Visitors',-->
<!--                                                        data: visitors,-->
<!--                                                        backgroundColor: 'rgba(0, 123, 255, 0.6)',-->
<!--                                                        borderColor: 'rgba(0, 123, 255, 1)',-->
<!--                                                        borderWidth: 1-->
<!--                                                    }]-->
<!--                                                },-->
<!--                                                options: {-->
<!--                                                    responsive: true,-->
<!--                                                    scales: {-->
<!--                                                        y: {-->
<!--                                                            beginAtZero: true-->
<!--                                                        }-->
<!--                                                    }-->
<!--                                                }-->
<!--                                            };-->
<!---->
<!--                                            // Diagram rajzolása-->
<!--                                            var ctx = document.getElementById('myChart').getContext('2d');-->
<!--                                            var myChart = new Chart(ctx, config);-->
<!--                                        } else {-->
<!--                                            console.log('Error:', response.message);-->
<!--                                        }-->
<!--                                    },-->
<!--                                    error: function(xhr, status, error) {-->
<!--                                        console.log('AJAX Error:', error);-->
<!--                                    }-->
<!--                                });-->
<!--                            </script>-->
<!--                        </div>-->
<!--                    </div><!-- End Reports -->-->
<!--                </div>-->
<!--            </div><!-- End Left side columns -->-->
<!--        </div>-->
<!--    </section>-->
<!---->
<!--</main><!-- End #main -->-->
<!---->
<!--<!-- ======= Footer ======= -->-->
<?php
//require '../admin_includes/footer.php';
//?>
<!---->
<!--<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>-->
<!---->
<!--<!-- Vendor JS Files -->-->
<!--<script src="../../Admin/Admin/assets/vendor/apexcharts/apexcharts.min.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/chart.js/chart.umd.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/echarts/echarts.min.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/quill/quill.min.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/simple-datatables/simple-datatables.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/tinymce/tinymce.min.js"></script>-->
<!--<script src="../../Admin/Admin/assets/vendor/php-email-form/validate.js"></script>-->
<!---->
<!--<!-- Template Main JS File -->-->
<!--<script src="../../Admin/Admin/assets/js/main.js"></script>-->
<!---->
<!--<!-- Populate city select options -->-->
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--        $.ajax({-->
<!--            url: '../ajax/cities.php',-->
<!--            type: 'GET',-->
<!--            dataType: 'json',-->
<!--            success: function(response) {-->
<!--                if (response.success) {-->
<!--                    var cities = response.data;-->
<!--                    var citySelect = $('#citySelect');-->
<!---->
<!--                    for (var i = 0; i < cities.length; i++) {-->
<!--                        var city = cities[i];-->
<!--                        var option = '<option value="' + city.id + '">' + city.name + '</option>';-->
<!--                        citySelect.append(option);-->
<!--                    }-->
<!--                } else {-->
<!--                    console.log('Error:', response.message);-->
<!--                }-->
<!--            },-->
<!--            error: function(xhr, status, error) {-->
<!--                console.log('AJAX Error:', error);-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!---->
<!--</body>-->
<!---->
<!--</html>-->