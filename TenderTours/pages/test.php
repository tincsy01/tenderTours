<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>Bootstrap Table Example</title>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <!-- Add Bootstrap CSS -->-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div class="container">-->
<!--    <h2>Bootstrap Table Example</h2>-->
<!--    <p>Live Search:</p>-->
<!--    <input class="form-control" id="myInput" type="text" placeholder="Search..">-->
<!--    <br>-->
<!--    <p>Sort by category:</p>-->
<!--    <select class="form-control" id="category">-->
<!--        <option value="">All</option>-->
<!--        <option value="fruit">Fruit</option>-->
<!--        <option value="vegetable">Vegetable</option>-->
<!--        <option value="meat">Meat</option>-->
<!--    </select>-->
<!--    <br>-->
<!--    <table class="table table-bordered">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Product Name</th>-->
<!--            <th>Category</th>-->
<!--            <th>Price</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody id="myTable">-->
<!--        <tr>-->
<!--            <td>Apple</td>-->
<!--            <td>Fruit</td>-->
<!--            <td>$0.99</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Orange</td>-->
<!--            <td>Fruit</td>-->
<!--            <td>$0.79</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Banana</td>-->
<!--            <td>Fruit</td>-->
<!--            <td>$0.59</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Carrot</td>-->
<!--            <td>Vegetable</td>-->
<!--            <td>$0.49</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Broccoli</td>-->
<!--            <td>Vegetable</td>-->
<!--            <td>$1.49</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Chicken</td>-->
<!--            <td>Meat</td>-->
<!--            <td>$2.99</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Beef</td>-->
<!--            <td>Meat</td>-->
<!--            <td>$4.99</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
<!---->
<!--<!-- Add jQuery -->-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!---->
<!--<!-- Add Bootstrap JS -->-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
<!---->
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        // Live Search-->
<!--        $("#myInput").on("keyup", function() {-->
<!--            var value = $(this).val().toLowerCase();-->
<!--            $("#myTable tr").filter(function() {-->
<!--                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);-->
<!--            });-->
<!--        });-->
<!---->
<!--        // Sort by category-->
<!--        $("#category").on("change", function() {-->
<!--            var value = $(this).val().toLowerCase();-->
<!--            $("#myTable tr").filter(function() {-->
<!--                if (value == "") {-->
<!--                    $(this).toggle(true);-->
<!--                } else {-->
<!--                    return $(this).children("td:nth-child(2)").text().toLowerCase().indexOf(value) > -1;-->
<!--                }-->
<!--            }).toggle();-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!---->
<!--</body>-->
<!--</html>-->
<?php
session_start();
?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<script>

    $(document).ready(function() {

        // Live Search
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#statisticTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#type_dropdown").on("change", function() {
            var value = $(this).val().toLowerCase();
            $(".statisticTable tr").filter(function() {
                if (value == "") {
                    $(this).toggle(true);
                } else {
                    return $(this).children("td:nth-child(4)").text().toLowerCase() == value;
                }
            }).toggle();
        });
    });


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
            <form action="" method="post" id="search-form" class="statisticTable">
                <p>Live Search:</p>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <p>Select category</p>
                <select name="type" class="form-control" id="type_dropdown" class="category">
                    <option>---Select---</option>
                    <?php
                    $sql = "SELECT category_id, category FROM categories";
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $categories = $query->fetchAll();
                    foreach ($categories as $category){
                        echo '<option value="'.$category['category'].'">'.$category['category'].'</option>';
                    }
                    ?>
                </select>

                <?php
                $sql = "SELECT a.attraction_id, a.name, a.longitude, a.lattitude, a.num_of_visitors, a.popular, c.category 
                    FROM attractions a INNER JOIN categories c ON c.category_id = a.category_id  WHERE a.org_id = :org_id";
                $org_id = $_SESSION['user_id'];
                $query = $pdo->prepare($sql);
                $query->bindParam(':org_id', $org_id);
                $query->execute();
                $attractions = $query->fetchAll();

                $table = '<table class="table" id="statisticTable">
                <thead>
                    <tr>
                        <th scope="col">Name of attraction</th>
                        <th scope="col">Number of visitors</th>
                        <th scope="col">Popularity</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($attractions as $attraction) {
                    $table .= '<tr scope="row">
                    <td>' . $attraction['name'] . '</td>
                    <td>' . $attraction['num_of_visitors'] . '</td>
                    <td>' . $attraction['popular'] . '</td>
                    <td>' . $attraction['category'] . '</td>
                </tr>';
                }

                $table .= '</tbody></table>';

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
<!--<script src="../assets/js/script.js"></script>-->
</body>
</html>
