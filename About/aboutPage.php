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
    <div class="about-page">
        <div class="header__navbar not_navbar_at_home">
            <ul class="navbar--list">
                <li class="navbar--item">
                    <a href="/Web_HospitalManagement" class="navbar--item-link">HOME</a>
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
                    <a href="/Web_HospitalManagement/About/aboutPage.php" class="navbar--item-link is-active-in-navbar">About</a>
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
                                <?php if(empty($_SESSION['avatar'])){ ?>
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

        <div class="body">
            <div class="mini_nav">
                <div class="mini_head">
                    About
                </div>
                <div class="mini_card center">
                    <ul class="opt_list center">
                        <li class="index center">
                            <button>
                                <i class="fas fa-hospital mini-icon"></i>
                                Our Hospital
                                <div class="current"></div>
                            </button>
                        </li>
                        <li class="index center">
                            <button>
                                <i class="fas fa-user-md mini-icon"></i>
                                Our Staff
                            </button>
                        </li>
                        <li class="index center">
                            <button>
                                <i class="fas fa-gem mini-icon"></i>
                                Our Facilities
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content hospital">
                <div class="photo">

                </div>

                <div class="p_card">
                    <h1 class="h_title">TA TEMPLATE HOSPITAL</h1>
                    <h2 class="h_slogan">Where Care Come First</h2>
                    <p class="h_content">
                        TA Template Hospital is a regional medical center serving Grimmtale nation. It is a major academic affiliate of Superman School of Medicine and a member of Superman New Haven Health.
                        We represent all medical specialties and offer a wide range of medical, surgical, diagnostic and wellness programs. High quality care, coupled with TA Template Hospital’s convenient location, are reasons many patients choose to be treated here.
                    </p>
                    <p class="content-contact">Address : XX AAA....</p>
                    <p>Hotline : XX AAA....</p>
                    <p>Email : XX AAA@Mail.com</p>
                </div>
            </div>
            <div class="content staff">
                <div class="column center">
                    <div class="doctor center">
                        <div class="doc_photo center">
                            <i class="far fa-user photo_icon"></i>
                        </div>

                        <div class="photo_foot center">
                            <div class="circle"></div>

                            <div class="doc_info">
                                <p class="doc_name">Dr.Name</p>
                                <p class="doc_field">- Specialized Field</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="column center take_remain_space">
                    <div class="p_card center">
                        <h1 class="d_title">OUR STAFF</h1>
                        <p class="d_content">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat quam provident repudiandae
                            quaerat assumenda quod, esse cum a consectetur, voluptas porro accusantium autem quae
                            incidunt delectus, harum impedit officiis ipsam?
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi similique quidem voluptate
                            cupiditate sint, eum, sunt ducimus non beatae suscipit dolorem? Rerum aliquam delectus
                            veniam, illum alias sit sint id.
                        </p>
                    </div>

                    <ul class="doc_list">

                        <li class="doctor center">
                            <div class="doc_photo center">
                                <i class="far fa-user photo_icon"></i>
                            </div>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Name</p>
                                </div>
                            </div>
                        </li>
                        <li class="doctor center">
                            <div class="doc_photo center">
                                <i class="far fa-user photo_icon"></i>
                            </div>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Name</p>
                                </div>
                            </div>
                        </li>
                        <li class="doctor center">
                            <div class="doc_photo center">
                                <i class="far fa-user photo_icon"></i>
                            </div>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Name</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="content facility">
                <div class="fc_card">
                    <h1 class="fc_title">OUR FACILITIES</h1>
                    <p class="fc_content">
                        BLAH BLAH
                    </p>
                </div>

                <ul class="photo_list center">
                    <li class="contain center">
                        <div class="photo center">
                            <i class="far fa-image photo_icon"></i>
                        </div>
                        <div class="photo center">
                            <i class="far fa-image photo_icon"></i>
                        </div>
                    </li>
                    <li class="contain center take_remain_space">
                        <div class="photo whole center">
                            <i class="far fa-image photo_icon"></i>
                        </div>
                    </li>
                    <li class="contain center">
                        <div class="photo center">
                            <i class="far fa-image photo_icon"></i>
                        </div>
                        <div class="photo center">
                            <i class="far fa-image photo_icon"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer__content footer_in_about">
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