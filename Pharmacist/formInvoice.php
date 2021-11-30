<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthCareManagement</title>

    <!--"Roboto" & "M PLUS Rounded 1c font" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap">

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
                <?php  if (!empty($_SESSION['position'])) : ?>
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
                    <?php  if (empty($_SESSION['username'])) : ?>
                        <a href="/Web_HospitalManagement/Login/loginPage.php" class="navbar--item-link"><i class="far fa-user"></i></a>
                    <?php else: ?>
                        <a href="/Web_HospitalManagement/User/infoManage.php" class="navbar--item-link"><i class="far fa-user"></i></a>
                        <div class="trans-layer">
                            <div class="dropdown-user center">
                                <div class="user-info">
                                    <i class="far fa-user"></i>
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
                    <p>Ceate New Form</p>
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
            <div class="container__content">
                <div class="box content__box">
                    <div class="inner-box">
                        <p class="i-title">
                            Customer Full Name:
                            <input type="text" class="medium-input" name="invoice">
                        </p>
                        <p class="i-title">
                            Address:
                            <input type="text" class="medium-input" name="invoice">
                        </p>
                        <div class ="i-line">
                            <table>
                                <tr>
                                    <th>No</th>
                                    <th>Medicine Name</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="1" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="2" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="3" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="4" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="5" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="6" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="7" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="8" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="9" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="short-table" name="invoice" value="10" readonly></td>
                                    <td><input type="text" class="long-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                    <td><input type="text" class="medium-table" name="invoice"></td>
                                </tr>
                            </table>
                        </div>
                        <p class="i-title">
                            Sum:
                            <input type="text" class="medium-input" name="invoice" readonly>
                        </p>
                        <div class="datetime-containter">
                            <p class="i-datetime">Day
                            <p class="i-value i-datetime">DD</p>
                            <p class="i-datetime">Month
                            <p class="i-value i-datetime">MM</p>
                            <p class="i-datetime">Year
                            <p class="i-value i-datetime">YYYY</p>
                            </p>
                            </p>
                            </p>
                        </div>
                        <p class="i-sign">Customer
                        <p class="i-sign right">Pharmacist</p>
                        </p>
                    </div>
                    </div>
                    <div class="content__button">

                        <button class="button button-confirm">
                            <i class="fas fa-check"></i>
                            Confirm
                        </button>
                        <button class="button button-reset">
                            <i class="fas fa-eraser"></i>
                            Reset
                        </button>
                        <button class="button button-print">
                            <i class="fas fa-print"></i>
                            Print
                        </button>
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