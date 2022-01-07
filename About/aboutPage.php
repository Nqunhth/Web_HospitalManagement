<?php

session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthCareManagement</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../lib/fontawesome-free-5.15.4-web/css/all.min.css">

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

        <div class="body">
            <div class="mini_nav">
                <div class="mini_head">
                    About
                </div>
                <div class="mini_card center">
                    <ul class="opt_list center">
                        <li class="index center">
                            <a href="#hospital">
                                <button>
                                    <i class="fas fa-hospital mini-icon"></i>
                                    Our Hospital
                                    <div class="current hide"></div>
                                </button>
                            </a>
                        </li>
                        <li class="index center">
                            <a href="#staff">
                                <button>
                                    <i class="fas fa-user-md mini-icon"></i>
                                    Our Staff
                                    <div class="current hide"></div>
                                </button>
                            </a>
                        </li>
                        <li class="index center">
                            <a href="#facility">
                                <button>
                                    <i class="fas fa-gem mini-icon"></i>
                                    Our Facilities
                                    <div class="current hide"></div>
                                </button>
                            </a>
                        </li>
                        <li class="index center">
                            <a href="#contact">
                                <button>
                                    <i class="fas fa-phone mini-icon"></i>
                                    Contact
                                    <div class="current hide"></div>
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="hospital" class="content hospital">
                <div class="photo">

                </div>

                <div class="p_card">
                    <h1 class="h_title">GENERAL CLINIC HOSPITAL</h1>
                    <h2 class="h_slogan">Where Care Come First</h2>
                    <p class="h_content">
                        General Clinic Hospital is a regional medical center serving Vietnam. It is a major academic affiliate of Superman School of Medicine and a member of Superman New Haven Health.
                        We represent all medical specialties and offer a wide range of medical, surgical, diagnostic and wellness programs. High quality care, coupled with General Clinic Hospital’s convenient location, are reasons many patients choose to be treated here.
                    </p>
                    <p class="content-contact">Address : 73 Dien Bien Phu, Hai Phong</p>
                    <p class="content-contact">Hotline : 823 4565 13456</p>
                    <p>Email : XX AAA@Mail.com</p>
                </div>
            </div>
            <div id="staff" class="content staff">
                <div class="column center">
                    <div class="doctor center">
                        <img class="doc_photo center" src="https://www.pinnaclecare.com/wp-content/uploads/2017/12/bigstock-African-young-doctor-portrait-28825394.jpg"></img>

                        <div class="photo_foot center">
                            <div class="circle"></div>

                            <div class="doc_info">
                                <p class="doc_name">Dr.Miraelle Oddmen</p>
                                <p class="doc_field">- Brain and Psychology</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="column center take_remain_space">
                    <div class="p_card center">
                        <h1 class="d_title">OUR STAFF</h1>
                        <p class="d_content">
                            We are TA Template Hospital, seeing more than 1 million patients annually. We are one of the country’s
                            largest not-for-profit freestanding pediatric health care networks. Our nearly 12,000 hospital staff and
                            1,000 medical staff have been providing the best possible care since 1892.
                            The doctors here are professional, hospitable and friendly with the purpose
                            of providing best services from 6:00 a.m to 9:00 p.m (everyday, even in weekends).
                        </p>
                    </div>

                    <ul class="doc_list">

                        <li class="doctor center">
                            <img class="doc_photo center" src="https://www.independent.ie/irish-news/education/671f1/40328133.ece/AUTOCROP/w620/A%20young%20caring%20doctor">

                            </img>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Jullian Catherine</p>
                                </div>
                            </div>
                        </li>
                        <li class="doctor center">
                            <img class="doc_photo center" src="https://www.fvhospital.com/wp-content/uploads/2021/11/Dr-Nguyen-Anh-Hoang.jpg">
                            </img>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Nguyễn Sinh Hóa</p>
                                </div>
                            </div>
                        </li>
                        <li class="doctor center">
                            <img class="doc_photo center" src="https://static.standard.co.uk/2021/11/19/14/PHOTO-2021-11-18-11-54-13.jpg?width=640&auto=webp&quality=75&crop=768%3A1024%2Csmart">
                            </img>

                            <div class="photo_foot center">
                                <div class="circle"></div>

                                <div class="doc_info">
                                    <p class="doc_name">Dr.Kevin Nguyên</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div id = "facility" class="content facility">
                <div class="fc_card">
                    <h1 class="fc_title">OUR FACILITIES</h1>
                    <p class="fc_content">
                        Patients who choose the General Clinic Hospital will have access to timely care, overseen by
                        an emergency physician. In the event a person requires admission.
                        General Clinic Hospital has over 200 admitting specialists in a wide variety of medical specialties.
                    </p>
                    <p class="fc_content">
                        Acute Admissions Assessment Centre is able to take acutely unwell patients,
                        while the Intensive Care and Coronary Care units have monitoring equipment and staff
                        who specialise in caring for high dependency patients.
                    </p>
                    <p class="fc_content">
                        Our Angiography Suite is recognised as one of the most advanced in South East Asia.
                        Our 20 theatres contain some of the most innovative technologies including robotic surgery capability.
                    </p>
                </div>

                <ul class="photo_list center">
                    <li class="contain center">
                        <img class="photo fc-photo center" src="https://health.wyo.gov/wp-content/uploads/2017/05/busy-hospital-hallway.jpg"></img>
                        <img class="photo fc-photo center" src="https://img.medicalexpo.com/images_me/photo-g/96423-16130609.jpg"></img>
                    </li>
                    <li class="contain center take_remain_space">
                        <img class="photo fc-photo whole center" src="https://i.pinimg.com/originals/0b/32/d3/0b32d3dd127e774a9847dd7653a9723d.jpg">
                        </img>
                    </li>
                    <li class="contain center">
                        <img class="photo fc-photo center" src="https://callidus.ca/wp-content/uploads/2017/02/Callidus-Toronto-General-Hospital-Trigor.jpg"></img>
                        <img class="photo fc-photo center" src="https://www.medistarcorp.com/wp-content/uploads/sites/9679/2016/07/PAM-Bay-Area-Rehab-Hospital-Therapy-Gym-a.jpg"></img>
                    </li>
                </ul>
            </div>
        </div>

        <div id="contact" class="footer__content footer_in_about">
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