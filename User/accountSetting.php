<?php
require "../Models/ConnectionConfig/DataBase.php";
require "../Controllers/User/changepassword.php";

session_start();

if (isset($_POST['submit'])) {
    $error = ChangePassword::changePassword();
}
?>
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

    <div class="container">
        <div class="container__background_color placeholder">
            <div class="container__menu">
                <div class="box user__box info-manage">
                    <ul>
                        <li>
                            <a href="./infoManage.php">Infomation Management <i class="fas fa-chevron-right"></i></a>
                        </li>
                        <li class="is-active-in-user">
                            <a href="./accountSetting.php">Account Setting <i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="" method="post" class="container__content">
                <div class="box content__box">
                    <div class="inner-box inner-box-user-30">
                        <h2 class="passchange-header">Change Password</h1>
                            <div class="i-title pass-change">
                                Current Password:
                                <div class="center">
                                    <input id="curr" type="password" name="current_pass" class="medium-input width440" value="<?php echo (isset($_POST['current_pass']) && $error != "Change password success" ? $_POST['current_pass'] : "") ?>">
                                    <i id="curr-eye" class="far fa-eye-slash eye-icon" onclick="return myFunction1();"></i>
                                </div>
                            </div>
                            <div class="i-title-user pass-change">
                                New Password:
                                <div class="center">
                                    <input id="new" type="password" name="new_pass" class="medium-input width440" value="<?php echo (isset($_POST['new_pass']) && $error != "Change password success" ? $_POST['new_pass'] : "") ?>">
                                    <i id="new-eye" class="far fa-eye-slash eye-icon" onclick="return myFunction2();"></i>
                                </div>
                            </div>
                            <div class="i-title-user pass-change">
                                Confirm New Password:
                                <div class="center">
                                    <input id="confirm" type="password" name="confirm_pass" class="medium-input width440" value="<?php echo (isset($_POST['confirm_pass']) && $error != "Change password success" ? $_POST['confirm_pass'] : "") ?>">
                                    <i id="confirm-eye" class="far fa-eye-slash eye-icon" onclick="return myFunction3();"></i>
                                </div>
                            </div>
                            <?php
                            if (isset($error)) {
                            ?>
                                <p class="form-error changpass-error"><?php echo $error ?></p>
                            <?php
                            }
                            ?>
                    </div>
                </div>
                <div>
                    <button type="submit" name="submit" class="button button-confirm">
                        <i class="fas fa-check"></i>
                        Confirm
                    </button>
                </div>
            </form>
            <script>
                function myFunction1() {
                    var x1 = document.getElementById("curr");
                    const eye = document.getElementById("curr-eye");
                    if (x1.type === "password") {
                        x1.type = "text";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    } else {
                        x1.type = "password";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    }
                }

                function myFunction2() {
                    var x1 = document.getElementById("new");
                    const eye = document.getElementById("new-eye");
                    if (x1.type === "password") {
                        x1.type = "text";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    } else {
                        x1.type = "password";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    }
                }

                function myFunction3() {
                    var x1 = document.getElementById("confirm");
                    const eye = document.getElementById("confirm-eye");
                    if (x1.type === "password") {
                        x1.type = "text";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    } else {
                        x1.type = "password";
                        eye.classList.toggle("fa-eye");
                        eye.classList.toggle("fa-eye-slash");
                    }
                }
            </script>
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