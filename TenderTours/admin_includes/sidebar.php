<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="../admin_pages/index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Organizations</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../admin_pages/add_organizations.php">
                        <i class="bi bi-circle"></i><span>Add organizations</span>
                    </a>
                </li>
                <li>
                    <a href="../../Admin/Admin/components-accordion.html">
                        <i class="bi bi-circle"></i><span>Organizations</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Cities</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="../../Admin/Admin/components-badges.html">
                        <i class="bi bi-circle"></i><span>Add a new city</span>
                    </a>
                </li>
                <li>
                    <a href="../../Admin/Admin/components-breadcrumbs.html">
                        <i class="bi bi-circle"></i><span>Cities</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../Admin/Admin/users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="../../Admin/Admin/users-profile.html">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li>
<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="../../Admin/Admin/pages-faq.html">-->
<!--                <i class="bi bi-question-circle"></i>-->
<!--                <span>F.A.Q</span>-->
<!--            </a>-->
<!--        </li>-->
        <!-- End F.A.Q Page Nav -->

<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="../../Admin/Admin/pages-contact.html">-->
<!--                <i class="bi bi-envelope"></i>-->
<!--                <span>Contact</span>-->
<!--            </a>-->
<!--        </li>-->
        <!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../Admin/Admin/pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../Admin/Admin/pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="../../Admin/Admin/pages-error-404.html">-->
<!--                <i class="bi bi-dash-circle"></i>-->
<!--                <span>Error 404</span>-->
<!--            </a>-->
<!--        </li>-->
        <!-- End Error 404 Page Nav -->

<!--        <li class="nav-item">-->
<!--            <a class="nav-link collapsed" href="../../Admin/Admin/pages-blank.html">-->
<!--                <i class="bi bi-file-earmark"></i>-->
<!--                <span>Blank</span>-->
<!--            </a>-->
<!--        </li>-->
        <!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

</body>
</html>
