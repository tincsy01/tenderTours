<!DOCTYPE html>
<html lang="en">

<head >
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
require '../admin_includes/header.php';
require '../admin_includes/sidebar.php';
require '../includes/config.php';
require '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
//global $pdo;
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../admin_pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Cities</li>
                <li class="breadcrumb-item active">Cities</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">The list of cities</h5>

                        <!-- General Form Elements -->
                            <?php
                           //  var_dump($pdo); die();
                            $sql = "SELECT 	city_id, organization_name, city_name, longitude, lattitude, checked FROM cities ";

                            $query = $pdo->query($sql);
                            //var_dump($query);die();
                            $results = $query->fetchAll(PDO::FETCH_ASSOC);

                            //var_dump($results);die();
                            $table = '<table>
                                        <thead>
                                            <tr>
                                                <th>City id</th>
                                                <th>Organization name</th>
                                                <th>City</th>
                                                <th>Longitude</th>
                                                <th>Lattitude</th>
                                                <th>Checked</th>
                                               
                                                <th>Update</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>';
                            foreach($results as $row) {
                                $table .='
                                    <tr>
                                        <td>' . $row['city_id'] . '</td>
                                        <td>' . $row['organization_name'] . '</td>
                                        <td>' . $row['city_name'] . '</td>
                                        <td>' . $row['longitude'] . '</td>
                                        <td>' . $row['lattitude'] . '</td>
                                        <td>' . $row['checked'] . '</td>
                                        <td><button type="button" class="btn btn-outline-success col-2 updateBtn" 
                            city-data="'.$row['city_id'].'"><i class="bi bi-pencil"></i></button></td>
                                        <td><button type="button" class="btn btn-outline-danger col-2 updateBtn" 
                            city-data="'.$row['city_id'].'"><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    
                                ';
                            }
                            $table .= '
                                </tbody>
                                </table>
                            ';
                            echo $table;
                            ?>
                        <!-- End -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
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
<script src="assets/js/main.js"></script>
</body>
</html>