
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Make an attraction</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/twbs/icons" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

</head>
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
                    <h2>Make attraction</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <form id="search-form" name="make_attraction" method="post" action="../includes/process.php" role="make_attraction">
                    <div class="row">
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" id="attraction" name="attraction" class="searchText" placeholder="Attraction name" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <select name="city_id" >
                            <?php
                            $sql = "SELECT city_id, city_name FROM cities";
                            $query = $pdo->query($sql);
                            $cities = $query->fetchAll();?>
                            <?php foreach ($cities as  $city){ ?>
                                <option class="searchText" value="<?php echo $city['city_id'];?>" name="city_id"><?php echo $city['city_name']?></option>';
                            <?php }?>
                        </select>

                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" id="longitude" name="longitude" class="searchText" placeholder="Longitude"  required>
                            </fieldset>
                        </div>
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" id="lattitude" name="lattitude" class="searchText" placeholder="Lattitude" required>
                            </fieldset>
                        </div>

                        <div class="col-lg-3">
                            <fieldset>
                                <input type="hidden" name="action" value="make_attraction">
                                <button class="main-button" type="submit"><i class="fa fa-search"></i>Add Now</button>
                            </fieldset>
                        </div>
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
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>List of your attractions</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <form id="search-form" name="make_attraction" method="post" action="../includes/process.php" role="make_attraction">
                    <div class="row">
                        <?php
                        $sql = "SELECT name, longitude, lattitude, num_of_visitors, popularity_rating FROM attractions WHERE org_id = :org_id";
                        $org_id = $_SESSION['user_id'];
                        $query = $pdo->prepare($sql);
                        $query->bindParam(':org_id', $org_id);
                        $query->execute();
                        $attractions = $query->fetchAll();
//                        var_dump($attractions);die();
                        $table = ' <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name of attraction</th>
                                <th scope="col">Longitude</th>
                                <th scope="col">Lattitude</th>
                                <th scope="col">Number of visitors</th>
                                <th scope="col">Popularity rating</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>';
                        foreach ($attractions as $attraction) {
                            $table .= '<tr scope="row">
                                            <td>' . $attraction['name'] . '</td>
                                            <td>' . $attraction['longitude'] . '</td>
                                            <td>' . $attraction['lattitude'] . '</td>
                                            <td>' . $attraction['num_of_visitors'] . '</td>
                                            <td>' . $attraction['popularity_rating'] . '</td>
                                            <td><i class="bi bi-pencil"></i></td>
                                            <td><i class="bi bi-trash3"></i></td>
                                        </tr>';
                        }
                        $table .= '
                                </tbody>
                                </table>
                            ';
                        echo $table;
                        ?>

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

