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
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-plot-listing.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
<?php
include '../includes/header.php';
require_once '../includes/config.php';
require_once '../includes/db_config.php';
$pdo = connectDatabase($dsn, $pdoOptions);
?>
<script>
    $(document).ready(function () {
        $(".update_button").click(function (){
           $('input[name="attraction_name"]').val($(this).attr('name-data'));
           $('input[name="longitude"]').val($(this).attr('longitude-data'));
           $('input[name="lattitude"]').val($(this).attr('lattitude-data'));
           //$('#update_save').attr('attraction-data', $(this).attr('attraction-data'))
           $('input[name="attraction_id"]').val($(this).attr('attraction-data'))

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
                attraction_id: $('.update_input_id').val(),
                name: $('.update_input_name').val(),
                longitude: $('.update_input_longitude').val(),
                lattitude: $('.update_input_lattitude ').val(),
                action: 'update_attraction',
            }, function (data){
                if (data.success) {
                    location.reload();
                    alert(data.msg);
                } else {
                    alert(data.msg);
            }
            }, 'json');
        });
        $(".delete").click(function (){
            $.post("../includes/process.php", {
                attraction_id: $('.update_input_id').val(),
                action: 'delete_attraction',
            }, function (data){
                location.reload();
            }, 'json');
        });
    });
</script>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h2>Make attraction</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <form id="search-form" name="make_attraction" method="post" action="../includes/process.php" role="make_attraction" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" id="attraction" name="attraction" class="searchText" placeholder="Attraction name" autocomplete="on" required>
                            </fieldset>
                        </div>
                        <select name="category_id" >
                            <?php
                            $sql = "SELECT category_id, category FROM categories";
                            $query = $pdo->query($sql);
                            $cities = $query->fetchAll();?>
                            <?php foreach ($cities as  $city){ ?>
                                <option class="searchText" value="<?php echo $city['category_id'];?>" name="city_id"><?php echo $city['category']?></option>';
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

                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="text" id="address" name="address" class="searchText" placeholder="Address" required>
                            </fieldset>
                        </div>
                        <div class="col-lg-8 align-self-center">
                            <textarea name="description" id="description" class="searchText" cols="30" rows="5" placeholder="Description">
                            </textarea>
                        </div>
                        <div class="col-lg-8 align-self-center">
                            <fieldset>
                                <input type="file" id="image" name="image" placeholder="image" accept="image/jpeg">
                                <div id="imageHelp">
                                    Upload only JPG images!
                                </div>
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
                <form id="search-form" name="update_attraction" method="post" role="update_attraction">
<!--                   <div id="search-form" name="update_attraction" role="update_attraction">-->
                       <div class="backdrop"></div>
                       <div id="update_window" class="modal">
                           <div class="close">x</div>
                           <h3>Update Attraction</h3>
                           <div class="col-lg-8 align-self-center">
                               <fieldset>
                                   <input type="text" id="update_attraction" name="attraction_name" class="searchText update_input_name" placeholder="Attraction name" autocomplete="on" required>
                               </fieldset>
                               <div class="col-lg-8 align-self-center">
                                   <fieldset>
                                       <input type="text" id="update_longitude" name="longitude" class="searchText update_input_longitude" placeholder="Longitude"  required>
                                   </fieldset>
                               </div>
                               <div class="col-lg-8 align-self-center">
                                   <fieldset>
                                       <input type="text" id="update_lattitude" name="lattitude" class="searchText update_input_lattitude" placeholder="Lattitude" required>
                                   </fieldset>
                               </div>
                               <div class="col-lg-3">
                                   <fieldset>

                                       <button class="main-button update_save" type="submit"><i class="fa fa-search"></i>Update Now</button>
                                   </fieldset>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <?php
                           $sql = "SELECT attraction_id, name, longitude, lattitude, num_of_visitors, popular FROM attractions WHERE org_id = :org_id";
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
                                            <td><a href="attraction.php?attraction_id='.$attraction['attraction_id'].'">' . $attraction['name'] . '</a></td>
                                            <td>' . $attraction['longitude'] . '</td>
                                            <td>' . $attraction['lattitude'] . '</td>
                                            <td>' . $attraction['num_of_visitors'] . '</td>
                                            <td>' . $attraction['popular'] . '</td>
                                            <input type="hidden" name="action" value="update_attraction">
                                            <td><button type="button" attraction-data="'.$attraction['attraction_id'].'" 
                                            name-data="'.$attraction['name'].'"
                                            longitude-data="'.$attraction['longitude'].'" 
                                            lattitude-data="'.$attraction['lattitude'].'"
                                            class="update_button"><i class="bi bi-pencil"></i></button></td>
                                            <input type="hidden" name="attraction_id" class="update_input_id" value="'.$attraction['attraction_id'].' />

                                            <input type="hidden" name="action" value="delete_attraction">

                                            <td><button attraction-data="'.$attraction['attraction_id'].'"
                                             class="delete">
                                            <i class="bi bi-trash3"></i></button></td>
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
<!--                   </div>-->

                   <!-- itt volt-->
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../includes/footer.php';
?>

<!-- Scripts -->
<!--<script src="../vendor/jquery/jquery.min.js"></script>-->
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/owl-carousel.js"></script>
<script src="../assets/js/animation.js"></script>
<script src="../assets/js/imagesloaded.js"></script>
<script src="../assets/js/custom.js"></script>
<!--<script src="../vendor/jquery/jquery.min.js"></script>-->

</body>

</html>

