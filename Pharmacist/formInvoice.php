<?php
require "../Models/ConnectionConfig/DataBase.php";
require "../Models/Medicine/Medicine.php";
require "../Models/Invoice/Invoice.php";
require "../Controllers/Invoice/CreateInvoice.php";
require "../Models/Invoice/InvoiceMedicine.php";
session_start();
$result = Medicine::fetchMedicine();
if (isset($_POST['submit'])) {
    $error = CreateInvoice::Create();

    if (isset($error) && $error == "Create Successfull") {
        $_SESSION['mediCusName'] = '';
        $_SESSION['mediAddress'] = '';

        CreateInvoice::resetAllSession();
    }
}
if (isset($_POST['reset'])) {
    CreateInvoice::resetAllSession();
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
                    <a href="/Web_HospitalManagement/Pharmacist/formInvoice.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
                        <li class="is-active-in-menu">
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
            <script type="text/javascript">
                function validateForm() {
                    const errorLog = document.querySelector('.js-error');

                    var cusName = document.getElementsByName("mediCusName")[0].value;
                    var cusAddress = document.getElementsByName("mediAddress")[0].value;;

                    var mediName_1 = document.getElementsByName("mediName_1")[0].value;

                    if (cusName == null || cusName == "" || cusAddress == null || cusAddress == "" || mediName_1 == null || mediName_1 == "") {
                        errorLog.classList.remove('hide');
                        // alert("AAAAa")
                        return false;
                    }
                }
            </script>
            <div class="container__content">
                <div class="box content__box">
                    <div class="inner-box">
                        <?php
                        if (isset($error)) {
                        ?>
                            <p class="form-error"><?php echo $error ?></p>
                        <?php } ?>
                        <p class="form-error hide js-error">All fields are required</p>
                        <?php
                        if (empty($_SESSION['mediCusName'])) $_SESSION['mediCusName'] = '';
                        if (empty($_SESSION['mediAddress'])) $_SESSION['mediAddress'] = '';
                        ?>
                        <form action="" method="post">
                            <p class="i-title">
                                Customer Full Name:
                                <input type="text" class="medium-input" name="mediCusName" value="<?php echo isset($_POST["mediCusName"]) ? $_POST["mediCusName"] : $_SESSION['mediCusName'] ?>" onchange="this.form.submit();">

                            </p>
                            <p class="i-title">
                                Address:
                                <input type="text" class="medium-input" name="mediAddress" value="<?php echo isset($_POST["mediAddress"]) ? $_POST["mediAddress"] : $_SESSION['mediAddress'] ?>" onchange="this.form.submit();">
                            </p>
                        </form>
                        <?php
                        if (isset($_POST["mediAddress"]) && isset($_POST["mediCusName"])) {
                            $_SESSION['mediAddress'] = $_POST["mediAddress"];
                            $_SESSION['mediCusName'] = $_POST["mediCusName"];
                        }
                        ?>
                        <div class="i-line">
                            <table>
                                <?php
                                if (empty($_SESSION['mediTotal'])) $_SESSION['mediTotal'] = 0;
                                ?>
                                <tr>
                                    <th>No</th>
                                    <th>Medicine Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                </tr>
                                <datalist id="medicine">
                                    <?php if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['medicine_name'] ?>"></option>
                                    <?php }
                                    } ?>
                                </datalist>
                                <tr>
                                    <td><input type="text" class="short-table" name="mediNo_1" value="1" readonly></td>
                                    <form action="" method="POST">
                                        <td>
                                            <?php
                                            if (empty($_SESSION['mediId_1'])) $_SESSION['mediId_1'] = '';
                                            if (empty($_SESSION['mediName_1'])) $_SESSION['mediName_1'] = '';
                                            if (empty($_SESSION['mediUnit_1'])) $_SESSION['mediUnit_1'] = '';
                                            if (empty($_SESSION['mediUnitPrice_1'])) $_SESSION['mediUnitPrice_1'] = 0;
                                            if (empty($_SESSION['mediQuantity_1'])) $_SESSION['mediQuantity_1'] = 1;
                                            if (empty($_SESSION['mediCost_1'])) $_SESSION['mediCost_1'] = 0;
                                            ?>
                                            <input type="text" list="medicine" class="long-table" name="mediName_1" value="<?php echo isset($_POST['mediName_1']) ? $_POST['mediName_1'] : $_SESSION['mediName_1'] ?>" onchange="this.form.submit();">
                                        </td>
                                        <?php
                                        if (isset($_POST["mediName_1"])) {
                                            $currMedi = Medicine::fetchMedicineSelected($_POST["mediName_1"]);
                                            $_SESSION['mediName_1'] = $_POST["mediName_1"];
                                            if ($currMedi->num_rows > 0) {
                                                $currMedi = $currMedi->fetch_assoc();
                                                $_SESSION['mediId_1'] = $currMedi["medicine_id"];
                                                $_SESSION['mediUnit_1'] = $currMedi["medicine_unit"];
                                                $_SESSION['mediUnitPrice_1'] = $currMedi["medicine_unit_price"];
                                                $_SESSION['mediCost_1'] = $currMedi["medicine_unit_price"];
                                                if (isset($_POST["mediQuantity_1"])) {
                                                    $_SESSION['mediQuantity_1'] = $_POST["mediQuantity_1"];
                                                    $_SESSION['mediCost_1'] = $_SESSION['mediUnitPrice_1'] * $_SESSION['mediQuantity_1'];
                                                }
                                        ?>
                                                <td><input type="text" class="medium-table" name="mediUnit_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit"] ?>"></td>
                                                <td>
                                                    <input type="number" class="medium-table" name="mediQuantity_1" onkeypress="return event.charCode >= 48" min=1 value="<?php echo $_SESSION['mediQuantity_1'] ?>" onchange="this.form.submit();">
                                                </td>
                                    </form>
                                    <?php
                                                $_SESSION['mediCost_1'] = (int)$_SESSION['mediUnitPrice_1'] * (int)$_SESSION['mediQuantity_1'];
                                    ?>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit_price"] ?>"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $_SESSION['mediCost_1'] ?>"></td>
                                <?php } else { ?>
                                    <td><input type="text" class="medium-table" name="mediUnit_1" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="number" class="medium-table" name="mediQuantity_1" readonly="readonly" onkeypress="return event.charCode >= 48" min="1"></td>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_1" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_1" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                <?php }
                                        } else { ?>
                                <?php
                                            if (isset($_POST["mediQuantity_1"])) {
                                                $_SESSION['mediQuantity_1'] = $_POST["mediQuantity_1"];
                                                $_SESSION['mediCost_1'] = $_SESSION['mediUnitPrice_1'] * $_SESSION['mediQuantity_1'];
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnit_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnit_1']) ? $_SESSION['mediUnit_1'] : '' ?>"></td>
                                <?php
                                            if ($_SESSION['mediName_1'] != null || $_SESSION['mediName_1'] != '') {
                                ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_1" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_1']) ? $_SESSION['mediQuantity_1'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            } else { ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_1" readonly="readonly" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_1']) ? $_SESSION['mediQuantity_1'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnitPrice_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnitPrice_1']) ? $_SESSION['mediUnitPrice_1'] : '' ?>"></td>
                                <td><input type="text" class="medium-table" name="mediCost_1" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediCost_1']) ? $_SESSION['mediCost_1'] : '' ?>"></td>
                            <?php } ?>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="mediNo_2" value="2" readonly></td>
                                    <form action="" method="POST">
                                        <td>
                                            <?php
                                            if (empty($_SESSION['mediId_2'])) $_SESSION['mediId_2'] = '';
                                            if (empty($_SESSION['mediName_2'])) $_SESSION['mediName_2'] = '';
                                            if (empty($_SESSION['mediUnit_2'])) $_SESSION['mediUnit_2'] = '';
                                            if (empty($_SESSION['mediUnitPrice_2'])) $_SESSION['mediUnitPrice_2'] = 0;
                                            if (empty($_SESSION['mediQuantity_2'])) $_SESSION['mediQuantity_2'] = 1;
                                            if (empty($_SESSION['mediCost_2'])) $_SESSION['mediCost_2'] = 0;
                                            ?>
                                            <input type="text" list="medicine" class="long-table" name="mediName_2" value="<?php echo isset($_POST['mediName_2']) ? $_POST['mediName_2'] : $_SESSION['mediName_2'] ?>" onchange="this.form.submit();">
                                        </td>
                                        <?php
                                        if (isset($_POST["mediName_2"])) {
                                            $currMedi = Medicine::fetchMedicineSelected($_POST["mediName_2"]);
                                            $_SESSION['mediName_2'] = $_POST["mediName_2"];
                                            if ($currMedi->num_rows > 0) {
                                                $currMedi = $currMedi->fetch_assoc();
                                                $_SESSION['mediId_2'] = $currMedi["medicine_id"];
                                                $_SESSION['mediUnit_2'] = $currMedi["medicine_unit"];
                                                $_SESSION['mediUnitPrice_2'] = $currMedi["medicine_unit_price"];
                                                $_SESSION['mediCost_2'] = $currMedi["medicine_unit_price"];
                                                if (isset($_POST["mediQuantity_2"])) {
                                                    $_SESSION['mediQuantity_2'] = $_POST["mediQuantity_2"];
                                                    $_SESSION['mediCost_2'] = $_SESSION['mediUnitPrice_2'] * $_SESSION['mediQuantity_2'];
                                                }
                                        ?>
                                                <td><input type="text" class="medium-table" name="mediUnit_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit"] ?>"></td>
                                                <td>
                                                    <input type="number" class="medium-table" name="mediQuantity_2" onkeypress="return event.charCode >= 48" min=1 value="<?php echo $_SESSION['mediQuantity_2'] ?>" onchange="this.form.submit();">
                                                </td>
                                    </form>
                                    <?php
                                                $_SESSION['mediCost_2'] = (int)$_SESSION['mediUnitPrice_2'] * (int)$_SESSION['mediQuantity_2'];
                                    ?>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit_price"] ?>"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $_SESSION['mediCost_2'] ?>"></td>
                                <?php } else { ?>
                                    <td><input type="text" class="medium-table" name="mediUnit_2" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="number" class="medium-table" name="mediQuantity_2" readonly="readonly" onkeypress="return event.charCode >= 48" min="1"></td>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_2" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_2" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                <?php }
                                        } else { ?>
                                <?php
                                            if (isset($_POST["mediQuantity_2"])) {
                                                $_SESSION['mediQuantity_2'] = $_POST["mediQuantity_2"];
                                                $_SESSION['mediCost_2'] = $_SESSION['mediUnitPrice_2'] * $_SESSION['mediQuantity_2'];
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnit_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnit_2']) ? $_SESSION['mediUnit_2'] : '' ?>"></td>
                                <?php
                                            if ($_SESSION['mediName_2'] != null || $_SESSION['mediName_2'] != '') {
                                ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_2" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_2']) ? $_SESSION['mediQuantity_2'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            } else { ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_2" readonly="readonly" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_2']) ? $_SESSION['mediQuantity_2'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnitPrice_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnitPrice_2']) ? $_SESSION['mediUnitPrice_2'] : '' ?>"></td>
                                <td><input type="text" class="medium-table" name="mediCost_2" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediCost_2']) ? $_SESSION['mediCost_2'] : '' ?>"></td>
                            <?php } ?>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="mediNo_3" value="3" readonly></td>
                                    <form action="" method="POST">
                                        <td>
                                            <?php
                                            if (empty($_SESSION['mediId_3'])) $_SESSION['mediId_3'] = '';
                                            if (empty($_SESSION['mediName_3'])) $_SESSION['mediName_3'] = '';
                                            if (empty($_SESSION['mediUnit_3'])) $_SESSION['mediUnit_3'] = '';
                                            if (empty($_SESSION['mediUnitPrice_3'])) $_SESSION['mediUnitPrice_3'] = 0;
                                            if (empty($_SESSION['mediQuantity_3'])) $_SESSION['mediQuantity_3'] = 1;
                                            if (empty($_SESSION['mediCost_3'])) $_SESSION['mediCost_3'] = 0;
                                            ?>
                                            <input type="text" list="medicine" class="long-table" name="mediName_3" value="<?php echo isset($_POST['mediName_3']) ? $_POST['mediName_3'] : $_SESSION['mediName_3'] ?>" onchange="this.form.submit();">
                                        </td>
                                        <?php
                                        if (isset($_POST["mediName_3"])) {
                                            $currMedi = Medicine::fetchMedicineSelected($_POST["mediName_3"]);
                                            $_SESSION['mediName_3'] = $_POST["mediName_3"];
                                            if ($currMedi->num_rows > 0) {
                                                $currMedi = $currMedi->fetch_assoc();
                                                $_SESSION['mediId_3'] = $currMedi["medicine_id"];
                                                $_SESSION['mediUnit_3'] = $currMedi["medicine_unit"];
                                                $_SESSION['mediUnitPrice_3'] = $currMedi["medicine_unit_price"];
                                                $_SESSION['mediCost_3'] = $currMedi["medicine_unit_price"];
                                                if (isset($_POST["mediQuantity_3"])) {
                                                    $_SESSION['mediQuantity_3'] = $_POST["mediQuantity_3"];
                                                    $_SESSION['mediCost_3'] = $_SESSION['mediUnitPrice_3'] * $_SESSION['mediQuantity_3'];
                                                }
                                        ?>
                                                <td><input type="text" class="medium-table" name="mediUnit_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit"] ?>"></td>
                                                <td>
                                                    <input type="number" class="medium-table" name="mediQuantity_3" onkeypress="return event.charCode >= 48" min=1 value="<?php echo $_SESSION['mediQuantity_3'] ?>" onchange="this.form.submit();">
                                                </td>
                                    </form>
                                    <?php
                                                $_SESSION['mediCost_3'] = (int)$_SESSION['mediUnitPrice_3'] * (int)$_SESSION['mediQuantity_3'];
                                    ?>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit_price"] ?>"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $_SESSION['mediCost_3'] ?>"></td>
                                <?php } else { ?>
                                    <td><input type="text" class="medium-table" name="mediUnit_3" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="number" class="medium-table" name="mediQuantity_3" readonly="readonly" onkeypress="return event.charCode >= 48" min="1"></td>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_3" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_3" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                <?php }
                                        } else { ?>
                                <?php
                                            if (isset($_POST["mediQuantity_3"])) {
                                                $_SESSION['mediQuantity_3'] = $_POST["mediQuantity_3"];
                                                $_SESSION['mediCost_3'] = $_SESSION['mediUnitPrice_3'] * $_SESSION['mediQuantity_3'];
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnit_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnit_3']) ? $_SESSION['mediUnit_3'] : '' ?>"></td>
                                <?php
                                            if ($_SESSION['mediName_3'] != null || $_SESSION['mediName_3'] != '') {
                                ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_3" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_3']) ? $_SESSION['mediQuantity_3'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            } else { ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_3" readonly="readonly" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_3']) ? $_SESSION['mediQuantity_3'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnitPrice_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnitPrice_3']) ? $_SESSION['mediUnitPrice_3'] : '' ?>"></td>
                                <td><input type="text" class="medium-table" name="mediCost_3" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediCost_3']) ? $_SESSION['mediCost_3'] : '' ?>"></td>
                            <?php } ?>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="mediNo_4" value="4" readonly></td>
                                    <form action="" method="POST">
                                        <td>
                                            <?php
                                            if (empty($_SESSION['mediId_4'])) $_SESSION['mediId_4'] = '';
                                            if (empty($_SESSION['mediName_4'])) $_SESSION['mediName_4'] = '';
                                            if (empty($_SESSION['mediUnit_4'])) $_SESSION['mediUnit_4'] = '';
                                            if (empty($_SESSION['mediUnitPrice_4'])) $_SESSION['mediUnitPrice_4'] = 0;
                                            if (empty($_SESSION['mediQuantity_4'])) $_SESSION['mediQuantity_4'] = 1;
                                            if (empty($_SESSION['mediCost_4'])) $_SESSION['mediCost_4'] = 0;
                                            ?>
                                            <input type="text" list="medicine" class="long-table" name="mediName_4" value="<?php echo isset($_POST['mediName_4']) ? $_POST['mediName_4'] : $_SESSION['mediName_4'] ?>" onchange="this.form.submit();">
                                        </td>
                                        <?php
                                        if (isset($_POST["mediName_4"])) {
                                            $currMedi = Medicine::fetchMedicineSelected($_POST["mediName_4"]);
                                            $_SESSION['mediName_4'] = $_POST["mediName_4"];
                                            if ($currMedi->num_rows > 0) {
                                                $currMedi = $currMedi->fetch_assoc();
                                                $_SESSION['mediId_4'] = $currMedi["medicine_id"];
                                                $_SESSION['mediUnit_4'] = $currMedi["medicine_unit"];
                                                $_SESSION['mediUnitPrice_4'] = $currMedi["medicine_unit_price"];
                                                $_SESSION['mediCost_4'] = $currMedi["medicine_unit_price"];
                                                if (isset($_POST["mediQuantity_4"])) {
                                                    $_SESSION['mediQuantity_4'] = $_POST["mediQuantity_4"];
                                                    $_SESSION['mediCost_4'] = $_SESSION['mediUnitPrice_4'] * $_SESSION['mediQuantity_4'];
                                                }
                                        ?>
                                                <td><input type="text" class="medium-table" name="mediUnit_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit"] ?>"></td>
                                                <td>
                                                    <input type="number" class="medium-table" name="mediQuantity_4" onkeypress="return event.charCode >= 48" min=1 value="<?php echo $_SESSION['mediQuantity_4'] ?>" onchange="this.form.submit();">
                                                </td>
                                    </form>
                                    <?php
                                                $_SESSION['mediCost_4'] = (int)$_SESSION['mediUnitPrice_4'] * (int)$_SESSION['mediQuantity_4'];
                                    ?>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit_price"] ?>"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $_SESSION['mediCost_4'] ?>"></td>
                                <?php } else { ?>
                                    <td><input type="text" class="medium-table" name="mediUnit_4" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="number" class="medium-table" name="mediQuantity_4" readonly="readonly" onkeypress="return event.charCode >= 48" min="1"></td>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_4" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_4" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                <?php }
                                        } else { ?>
                                <?php
                                            if (isset($_POST["mediQuantity_4"])) {
                                                $_SESSION['mediQuantity_4'] = $_POST["mediQuantity_4"];
                                                $_SESSION['mediCost_4'] = $_SESSION['mediUnitPrice_4'] * $_SESSION['mediQuantity_4'];
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnit_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnit_4']) ? $_SESSION['mediUnit_4'] : '' ?>"></td>
                                <?php
                                            if ($_SESSION['mediName_4'] != null || $_SESSION['mediName_4'] != '') {
                                ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_4" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_4']) ? $_SESSION['mediQuantity_4'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            } else { ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_4" readonly="readonly" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_4']) ? $_SESSION['mediQuantity_4'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnitPrice_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnitPrice_4']) ? $_SESSION['mediUnitPrice_4'] : '' ?>"></td>
                                <td><input type="text" class="medium-table" name="mediCost_4" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediCost_4']) ? $_SESSION['mediCost_4'] : '' ?>"></td>
                            <?php } ?>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="mediNo_5" value="5" readonly></td>
                                    <form action="" method="POST">
                                        <td>
                                            <?php
                                            if (empty($_SESSION['mediId_5'])) $_SESSION['mediId_5'] = '';
                                            if (empty($_SESSION['mediName_5'])) $_SESSION['mediName_5'] = '';
                                            if (empty($_SESSION['mediUnit_5'])) $_SESSION['mediUnit_5'] = '';
                                            if (empty($_SESSION['mediUnitPrice_5'])) $_SESSION['mediUnitPrice_5'] = 0;
                                            if (empty($_SESSION['mediQuantity_5'])) $_SESSION['mediQuantity_5'] = 1;
                                            if (empty($_SESSION['mediCost_5'])) $_SESSION['mediCost_5'] = 0;
                                            ?>
                                            <input type="text" list="medicine" class="long-table" name="mediName_5" value="<?php echo isset($_POST['mediName_5']) ? $_POST['mediName_5'] : $_SESSION['mediName_5'] ?>" onchange="this.form.submit();">
                                        </td>
                                        <?php
                                        if (isset($_POST["mediName_5"])) {
                                            $currMedi = Medicine::fetchMedicineSelected($_POST["mediName_5"]);
                                            $_SESSION['mediName_5'] = $_POST["mediName_5"];
                                            if ($currMedi->num_rows > 0) {
                                                $currMedi = $currMedi->fetch_assoc();
                                                $_SESSION['mediId_5'] = $currMedi["medicine_id"];
                                                $_SESSION['mediUnit_5'] = $currMedi["medicine_unit"];
                                                $_SESSION['mediUnitPrice_5'] = $currMedi["medicine_unit_price"];
                                                $_SESSION['mediCost_5'] = $currMedi["medicine_unit_price"];
                                                if (isset($_POST["mediQuantity_5"])) {
                                                    $_SESSION['mediQuantity_5'] = $_POST["mediQuantity_5"];
                                                    $_SESSION['mediCost_5'] = $_SESSION['mediUnitPrice_5'] * $_SESSION['mediQuantity_5'];
                                                }
                                        ?>
                                                <td><input type="text" class="medium-table" name="mediUnit_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit"] ?>"></td>
                                                <td>
                                                    <input type="number" class="medium-table" name="mediQuantity_5" onkeypress="return event.charCode >= 48" min=1 value="<?php echo $_SESSION['mediQuantity_5'] ?>" onchange="this.form.submit();">
                                                </td>
                                    </form>
                                    <?php
                                                $_SESSION['mediCost_5'] = (int)$_SESSION['mediUnitPrice_5'] * (int)$_SESSION['mediQuantity_5'];
                                    ?>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $currMedi["medicine_unit_price"] ?>"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo $_SESSION['mediCost_5'] ?>"></td>
                                <?php } else { ?>
                                    <td><input type="text" class="medium-table" name="mediUnit_5" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="number" class="medium-table" name="mediQuantity_5" readonly="readonly" onkeypress="return event.charCode >= 48" min="1"></td>
                                    <td><input type="text" class="medium-table" name="mediUnitPrice_5" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                    <td><input type="text" class="medium-table" name="mediCost_5" readonly="readonly" onfocus="this.blur()" tabindex="-1"></td>
                                <?php }
                                        } else { ?>
                                <?php
                                            if (isset($_POST["mediQuantity_5"])) {
                                                $_SESSION['mediQuantity_5'] = $_POST["mediQuantity_5"];
                                                $_SESSION['mediCost_5'] = $_SESSION['mediUnitPrice_5'] * $_SESSION['mediQuantity_5'];
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnit_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnit_5']) ? $_SESSION['mediUnit_5'] : '' ?>"></td>
                                <?php
                                            if ($_SESSION['mediName_5'] != null || $_SESSION['mediName_5'] != '') {
                                ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_5" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_5']) ? $_SESSION['mediQuantity_5'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            } else { ?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="number" class="medium-table" name="mediQuantity_5" readonly="readonly" onkeypress="return event.charCode >= 48" min="1" value="<?php echo isset($_SESSION['mediQuantity_5']) ? $_SESSION['mediQuantity_5'] : '' ?>" onchange="this.form.submit();">
                                        </form>
                                    </td>
                                <?php
                                            }
                                ?>
                                <td><input type="text" class="medium-table" name="mediUnitPrice_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediUnitPrice_5']) ? $_SESSION['mediUnitPrice_5'] : '' ?>"></td>
                                <td><input type="text" class="medium-table" name="mediCost_5" readonly="readonly" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediCost_5']) ? $_SESSION['mediCost_5'] : '' ?>"></td>
                            <?php } ?>
                                </tr>
                            </table>
                        </div>
                        <?php
                        $_SESSION['mediTotal'] = $_SESSION['mediCost_1'] + $_SESSION['mediCost_2'] + $_SESSION['mediCost_3'] + $_SESSION['mediCost_4'] + $_SESSION['mediCost_5'];
                        ?>
                        <p class="i-title">
                            Sum:
                            <input type="text" class="medium-input" name="mediTotal" onfocus="this.blur()" tabindex="-1" value="<?php echo isset($_SESSION['mediTotal']) ? $_SESSION['mediTotal'] : '' ?>">
                        </p>
                        <div class="datetime-containter">
                            <p class="i-datetime">Year
                            <p class="i-value i-datetime"><?php echo Date("Y") ?></p>
                            <p class="i-datetime">Month
                            <p class="i-value i-datetime"><?php echo Date("m") ?></p>
                            <p class="i-datetime">Day
                            <p class="i-value i-datetime"><?php echo Date("d") ?></p>
                            </p>
                            </p>
                            </p>
                        </div>
                        <p class="i-sign">Customer's Sign
                        <p class="i-sign right">Pharmacist's Sign</p>
                        </p>
                    </div>
                </div>
                <form action="" method="POST">
                    <button name="submit" type="submit" class="button button-confirm" onclick="return validateForm();">
                        <i class="fas fa-check"></i>
                        Confirm
                    </button>
                    <button name="reset" type="submit" class="button button-reset">
                        <i class="fas fa-eraser"></i>
                        Reset
                    </button>

                </form>
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