<?php
session_start();
?>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="../pages/index.php" class="logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="../pages/index.php" class="active">Home</a></li>
                        <?php
                        if(isset($_SESSION['permission'])){
                            switch ($_SESSION['permission']){
                                case 2:
                                    echo '<li><a href="../pages/favourites.php">Favourites</a></li>';
                                    echo '<li><a href="../pages/make_tour.php ">My Tours</a></li>';
                                    echo '<li><a href="../pages/logout.php">Log Out</a></li>';
                                    break;
                                case 3:
                                    echo '<li><a href="../pages/make_attractions.php">Attractions</a></li>';
                                    echo '<li><a href="../pages/statistic.php">Statistics</a></li>';
                                    echo '<li><a href="../pages/logout.php">Log Out</a></li>';
                                    break;
                                default:
//                                    echo '<li><a href="../pages/login.php">LogIn</a></li>';
//                                    echo '<li><a href="../pages/cities.php">Cities</a></li>';

                            }
                        }
                        else{
                            echo '  <li><a href="../pages/login.php">LogIn</a></li>
                                    <li><a href="../pages/cities.php">Cities</a></li>
                                    <li><a href="../contact.html">Contact Us</a></li>';
                        }
                        ?>

                        <li><div class="main-white-button"><a href="#"><i class="fa fa-plus"></i> Add Your Tours</a></div></li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
