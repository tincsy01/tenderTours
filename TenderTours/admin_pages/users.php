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

    <script src="../vendor/jquery/jquery.min.js"></script>

</head>

<body>
<script>
    $(document).ready(function () {
        $(".updateBtn").click(function (){
            $('select[name="banning"]').val($(this).attr('status-data'));
            $('#update_window').css({
                display: "block"
            });
            $('.backdrop').css({
                display: "block"
            });
        });
        $('.close').click(function (){
            $('.modal').css({
                display: "none"
            });
            $('.backdrop').css({
                display: "none"
            });
        });
        $('.update_save').click(function (){
            $.post("../includes/process.php", {
                user_id: $('.update_input_id').val(),
                banning: $('.banning').val(),
                action: 'update_user_admin',
            }, function (data){
                if (data.success) {
                    location.reload();
                    alert(data.msg);
                } else {
                    alert(data.msg);
                }
            }, 'json');
        });
    });
</script>
<?php
require '../admin_includes/header.php';
require '../admin_includes/sidebar.php';
require '../includes/config.php';
require '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">User's list</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of organization</h5>
                        <div class="backdrop"></div>
                        <div id="update_window" class="modal">
                            <div class="close">x</div>
                            <h3>Update user</h3>
                            <div class="col-lg-9 align-self-center">
                                <div class="col-lg-4">
                                    <p>Banning user</p>
                                    <select name="banning" id="banning" class="banning">
                                        <option value="1">Not banned</option>
                                        <option value="0">Banned</option>s
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset>
                                        <input type="hidden" name="action" value="update_user_admin">
                                        <button class="main-button update_save" type="submit"><i class="fa fa-search"></i>Update Now</button>
                                    </fieldset>
                                </div>

                            </div>
                        </div>
                        <?php
                        $sql = "SELECT name, username, user_id, active FROM users ";
                        $query = $pdo->query($sql);
                        $results = $query->fetchAll(PDO::FETCH_ASSOC);
                        $table = '<table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Active</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                        foreach($results as $row) {
                            $table .='
                                    <tr>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['username'] . '</td>
                                        <td>' . $row['active'] . '</td>
                                        
                                        <td><button type="button" class="btn btn-outline-success update_input_id col-2 updateBtn" value="'.$row['user_id'].'"
                             name-data="'.$row['name'].'" id-data="'.$row['user_id'].'" 
                            ><i class="bi bi-pencil"></i></button></td>
                                        
                                        <td><button type="button" class="btn btn-outline-danger col-2 updateBtn" 
                            id-data="'.$row['user_id'].'><i class="bi bi-trash"></i></button></td>
                                    </tr>
                                    
                                ';
                        }
                        $table .= '
                                </tbody>
                                </table>
                            ';
                        echo $table;
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>




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
</html>