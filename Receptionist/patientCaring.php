<?php
require "../php/ConnectionConfig/DataBase.php";
require "../php/Patient/Patient.php";

session_start();

$result = Patient::fetchCaringPatient()

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

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../icon/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body>
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
                    <a href="/Web_HospitalManagement/Receptionist/patientCaring.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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

    <div class="container">
        <div class="container__background_color placeholder">
            <div class="container__menu">
                <div class="box menu__box first__box">
                    <p>Patient List</p>
                    <ul>
                        <li class="is-active-in-menu">
                            <i class="fas fa-user-injured"></i>
                            <a href="/Web_HospitalManagement/Receptionist/patientCaring.php">Caring</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Ceate New Form</p>
                    <ul>
                        <li>
                            <i class="fas fa-notes-medical"></i>
                            <a href="/Web_HospitalManagement/Receptionist/formMedical.php">Medical Register Form</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container__content">
                <?php if ($result->num_rows > 0) { ?>
                    <ul class="card-list">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <li class="card-drop">
                                <input type="checkbox" />
                                <div class="short-card">
                                    <div class="number-card">
                                        <h1> <?php echo $row['queue_number'] ?> </h1>
                                    </div>
                                    <div class="inner-card">
                                        <div class="inner-detail">
                                            <p class="i-title">
                                                Patient Full Name:
                                            <p class="i-value short-text-inwaiting"><?php echo $row['pat_name'] ?></p>
                                            <p class="i-title">
                                                Age:
                                            <p class="i-value"><?php echo $row['pat_age'] ?></p>
                                            </p>
                                            </p>
                                            <p class="i-title change-element">
                                                Reason:
                                            <p class="i-value long-text">
                                                <?php echo $row['medi_reason'] ?>
                                            </p>
                                            </p>
                                        </div>
                                        <div class="switch-container center">
                                            <?php if ($_SESSION['position'] == "doctor") : ?>
                                                <label class="switch-inwaiting">
                                                    <input type="checkbox">
                                                    <!-- <span class="slider round"></span> -->
                                                </label>
                                            <?php endif ?>
                                        </div>
                                        <div class="icon-container center">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="full-card">
                                    <div class="number-card">
                                    </div>
                                    <div class="inner-card">
                                        <div class="inner-detail has-border-top">
                                            <p class="i-title">
                                                Phone Number:
                                            <p class="i-value  medium-text-inwaiting">
                                                <?php echo $row['pat_phone'] ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Job:
                                            <p class="i-value medium-text-inwaiting">
                                                <?php echo $row['pat_job'] ?>
                                            </p>
                                            </p>
                                            <p class="i-title change-element ">
                                                Address:
                                            <p class="i-value medium-text-inwaiting">
                                                <?php echo $row['pat_address'] ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Doctor's Name:
                                            <p class="i-value medium-text-inwaiting">
                                                <?php echo $row['doctor_name'] ?>
                                            </p>
                                            </p>
                                            <?php if ($_SESSION['position'] == "doctor") : ?>
                                                <p class="i-title">
                                                    List of Specialists Consulting Rooms (or Analysis):
                                                </p>
                                                <input type="text" class="long-input" name="patient" value="Load data from Database" readonly>
                                            <?php endif ?>
                                        </div>
                                        <div class="switch-container center">
                                        </div>
                                        <div class="icon-container center">
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php }
                    } ?>
                    </ul>
            </div>
            <div class="container__floatbutton">
                <a href="" class="float" id="button-up">
                    <i class="fas fa-arrow-up"></i>
                </a>
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
</body>

</html>