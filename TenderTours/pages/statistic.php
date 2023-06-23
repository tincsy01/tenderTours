
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
<!--    <link href="../vendor/twbs/bootstrap-icons/icons" rel="stylesheet">-->
    <script src="../vendor/jquery/jquery.min.js"></script>

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

        // $("#type_dropdown").on("change", function() {
        //     var value = $(this).val().toLowerCase();
        //     $("#statisticTable tbody tr").filter(function() {
        //     // $(".statisticTable tr").filter(function() {
        //         if (value == "") {
        //             $(this).toggle(true);
        //         } else {
        //             return $(this).children("td:nth-child(4)").text().toLowerCase() == value;
        //         }
        //     }).toggle();
        // });
        $("#type_dropdown").on("change", function() {
            var selectedCategory = $(this).val();
            $("#statisticTable tbody tr").each(function() {
                var rowCategory = $(this).find("td:nth-child(4)").text();
                if (selectedCategory === "" || rowCategory.toLowerCase() === selectedCategory.toLowerCase()) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }).change();

    });


</script>

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
<!--            --><?php
//            // Kategória lekérdezés
//            $sql = "SELECT category_id, category FROM categories ORDER BY category ASC";
//            $query = $pdo->prepare($sql);
//            $query->execute();
//            $categories = $query->fetchAll();
//
//            // Atrakciók lekérdezése
//            $sql = "SELECT a.attraction_id, a.name, a.longitude, a.lattitude, a.num_of_visitors, a.popular, c.category
//        FROM attractions a INNER JOIN categories c ON c.category_id = a.category_id WHERE a.org_id = :org_id";
//            $org_id = $_SESSION['user_id'];
//            $query = $pdo->prepare($sql);
//            $query->bindParam(':org_id', $org_id);
//            $query->execute();
//            $attractions = $query->fetchAll();
//            ?>
<!---->
<!--            <!-- Select lista -->-->
<!--            <p>Select category</p>-->
<!--            <select name="type" id="type_dropdown" class="form-control">-->
<!--                <option value="">---Select---</option>-->
<!--                --><?php //foreach ($categories as $category): ?>
<!--                    <option value="--><?php //echo $category['category_id']; ?><!--">--><?php //echo $category['category']; ?><!--</option>-->
<!--                --><?php //endforeach; ?>
<!--            </select>-->
<!---->
<!--            <!-- Táblázat -->-->
<!--            <table class="table" id="statisticTable">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th scope="col">Name of attraction</th>-->
<!--                    <th scope="col">Number of visitors</th>-->
<!--                    <th scope="col">Popularity</th>-->
<!--                    <th scope="col">Type</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php //foreach ($attractions as $attraction): ?>
<!--                    <tr>-->
<!--                        <td>--><?php //echo $attraction['name']; ?><!--</td>-->
<!--                        <td>--><?php //echo $attraction['num_of_visitors']; ?><!--</td>-->
<!--                        <td>--><?php //echo $attraction['popular']; ?><!--</td>-->
<!--                        <td>--><?php //echo $attraction['category']; ?><!--</td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--                </tbody>-->
<!--            </table>-->
<!---->
<!--            <script>-->
<!--                $(document).ready(function() {-->
<!--                    $("#type_dropdown").on("change", function() {-->
<!--                        var selectedCategory = $(this).val();-->
<!--                        $("#statisticTable tbody tr").each(function() {-->
<!--                            var rowCategory = $(this).find("td:nth-child(4)").text();-->
<!--                            if (selectedCategory === "" || rowCategory === selectedCategory) {-->
<!--                                $(this).show();-->
<!--                            } else {-->
<!--                                $(this).hide();-->
<!--                            }-->
<!--                        });-->
<!--                    }).change(); // Azonnal végrehajtjuk a szűrést a kezdő kategória alapján-->
<!--                });-->
<!--            </script>-->


                            <p>Live Search:</p>
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <p>Select category</p>
                <select name="type" class="form-control category" id="type_dropdown">
                    <option>---Select---</option>
                    <?php
                    $sql = "SELECT category_id, category FROM categories ORDER BY category ASC";
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
</body>
</html>
