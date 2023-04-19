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
    // $(document).ready(function() {
    //     $('#search-form').submit(function(event) {
    //         event.preventDefault();
    //
    //         var attractionName = $('#attraction-name-input').val();
    //         var popularityRating = $('#popularity-rating-input').val();
    //         var numOfVisitors = $('#num-of-visitors-input').val();
    //
    //         $.ajax({
    //             url: 'process.php',
    //             method: 'POST',
    //             data: { attraction_name: attractionName, popularity_rating: popularityRating, num_of_visitors: numOfVisitors },
    //             dataType: 'json',
    //             success: function(data) {
    //                 var resultHtml = '<table class="table table-striped">';
    //                 resultHtml += '<thead><tr><th>Attraction name</th><th>Popularity rating</th><th>Number of visitors</th></tr></thead>';
    //                 resultHtml += '<tbody>';
    //                 $.each(data, function(index, row) {
    //                     resultHtml += '<tr><td>' + row.attraction_name + '</td><td>' + row.popularity_rating + '</td><td>' + row.num_of_visitors + '</td></tr>';
    //                 });
    //                 resultHtml += '</tbody></table>';
    //
    //                 $('#search-results').html(resultHtml);
    //             },
    //             error: function(xhr, status, error) {
    //                 alert('Error: ' + error);
    //             }
    //         });
    //     });
    // });
    // // Bemeneti mezők kereső funkciója
    // $('#search-form').submit(function(event) {
    //     event.preventDefault();
    //
    //     // Bemeneti mezők értékeinek lekérése
    //     var attractionName = $('#attraction_name').val();
    //     var popularityRating = $('#popularity_rating').val();
    //     var numOfVisitors = $('#num_of_visitors').val();
    //
    //     // AJAX kérés küldése a szervernek
    //     $.ajax({
    //         url: '../includes/process.php',
    //         method: 'GET',
    //         data: { attraction_name: attractionName,
    //                 popularity_rating: popularityRating,
    //             num_of_visitors: numOfVisitors },
    //         dataType: 'json',
    //         success: function(data) {
    //             // Eredmények tábláz3atba rendezése
    //             var tableHtml = '<table class="table table-striped"><thead><tr><th>Attraction name</th><th>Popularity rating</th><th>Number of visitors</th></tr></thead><tbody>';
    //             $.each(data, function(index, row) {
    //                 tableHtml += '<tr><td>' + row.attraction_name + '</td><td>' + row.popularity_rating + '</td><td>' + row.num_of_visitors + '</td></tr>';
    //             });
    //             tableHtml += '</tbody></table>';
    //
    //             // Eredmények megjelenítése az oldalon
    //             $('#search-results').html(tableHtml);
    //         },
    //         error: function(xhr, status, error) {
    //             alert('Error: ' + error);
    //         }
    //     });
    // });
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
            <form id="search-form">
                <div class="form-group">
                    <label for="attraction-name-input">Attraction name</label>
                    <input type="text" class="form-control" id="attraction-name-input" placeholder="Enter attraction name">
                </div>
                <div class="form-group">
                    <label for="popularity-rating-input">Popularity rating</label>
                    <input type="text" class="form-control" id="popularity-rating-input" placeholder="Enter popularity rating">
                </div>
                <div class="form-group">
                    <label for="num-of-visitors-input">Number of visitors</label>
                    <input type="text" class="form-control" id="num-of-visitors-input" placeholder="Enter number of visitors">
                </div>
                <button type="submit" class="btn btn-primary col-lg-2">Search</button>
            </form>
            <div class="col-lg-12">
<!--                <form id="search-form" name="update_attraction" method="post" role="update_attraction">-->
                    <div class="row">
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
                                    <option>---Select---</option>
                                    '?>
                        <?php
                                    $sql = "SELECT type FROM attractions WHERE org_id = :org_id";
                                     $org_id = $_SESSION['user_id'];
                                    $query = $pdo->prepare($sql);
                                    $query->bindParam(':org_id', $org_id);
                                    $query->execute();
                                    $types = $query->fetchAll();
                                    foreach ($types as $type){}
                                    echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
                                    '
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
                            //var_dump($attraction['attraction_id'],$attraction['name']);

                        }

                        $table .= '
                                </tbody>
                                </table>
                            ';
                        echo $table;
                        ?>
                    </div>
<!--                </form>-->
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

