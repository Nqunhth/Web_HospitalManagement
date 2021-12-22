<?php
require "../php/ConnectionConfig/DataBase.php";
require "../php/UserClass/User.php";
require "../php/Image/Upload.php";

session_start();

$owner = User::fetchUserById($_SESSION['user_id']);

if (isset($_POST['submit'])) {
    $error = ImageUploader::upload();
}

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
        <div class="container__background_color">
            <div class="container__menu">
                <div class="box user__box info-manage">
                    <ul>
                        <li class="is-active-in-user">
                            <a href="./infoManage.php">Infomation Management <i class="fas fa-chevron-right"></i></a>
                        </li>
                        <li>
                            <a href="./accountSetting.php">Account Setting <i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container__content">
                <?php
                if ($owner->num_rows > 0) {
                    $owner = $owner->fetch_assoc();
                ?>
                    <div class="box content__box">
                        <div class="inner-box">
                            <p class="i-title">
                                User Full Name:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="full_name" value="<?php echo $_SESSION["fullname"] ?>">
                            <p class="i-title">
                                Age:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="age" value="<?php echo $owner["age"] ?>">
                            </p>
                            </p>
                            <p class="i-title-user">
                                Specialized_field:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="field" value="<?php echo $owner["specialized_field"] ?>">
                            </p>
                            <p class="i-title-user">
                                Birthday
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="birthday" value="<?php echo $owner["birthday"] ?>">
                            </p>
                            <p class="i-title-user">
                                Gender:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="gender" value="<?php echo $owner["gender"] ?>">
                            </p>
                            <p class="i-title-user">
                                Address:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="address" value="<?php echo $owner["address"] ?>">
                            </p>
                            <p class="i-title-user">
                                Phone Number:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="phone" value="<?php echo $owner["phone_number"] ?>">
                            </p>
                            <p class="i-title-user">
                                ID Card Number:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="id_number" value="<?php echo $owner["id_card_number"] ?>">
                            </p>
                            <p class="i-title-user">
                                ID Card Date:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="id_date" value="<?php echo $owner["id_card_date"] ?>">
                            </p>
                            <p class="i-title-user-avatar">
                                Avatar:
                            </p>

                            <div class="i-avatar-user">
                                <?php
                                if (isset($error)) {
                                ?>
                                    <p class="form-error"><?php echo $error ?></p>
                                <?php
                                }
                                ?>
                                <div class="i-avatar-content">
                                    <?php
                                    if (empty($_SESSION['avatar'])) {
                                    ?>
                                        <i id="placeholder" class="fas fa-user-circle"></i>
                                        <img id="output" class="avatar hide" src="<?php echo $_SESSION['avatar'] ?>"></img>
                                    <?php
                                    } else {
                                    ?>
                                        <i id="placeholder" class="fas fa-user-circle hide"></i>
                                        <img id="output" class="avatar" src="<?php echo $_SESSION['avatar'] ?>"></img>
                                    <?php
                                    }
                                    ?>
                                    <form class="i-avatar-form " action="" enctype="multipart/form-data" method="POST">
                                        <input id="selectedFile" class="hide" name="img" size="35" type="file" accept="image/*" onchange="loadFile(event)" /><br />
                                        <button type="button" class="browse_img" onclick="document.getElementById('selectedFile').click();"><i class="fas fa-camera"></i></button>

                                        <button class="submit-img" type="submit" name="submit"><i class="fas fa-check"></i></button>
                                    </form>
                                </div>
                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        var placeholder = document.getElementById('placeholder');
                                        output.classList.remove('hide');
                                        placeholder.classList.add('hide');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src)
                                        }
                                    };
                                </script>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="content__button">
                    <button class="button button-confirm">
                        <i class="fas fa-check"></i>
                        Confirm
                    </button>
                    <button class="button button-reset">
                        <i class="fas fa-eraser"></i>
                        Update
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