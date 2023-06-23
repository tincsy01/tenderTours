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
        $(".updateBtn").click(function () {
            var orgId = $(this).attr('id-data');
            var orgName = $(this).attr('name-data');
            var banningStatus = $(this).attr('status-data');
            var visibilityStatus = $(this).attr('visibility-data'); // Hozzáadott sor

            $('input[name="org_id"]').val(orgId);
            $('input[name="org_name"]').val(orgName);
            $('select[name="banning"]').val(banningStatus);
            $('select[name="visible"]').val(visibilityStatus); // Hozzáadott sor

            $('#update_window').css({
                display: "block"
            });
            $('.backdrop').css({
                display: "block"
            });
        });

        // $(".deleteBtn").click(function () {
        //     var orgId = $(this).attr('id-data');
        //     // Perform delete operation using orgId
        // });

        $(".deleteBtn").click(function () {
            var orgId = $(this).attr('id-data');
            if (confirm("Biztosan törölni szeretnéd ezt a szervezetet?")) {
                $.post("../includes/process.php", {
                    org_id: orgId,
                    action: 'delete_organization_admin',
                }, function (data) {
                    if (data.success) {
                        location.reload();
                        alert(data.msg);
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }
        });

        $('.close').click(function () {
            $('.modal').css({
                display: "none"
            });
            $('.backdrop').css({
                display: "none"
            });
        });

        $('.update_save').click(function () {
            var orgId = $('.update_input_id').val();
            var orgName = $('.org_name').val();
            var banningStatus = $('.banning').val();
            var visibilityStatus = $('.visibility').val();

            $.post("../includes/process.php", {
                org_id: orgId,
                name: orgName,
                banning: banningStatus,
                visibility: visibilityStatus,
                action: 'update_organization_admin',
            }, function (data) {
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
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $(".updateBtn").click(function (){-->
<!--            $('input[name="org_name"]').val($(this).attr('name-data'));-->
<!--            $('select[name="banning"]').val($(this).attr('status-data'));-->
<!--            $('#update_window').css({-->
<!--                display: "block"-->
<!--            });-->
<!--            $('.backdrop').css({-->
<!--                display: "block"-->
<!--            });-->
<!--        });-->
<!--        $('.close').click(function (){-->
<!--            $('.modal').css({-->
<!--                display: "none"-->
<!--            });-->
<!--            $('.backdrop').css({-->
<!--                display: "none"-->
<!--            });-->
<!--        });-->
<!--        $('.update_save').click(function (){-->
<!--            $.post("../includes/process.php", {-->
<!--                org_id: $('.update_input_id').val(),-->
<!--                name: $('.org_name').val(),-->
<!--                banning: $('.banning').val(),-->
<!--                visible: $('.visibility').val(),-->
<!--                action: 'update_organization_admin',-->
<!--            }, function (data){-->
<!--                if (data.success) {-->
<!--                    location.reload();-->
<!--                    alert(data.msg);-->
<!--                } else {-->
<!--                    alert(data.msg);-->
<!--                }-->
<!--            }, 'json');-->
<!--        });-->
<!--    });-->
<!--</script>-->
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
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../Admin/Admin/index.html">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Organization listing</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List of organization</h5>
<!--                        <div class="backdrop"></div>-->
<!--                        <div id="update_window" class="modal">-->
<!--                            <div class="close">x</div>-->
<!--                            <h3>Update Organization</h3>-->
<!--                            <div class="col-lg-9 align-self-center">-->
<!--                                <fieldset>-->
<!--                                    <input type="text" id="update_name" name="org_name" class="searchText org_name" placeholder="Organization name" autocomplete="on" required>-->
<!--                                </fieldset>-->
<!--                                <div class="col-lg-4">-->
<!--                                    <p>Banning user</p>-->
<!--                                    <select name="banning" id="banning" class="banning">-->
<!--                                        <option value="1">Not banned</option>-->
<!--                                        <option value="0">Banned</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                                <div class="col-lg-4">-->
<!--                                    <p>Visibility</p>-->
<!--                                    <select name="visibility" id="visibility" class="visibility">-->
<!--                                        <option value="1">Visible</option>-->
<!--                                        <option value="0">Not visible</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                                <div class="col-lg-4">-->
<!--                                    <fieldset>-->
<!--                                        <input type="hidden" name="action" value="update_organization_admin">-->
<!--                                        <button class="main-button update_save" type="submit"><i class="fa fa-search"></i>Update Now</button>-->
<!--                                    </fieldset>-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        --><?php
//                        $sql = "SELECT organizations.org_id ,organizations.org_name, cities.city_name,organizations.active, organizations.status, organizations.city_id, organizations.status FROM organizations INNER JOIN cities  ON organizations.city_id = cities.city_id ";
//                        $query = $pdo->query($sql);
//                        $results = $query->fetchAll(PDO::FETCH_ASSOC);
//                        $table = '<table>
//                                        <thead>
//                                            <tr>
//                                                <th>Organization name</th>
//                                                <th>City</th>
//                                                <th>Active</th>
//                                                <th>Visibility</th>
//                                                <th>Update</th>
//                                                <th>Delete</th>
//                                            </tr>
//                                        </thead>
//                                        <tbody>';
//                         foreach($results as $row) {
//                             $table .='
//                                    <tr>
//                                        <td>' . $row['org_name'] . '</td>
//                                        <td>' . $row['city_name'] . '</td>
//                                        <td>' . $row['active'] . '</td>
//                                        <td>' . $row['status'] . '</td>
//
//                                        <td><button type="button" class="btn btn-outline-success update_input_id col-2 updateBtn" value="'.$row['org_id'].'"
//                            city-data="'.$row['city_name'].'" name-data="'.$row['org_name'].'" id-data="'.$row['org_id'].'"
//                            status-data="'.$row['status'].'"><i class="bi bi-pencil"></i></button></td>
//
//                                        <td><button type="button" class="btn btn-outline-danger col-2 updateBtn"
//                            id-data="'.$row['org_id'].'><i class="bi bi-trash"></i></button></td>
//                                    </tr>
//
//                                ';
//                         }
//                            $table .= '
//                                </tbody>
//                                </table>
//                            ';
//                            echo $table;
//                        ?>
                        <form id="search-form" name="update_organization" method="post" role="update_organization">
                            <div class="backdrop"></div>
                            <div id="update_window" class="modal">
                                <div class="close">x</div>
                                <h3>Update Organization</h3>
                                <div class="col-lg-9 align-self-center">
                                    <fieldset>
                                        <input type="text" id="update_name" name="org_name" class="searchText org_name" placeholder="Organization name" autocomplete="on" required>
                                    </fieldset>
                                    <div class="col-lg-4">
                                        <p>Banning user</p>
                                        <select name="banning" id="banning" class="banning">
                                            <option value="1">Not banned</option>
                                            <option value="0">Banned</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <p>Visibility</p>
                                        <select name="visible" id="visible" class="visible">
                                            <option value="1">Visible</option>
                                            <option value="0">Not visible</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset>
                                            <input type="hidden" name="action" value="update_organization_admin">
                                            <input type="hidden" name="org_id" class="update_input_id">
                                            <button class="main-button update_save" type="submit"><i class="fa fa-search"></i>Update Now</button>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <?php
                                $sql = "SELECT organizations.org_id ,organizations.org_name, cities.city_name,organizations.active, organizations.status, organizations.city_id, organizations.status FROM organizations INNER JOIN cities  ON organizations.city_id = cities.city_id ";
                                $query = $pdo->query($sql);
                                $results = $query->fetchAll(PDO::FETCH_ASSOC);

                                $table = '<table>
                    <thead>
                        <tr>
                            <th>Organization name</th>
                            <th>City</th>
                            <th>Active</th>
                            <th>Visibility</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>';
                               foreach ($results as $row) {
    $table .= '<tr>
                    <td>' . $row['org_name'] . '</td>
                    <td>' . $row['city_name'] . '</td>
                    <td>' . $row['active'] . '</td>
                    <td>' . $row['status'] . '</td>
                    <td><button type="button" class="btn btn-outline-success update_input_id col-2 updateBtn" 
                                value="'.$row['org_id'].'"
                                city-data="'.$row['city_name'].'"
                                name-data="'.$row['org_name'].'"
                                id-data="'.$row['org_id'].'" 
                                status-data="'.$row['status'].'"
                                visibility-data="'.$row['status'].'"><i class="bi bi-pencil"></i></button></td>
                    <td><button type="button" class="btn btn-outline-danger col-2 deleteBtn" 
                                id-data="'.$row['org_id'].'"><i class="bi bi-trash"></i></button></td>
                </tr>';
                                }
                                $table .= '</tbody></table>';
                                echo $table;
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
require '../admin_includes/footer.php';
?>
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
</html>