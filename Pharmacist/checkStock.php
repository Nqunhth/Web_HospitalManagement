<?php
session_start();
require "../Models/ConnectionConfig/DataBase.php";
require "../Models/Medicine/Medicine.php";

$db = new Database();
$conn = $db->dbConnect();

$count = Medicine::fetchCountTotal();
if ($count->num_rows > 0) {
    $row = $count->fetch_assoc();
    $total_records = $row['total'];
}

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;
$result = Medicine::fetchMedicinePage($start, $limit);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap">
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
                    <a href="/Web_HospitalManagement/Pharmacist/checkStock.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
        <div class="container__background_color">
            <div class="container__menu">
                <div class="box menu__box first__box">
                    <p>Medicines Stock</p>
                    <ul>
                        <li class="is-active-in-menu">
                            <i class="fas fa-box-open"></i>
                            <a href="/Web_HospitalManagement/Pharmacist/checkStock.php">Check in Stock</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Create New Form</p>
                    <ul>
                        <li>
                            <i class="fas fa-receipt"></i>
                            <a href="/Web_HospitalManagement/Pharmacist/formInvoice.php">Invoice</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Forms List</p>
                    <ul>
                        <li>
                            <i class="fas fa-receipt"></i>
                            <a href="/Web_HospitalManagement/Pharmacist/listInvoice.php">Invoice</a>
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
                                            <p class="i-title">
                                                Medicine Name:
                                            <p class="i-value short-text"> <?php echo $row["medicine_name"]; ?></p>
                                            </p>
                                            <p class="i-title">
                                                Unit Price:
                                            <p class="i-value short-text"><?php echo $row["medicine_unit_price"]; ?></p>
                                            </p>
                                        </div>
                                        <div class="switch-container center">
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
                                                Unit:
                                            <p class="i-value short-text"><?php echo $row["medicine_unit"]; ?></p>
                                            </p>
                                            <p class="i-title">
                                                Quantity:
                                            <p class="i-value short-text"><?php echo $row["medicine_quantity"]; ?></p>
                                            </p>
                                            <p class="i-title">
                                                Producer:
                                            <p class="i-value short-text"><?php echo $row["medicine_producer"]; ?></p>
                                            </p>
                                        </div>
                                        <div class="switch-container center">
                                        </div>
                                        <div class="icon-container center">
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
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page=' . ($current_page - 1) . '">Prev</a> ';
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="page active" >' . $i . '</span> ';
                            } else {
                                echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page=' . $i . '">' . $i . '</a> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page=' . ($current_page + 1) . '">Next</a> ';
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