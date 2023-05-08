
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>My tours</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <!--
    https://templatemo.com/tm-564-plot-listing
    -->
</head>
<script>
    window.addEventListener('load', function() {
        var city = document.querySelector('#city');

        // Változó az AJAX kéréshez
        var xhr = new XMLHttpRequest();

        // Azon esemény figyelése, ha a város kiválasztásra került
        city.addEventListener('change', function() {
            // Az aktuálisan kiválasztott város ID-ja
            var cityId = this.value;

            // Ha nem választottak ki várost, akkor nem kell semmit betölteni
            if (!cityId) {
                document.querySelector('#attractions').innerHTML = '';
                return;
            }

            // AJAX kérés az ahhoz tartozó látványosságok lekérdezésére
            xhr.open('GET', '../ajax/get_attractions.php?city_id=' + cityId);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Ha a kérés sikeres, akkor betöltjük a látványosságokat a div-be
                    document.querySelector('#attractions').innerHTML = xhr.response;
                } else {
                    // Ha hiba történt, akkor hibaüzenetet jelenítünk meg
                    console.error('Hiba történt: ' + xhr.statusText);
                }
            };
            xhr.onerror = function() {
                // Ha hiba történt, akkor hibaüzenetet jelenítünk meg
                console.error('Hiba történt az AJAX kérés során');
            };
            xhr.send();
        });
    });
</script>
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
                    <h2>Make tour</h2>
                </div>
            </div>
            <form id="search-form" name="make_attraction" method="post" action="../includes/process.php" role="make_tour">
                <div class="col-lg-5 align-self-center">
                    <label for="city">Select a city for your tour:</label>
                    <select name="city" id="city">
                        <option value="">-- Válassz egy várost --</option>
                        <?php
                        // Lekérjük az összes várost az adatbázisból
                        $sql = "SELECT city_id, city_name FROM cities";
                        $query = $pdo->query($sql);
                        $cities = $query->fetchAll();

                        // Kilistázzuk a városokat a select mezőben
                        foreach ($cities as $city) {
                            echo '<option value="' . $city['city_id'] . '">' . $city['city_name'] . '</option>';
                        }
                        ?>
                    </select>
                    <div id="attractions"></div>
                    <div class="col-lg-3">
                        <fieldset>
                            <input type="hidden" name="action" value="make_tour">
                            <button class="main-button" type="submit"><i class="fa fa-search"></i>Add Now</button>
                        </fieldset>
                    </div>
                </div>
            </form>
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

