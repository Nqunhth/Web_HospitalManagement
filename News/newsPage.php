<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthCareManagement</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../icon/fontawesome-free-5.15.4-web/css/all.min.css">

    <!--"Roboto" & "M PLUS Rounded 1c font" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="news-page center">
        <div class="header__navbar not_navbar_at_home">
            <ul class="navbar--list">
                <li class="navbar--item">
                    <a href="/Web_HospitalManagement" class="navbar--item-link">HOME</a>
                </li>
                <li class="navbar--item">
                    <a href="/Web_HospitalManagement/News/newsPage.php" class="navbar--item-link is-active-in-navbar">News</a>
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


        <div class="body roundedfont">
            <div class="left_bar">
                <div class="bar_head">
                    News
                </div>
                <ul class="news_list">
                    <li class="news_item center">
                        <div class="thumpnail center">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="news_description">
                            <div class="news_des_head">
                                <h2 class="title">The Longer Title</h2>
                                <p class="author">- My Name Is</p>
                            </div>
                            <div class="des_content_container">
                                <p class="des_content">
                                    This is a demo running content of a news post description!
                                </p>
                            </div>
                            <p class="update_time">
                                YYYY-MM-DD : hh:mm:ss
                            </p>
                        </div>
                    </li>
                    <li class="news_item center">
                        <div class="thumpnail center">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="news_description">
                            <div class="news_des_head">
                                <h2 class="title">The Longer Title</h2>
                                <p class="author">- My Name Is</p>
                            </div>
                            <div class="des_content_container">
                                <p class="des_content">
                                    This is a demo running content of a news post description!
                                </p>
                            </div>
                            <p class="update_time">
                                YYYY-MM-DD : hh:mm:ss
                            </p>
                        </div>
                    </li>
                </ul>
                <div class="bar_foot">
                    See more
                </div>
            </div>


            <div class="full_news center">
                <div class="fn_header">
                    <div class="fn_title">
                        <h1>NEWS TITLE</h1>
                        <h3>News Heading</h3>
                    </div>
                    <div class="author_time">
                        <p>Author</p>
                        <p>YYYY-MM-DD : hh:mm:ss</p>
                    </div>
                </div>
                <div class="fn_content center">
                    <div class="fn_image center">
                        <i class="far fa-image icon"></i>
                    </div>
                    <p class="fn_paragraph">
                        This beautiful PV was made by RyuO, the vocals are sang by the amazing Rachie,. The original
                        Korean vocals and lyrics were done by Ir (이르/ @Gigant_ir). The song is originally from Steven
                        Universe. We worked in collaboration to provide this version! Please follow RyuO on youtube
                    </p>
                </div>

            </div>
        </div>

    </div>
</body>

</html>