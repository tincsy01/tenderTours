
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Statistics</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/twbs/bootstrap-icons/icons" rel="stylesheet">
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<script>

</script>
<body>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>List of your attraction's statistics</h2>
                </div>
            </div>
            <form action="" method="post" id="search-form">
                <?php
                        $sql = "SELECT attraction_id, name, longitude, lattitude, num_of_visitors, popular, type FROM attractions WHERE org_id = :org_id";
                        $org_id = $_SESSION['user_id'];
                        $query = $pdo->prepare($sql);
                        $query->bindParam(':org_id', $org_id);
                        $query->execute();
                        $attractions = $query->fetchAll();

                        $table = ' <table class="table">
                            <thead>
                            <tr>
                            <!--  <th scope="col">#</th> -->
                                <th scope="col">Name of attraction</th>
                                <th scope="col">Number of visitors</th>
                                <th scope="col">Popularity</th>
                                <th scope="col">
                                Type
                                <select name="type" class="form-control" id="type_dropdown">
                                  <option>---Select---</option>';
                                    $sql = "SELECT type FROM attractions WHERE org_id = :org_id";
                                    $org_id = $_SESSION['user_id'];
                                    $query = $pdo->prepare($sql);
                                    $query->bindParam(':org_id', $org_id);
                                    $query->execute();
                    //
                                    $types = $query->fetchAll();
                                    foreach ($types as $type){
                                         $table .= '<option value="'.$type['type'].'">'.$type['type'].'</option>';
                                    }
                                    $table .='
                                     </select>
                                </th>

                            </tr>
                            </thead>
                            <tbody>';
                            foreach ($attractions as $attraction) {
                                $table .= '<tr scope="row">
                                                <td>' . $attraction['name'] . '</td>
                                                <td>' . $attraction['num_of_visitors'] . '</td>
                                                <td>' . $attraction['popular'] . '</td>
                                                <td>' . $attraction['type'] . '</td>
                                            </tr>';
                            }
                            $table .= '
                                    </tbody>
                                    </table>';
                            echo $table;
?>
            </form>
        </div>
    </div>
</div>
<?php
require_once '../includes/footer.php';
?>

<!-- Scripts -->
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>
</body>
</html>
