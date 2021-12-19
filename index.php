<?php

// Starting the session, to use and
// store data in session variable
session_start();


// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['position']);
    header("refresh:0;url=/Web_HospitalManagement");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthCareManagement</title>

    <!--"Roboto" & "M PLUS Rounded 1c font" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap">

    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./icon/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body>
    <div class="home-page">
        <div class="header__news">
            <div class="header__news--img">
                <!-- Slider /// Auto change -->
                <div class="news--btn sh-btn-back center">
                    <i class="fas fa-angle-left sh-btn-icon"></i>
                </div>
                <div class="news--btn sh-btn-next center">
                    <i class="fas fa-angle-right sh-btn-icon"></i>
                </div>
            </div>

            <div class="header__news--newslist">
                <!-- List of news-->
            </div>
        </div>

        <div class="container">
            <div class="container__background">
                <div class="header__navbar">
                    <ul class="navbar--list">
                        <li class="navbar--item">
                            <a href="/" class="navbar--item-link  is-active-in-navbar">HOME</a>
                        </li>
                        <li class="navbar--item">
                            <a href="/Web_HospitalManagement/News/newsPage.php" class="navbar--item-link">News</a>
                        </li>
                        <?php if (!empty($_SESSION['position'])) : ?>
                            <li class="navbar--item has-dropdown-menu">
                                <?php if ($_SESSION['position'] == "manager") : ?>
                                    <a href="/Web_HospitalManagement/Manager/accountManager.php" class="navbar--item-link">Workspace</a>
                                <?php elseif ($_SESSION['position'] == "receptionist") : ?>
                                    <a href="/Web_HospitalManagement/Receptionist/formMedical.php" class="navbar--item-link">Workspace</a>
                                <?php elseif ($_SESSION['position'] == "doctor") : ?>
                                    <a href="/Web_HospitalManagement/Doctor/patientCaring.php" class="navbar--item-link">Workspace</a>
                                <?php elseif ($_SESSION['position'] == "pharmacist") : ?>
                                    <a href="/Web_HospitalManagement/Pharmacist/formInvoice.php" class="navbar--item-link">Workspace</a>
                                <?php endif ?>
                            </li>
                        <?php endif ?>


                        <li class="navbar--item has-dropdown-menu">
                            <a href="/Web_HospitalManagement/About/aboutPage.php" class="navbar--item-link">About</a>
                        </li>
                        <li class="navbar--flex-spacer">
                            <!-- Search Area -->
                        </li>
                        <li class="navbar--item has-dropdown-menu">
                            <?php if (empty($_SESSION['username'])) : ?>
                                <a href="/Web_HospitalManagement/Login/loginPage.php" class="navbar--item-link"><i class="far fa-user"></i></a>
                            <?php else : ?>
                                <a href="/Web_HospitalManagement/User/infoManage.php" class="navbar--item-link">
                                    <?php if (empty($_SESSION['avatar'])) : ?>
                                        <i class="far fa-user"></i>
                                    <?php else : ?>
                                        <img class="nav-avatar" src="<?php echo $_SESSION["avatar"] ?>"></i>
                                    <?php endif ?>
                                </a>
                                <div class="trans-layer">
                                    <div class="dropdown-user center">
                                        <div class="user-info">
                                            <?php if (empty($_SESSION['avatar'])) { ?>
                                                <i class="far fa-user"></i>
                                            <?php } else { ?>
                                                <img class="bar-avatar" src="<?php echo $_SESSION['avatar']; ?>"></img>
                                            <?php } ?>
                                            <p><?php echo $_SESSION['username']; ?></p>
                                            <p><?php echo $_SESSION['email']; ?></p>
                                        </div>
                                        <div class="user user-manage">
                                            <p>My Account</p>
                                            <a href="/Web_HospitalManagement/User/infoManage.php">Account Management<i class="fas fa-chevron-right"></i></a>
                                        </div>
                                        <div class="user user-logout">
                                            <a href="/Web_HospitalManagement/index.php?logout=1">Logout<i class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>

                <div class="container__logo">
                    <div class="logo--background">
                        <div class="logo--content">
                            <i class="icon fas fa-hospital"></i>
                            <h1 class="logo-title">HOSPITAL NAME</h1>
                            <h1 class="logo-slogan">Hospital Slogan</h1>
                            <h3>Short Description...</h3>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="footer__content">
            <div class="content-title">
                <p>Contact:</p>
            </div>
            <div class="content-main">
                <div class="main-column">
                    <div class="column-content">
                        <ul class="column-link-list">
                            <li class="column-link-list-item">
                                <p>Address : XX AAA....</p>
                            </li>
                            <li class="column-link-list-item">
                                <p>Hotline : XX AAA....</p>
                            </li>
                            <li class="column-link-list-item">
                                <p>Email : XX AAA@Mail.com</p>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="main-column">
                    <ul class="column-link-list">
                        <li class="column-link-list-item">
                            <p>Address : XX AAA....</p>
                        </li>
                        <li class="column-link-list-item">
                            <p>Hotline : XX AAA....</p>
                        </li>
                        <li class="column-link-list-item">
                            <p>Email : XX AAA@Mail.com</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-conclude">
                <p>Copyright Copyright Pisces/Thu/Anh blah blah blah.....</p>
                <p>More Thing Is Needed</p>
            </div>
        </div>
    </div>
</body>

</html>