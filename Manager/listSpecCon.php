<?php
session_start();
require "../php/ConnectionConfig/DataBase.php";
require "../php/SpecialConsulting/SpecCon.php";


$count = SpecCon::fetchCountTotal();
if($count->num_rows > 0){
    $row = $count->fetch_assoc();
    $total_records = $row['total'];
}

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;
$result = SpecCon::fetchSpecConPage($start, $limit);
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
                    <a href="/Web_HospitalManagement/Manager/listSpecCon.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
    <!-- Workspace for Manager -->
    <div class="container">
        <div class="container__background_color">
            <div class="container__menu">
                <div class="box menu__box first__box">
                    <p>Account Lists</p>
                    <ul>
                        <li class="has-border-bottom">
                            <i class="fas fa-users-cog"></i>
                            <a href="/Web_HospitalManagement/Manager/accountManager.php">Manager Account</a>
                        </li>
                        <li class="has-border-bottom">
                            <i class="fas fa-concierge-bell"></i>
                            <a href="/Web_HospitalManagement/Manager/accountRecept.php">Receptionist Accounts</a>
                        </li>
                        <li class="has-border-bottom">
                            <i class="fas fa-stethoscope"></i>
                            <a href="/Web_HospitalManagement/Manager/accountDoctor.php">Doctor Account</a>
                        </li>
                        <li>
                            <i class="fas fa-pills"></i>
                            <a href="/Web_HospitalManagement/Manager/accountPharma.php">Pharmacist Account</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Form Lists</p>
                    <ul>
                        <li class="has-border-bottom">
                            <i class="fas fa-comment-medical"></i>
                            <a href="/Web_HospitalManagement/Manager/listMedical.php">Medical Register</a>
                        </li>
                        <li class="has-border-bottom is-active-in-menu">
                            <i class="fas fa-hand-holding-medical"></i>
                            <a href="/Web_HospitalManagement/Manager/listSpecCon.php">Special Consulting Register</a>
                        </li>
                        <li>
                            <i class="fas fa-briefcase-medical"></i>
                            <a href="/Web_HospitalManagement/Manager/listPrescription.php">Prescription</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container__content">
                <ul class="card-list">
                    <?php if ($result->num_rows > 0) {
                        // Load dữ liệu lên website
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <li class="card-drop">
                        <input type="checkbox" />
                        <div class="short-card">
                            <div class="inner-card">
                                <div class="inner-detail">
                                    <div class="datetime-containter">
                                        <p class="i-datetime">Date:
                                        <p class="i-value i-datetime"><?php echo $row["created_date"]; ?></p>
                                        </p>
                                    </div>
                                    <p class="i-title">
                                        Patient Full Name:
                                    <p class="i-value short-text"><?php echo $row["pat_name"]; ?></p>
                                    <p class="i-title">
                                        Age:
                                    <p class="i-value"><?php echo $row["pat_age"]; ?></p>
                                    </p>
                                    <p class="i-title">
                                        Text Area:
                                    <p class="i-value medium-text">
                                        <?php echo $row["test_area"]; ?>
                                    </p>
                                    </p>
                                    <p class="i-title change-element">
                                        Reason:
                                    <p class="i-value long-text">
                                        <?php echo $row["spec_reason"]; ?>
                                    </p>
                                    </p>
                                </div>
                                <div class="switch-container center">
                                    <p class="switch-lable">Status</p>
                                    <label class="switch">
                                        <?php if ($row["spec_status"] == 'enabled') {?>
                                            <input type="checkbox" checked>
                                            <span class="slider round"></span>
                                        <?php } else { ?>
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        <?php } ?>
                                    </label>
                                </div>
                                <div class="icon-container center">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="full-card">
                            <div class="inner-card">
                                <div class="inner-detail has-border-top">
                                    <p class="i-title">
                                        Phone Number:
                                    <p class="i-value  medium-text">
                                        <?php echo $row["pat_phone"]; ?>
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        Job:
                                    <p class="i-value medium-text">
                                        <?php echo $row["pat_job"]; ?>
                                    </p>
                                    </p>
                                    <p class="i-title change-element ">
                                        Address:
                                    <p class="i-value medium-text">
                                        <?php echo $row["pat_address"]; ?>
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        Doctor's Name:
                                    <p class="i-value medium-text">
                                        <?php echo $row["creator_name"]; ?>
                                    </p>
                                    </p>
                                </div>
                                <div class="switch-container center">
                                </div>
                                <div class="icon-container center">
                                    <i class="fas fa-print"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                        }
                    }
                    // $conn->close();
                    ?>
                    <div class="pagination center">
                        <?php
                        if ($current_page > 1 && $total_page > 1) {
                            echo '<a class="page" href="/Web_HospitalManagement/Manager/listSpecCon.php?page=' . ($current_page - 1) . '">Prev</a> ';
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="page active" >' . $i . '</span> ';
                            } else {
                                echo '<a class="page" href="/Web_HospitalManagement/Manager/listSpecCon.php?page=' . $i . '">' . $i . '</a> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="page" href="/Web_HospitalManagement/Manager/listSpecCon.php?page=' . ($current_page + 1) . '">Next</a> ';
                        }
                        ?>
                    </div>
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