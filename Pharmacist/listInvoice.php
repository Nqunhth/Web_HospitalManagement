<?php
session_start();
require "../Models/ConnectionConfig/DataBase.php";
require "../Models/Invoice/Invoice.php";
require "../Models/Invoice/InvoiceMedicine.php";

$db = new Database();
$conn = $db->dbConnect();

$count = Invoice::fetchCountTotal();
if ($count->num_rows > 0) {
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
$result = Invoice::fetchInvoicePage($start, $limit);

if (isset($_POST['switch-change'])) {
    if (isset($_POST['invo-id'])) {
        if ($_POST['switch-change'] == "enable") {
            Invoice::disableForm($_POST['invo-id']);
        }
        if ($_POST['switch-change'] == "disable") {
            Invoice::enableForm($_POST['invo-id']);
        }
    }
}
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
                    <a href="/Web_HospitalManagement/Pharmacist/listInvoice.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
                        <li>
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
                        <li class="is-active-in-menu">
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
                            $onShow = '';
                            $list_medi = InvoiceMedicine::fetchInMe($row["invo_id"]);
                            if ($list_medi->num_rows > 0) {
                                // Load dữ liệu lên website
                                while ($medi = $list_medi->fetch_assoc()) {
                                    if ($onShow == '')
                                        $onShow = $medi['medicine_id'] . '-' . $medi['medicine_name'] . ' ' . $medi['quantity'] . ' ' . $medi['cost'] . ' ' . "VND";
                                    else
                                        $onShow = $onShow . '; ' . $medi['medicine_id'] . '-' . $medi['medicine_name'] . ' ' . $medi['quantity'] . ' ' . $medi['cost'] . ' ' . "VND";
                                }
                            }
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
                                                Customer Full Name:
                                            <p class="i-value short-text"><?php echo $row["cus_name"]; ?></p>
                                            </p>
                                            <p class="i-title">
                                                Address:
                                            <p class="i-value short-text"><?php echo $row["cus_address"]; ?></p>
                                            </p>
                                            <p class="i-title">
                                                Total Bill:
                                            <p class="i-value short-text"><?php echo $row["sum_cost"]; ?> VND</p>
                                            </p>
                                        </div>
                                        <form class="switch-container center" method="post" action="">
                                            <p class="switch-lable">Status</p>
                                            <label class="switch">
                                                <?php
                                                if (isset($_POST['switch-change']) && isset($_POST['invo-id']) && $_POST['invo-id'] == $row["invo_id"]) {
                                                    if ($_POST['switch-change'] == "disable") {
                                                ?>
                                                        <input class="" name="enable" value="<?php echo $row["invo_id"] ?>" type="checkbox" checked onclick="return showBox(event);">
                                                        <span class="slider round"></span>
                                                    <?php } else { ?>
                                                        <input class="" name="disable" value="<?php echo $row["invo_id"] ?>" type="checkbox" onclick="return showBox(event);">
                                                        <span class="slider round"></span>
                                                    <?php }
                                                } else {
                                                    if ($row["invo_status"] == 'enabled') { ?>
                                                        <input class="" name="enable" value="<?php echo $row["invo_id"] ?>" type="checkbox" checked onclick="return showBox(event);">
                                                        <span class="slider round"></span>
                                                    <?php } else { ?>
                                                        <input class="" name="disable" value="<?php echo $row["invo_id"] ?>" type="checkbox" onclick="return showBox(event);">
                                                        <span class="slider round"></span>
                                                <?php }
                                                } ?>
                                            </label>
                                        </form>
                                        <div class="icon-container center">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="full-card">
                                    <div class="inner-card">
                                        <div class="inner-detail has-border-top">
                                            <p class="i-title">
                                                List of Medicines:
                                            <p class="i-value long-text">
                                                <?php echo $onShow; ?>
                                            </p>
                                            </p>
                                        </div>
                                        <div class="switch-container center">
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
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/listInvoice.php?page=' . ($current_page - 1) . '">Prev</a> ';
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="page active" >' . $i . '</span> ';
                            } else {
                                echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/listInvoice.php?page=' . $i . '">' . $i . '</a> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/listInvoice.php?page=' . ($current_page + 1) . '">Next</a> ';
                        }
                        $conn->close();
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
    <div class="modal center_hide">
        <div class="modal__overlay center">
            <div class="confirm-alert flex-column">
                <div class="alert-header center">
                    <i class="far fa-question-circle alert-icon"></i>
                </div>
                <p class="alert-title roboto"></p>
                <p class="alert-message roboto"></p>
                <form class="alert-opts center" method="post" action="">
                    <input name="invo-id" class="hide invo-id" type="text">
                    <button class="status alert-btn" type="submit" name="switch-change">OK</button>
                    <button class="cancel alert-btn" name="no" value="no" onclick="return closeBox();">No</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const box = document.querySelector('.modal');
        const id = document.querySelector('.invo-id');
        const status = document.querySelector('.status');
        const title = document.querySelector('.alert-title');
        const message = document.querySelector('.alert-message');

        function showBox(e) {
            // box.classList.add('open');
            e = e || window.event;
            var target = e.target || e.srcElement,
                val = target.value,
                sta = target.name;

            box.classList.add('open');
            // alert(val + sta);
            id.value = val;
            status.value = sta;
            if (sta == "enable") {
                title.textContent = "Confirm Disable";
                message.textContent = "Do you want to disable this form?";
            } else {
                title.textContent = "Confirm Enable";
                message.textContent = "Do you want to enable this form?";
            }
            // alert(text);
        }

        function closeBox() {
            // alert(id.value + status.value);
            box.classList.remove('open')
        }
    </script>
</body>

</html>