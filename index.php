<?php
require "./php/ConnectionConfig/DataBase.php";
require "./php/News/News.php";
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

$list = News::fetchFourLatestNews();
$slideCurr = 0;

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
        <div class="head-contact roboto">
            <i class="fas fa-envelope icon"></i>
            <p class="info">healthcare@gmail.com</p>
            <i class="fas fa-map-marker-alt icon"></i>
            <p class="info">XX AAAA Street, Dien Bien Phu</p>
            <i class="fas fa-phone right-icon"></i>
            <p class="right-info">823 4565 13456</p>

        </div>

        <div class="container">
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
                            <?php elseif ($_SESSION['position'] == "doctor" && $_SESSION['specialized_field'] == "Tổng quát") : ?>
                                <a href="/Web_HospitalManagement/Doctor/patientCaring.php" class="navbar--item-link">Workspace</a>
                            <?php elseif ($_SESSION['position'] == "doctor" && $_SESSION['specialized_field'] != "Tổng quát") : ?>
                                <a href="/Web_HospitalManagement/Doctor/patientAsigned.php" class="navbar--item-link">Workspace</a>
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
                                    <img class="nav-avatar" src="<?php echo $_SESSION["avatar"] ?>"></img>
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
            <div class="container__background">


                <div class="container__logo">
                    <div class="logo--background">
                        <div class="logo--content">
                            <i class="icon fas fa-hospital"></i>
                            <h1 class="logo-title">GENERAL CLINIC</h1>
                            <h1 class="logo-slogan">Where Care Come First</h1>
                            <a class="learn-more" href="/Web_HospitalManagement/About/aboutPage.php">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-background">
                <div class="info-cards roboto">
                    <div class="info-card">
                        <div class="info-header center flex-column">
                            <i class="far fa-clock icon"></i>
                            <p class="sub-title">Timing schedule</p>
                            <p class="title">Working Hours</p>
                        </div>
                        <div class="info-content center flex-column">
                            <div class="time">
                                <p>Mon-Fri:</p>
                                <p>7:00 - 18:00</p>
                            </div>

                            <div class="time">
                                <p>Sat-Sun:</p>
                                <p>10:00 - 18:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-header center flex-column">
                            <i class="fas fa-headset icon"></i>
                            <p class="sub-title">Emegency cases</p>
                            <p class="title">1-800-700-6200</p>
                        </div>
                        <div class="info-content center flex-column">
                            <p class="para">Get instant support for emegency.</p>
                            <p class="para">We have introduced the principle of family medicine.</p>
                            <p class="para">Get connected with us for any urgency.</p>
                        </div>
                    </div>
                </div>

                <div class="header__news flex-column">
                    <div class="header__news--background center flex-column">
                        <?php
                        $index = 1;
                        while ($listItem = $list->fetch_assoc()) {
                        ?>
                            <div class="slide-item fade center">
                                <div class="news-para roboto">
                                    <p class="title"><?php echo $listItem['news_title'] ?></p>
                                    <p class="content">
                                        <?php echo $listItem['news_content'] ?>
                                    </p>
                                </div>
                                <img class="news-thumpnail" src="<?php echo $listItem['news_img'] ?>"></img>
                            </div>
                        <?php } ?>
                        <div class="news--btn sh-btn-back center" onclick="return plusSlides(-1);">
                            <i class="fas fa-angle-left sh-btn-icon"></i>
                        </div>
                        <div class="news--btn sh-btn-next center" onclick="return plusSlides(1);">
                            <i class="fas fa-angle-right sh-btn-icon"></i>
                        </div>
                        <div class="center dots">
                            <?php
                            $list->data_seek(0);
                            $dotIndex = 1;
                            while ($listItem = $list->fetch_assoc()) {
                            ?>
                                <span id="<?php echo $dotIndex ?>" class="dot" onclick="return currentSlide(<?php echo $dotIndex ?>);"></span>
                            <?php
                                $dotIndex += 1;
                            }
                            ?>
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

    <script type="text/javascript">
        var slideIndex = 1;
        showSlides(slideIndex);

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("slide-item");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].classList.add("hide");
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" slide-active", "");
            }
            slides[slideIndex - 1].classList.remove('hide');
            dots[slideIndex - 1].className += " slide-active";
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
    </script>

</body>

</html>