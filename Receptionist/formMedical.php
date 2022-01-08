<?php
require "../Models/ConnectionConfig/DataBase.php";
require "../Models/User/User.php";
require "../Models/MedicalRegister/MedicalRegister.php";
require "../Controllers/MedicalRegister/CreateNewMediReg.php";
require "../Models/Patient/Patient.php";

session_start();
$result = User::fetchActiveDoctorForReceptionist();

if (isset($_POST['submit'])) {
    $error = CreateNewMedicalReg::Create();
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
                    <a href="/Web_HospitalManagement/Receptionist/formMedical.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
                    <p>Patient List</p>
                    <ul>
                        <li>
                            <i class="fas fa-user-injured"></i>
                            <a href="/Web_HospitalManagement/Receptionist/patientCaring.php">Caring</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Create New Form</p>
                    <ul>
                        <li class="is-active-in-menu">
                            <i class="fas fa-notes-medical"></i>
                            <a href="/Web_HospitalManagement/Receptionist/formMedical.php">Medical Register Form</a>
                        </li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                function validateForm() {
                    const errorLog = document.querySelector('.js-error');

                    var name = document.forms["Form"]["patient_name"].value;
                    var age = document.forms["Form"]["patient_age"].value;
                    var address = document.forms["Form"]["patient_address"].value;
                    var phone = document.forms["Form"]["patient_phone"].value;
                    var job = document.forms["Form"]["patient_job"].value;
                    var reason = document.forms["Form"]["reason"].value;
                    var doctors = document.forms["Form"]["doctors"].value;

                    if (name == null || name == "" || age == null || age == "" || address == null || address == "" ||
                        phone == null || phone == "" || job == null || job == "" || reason == null || reason == "" || doctors == null || doctors == "") {
                        errorLog.classList.remove('hide');
                        return false;
                    }
                }
            </script>
            <form method="post" name="Form" class="container__content" onsubmit="return validateForm()" action="">
                <div class="box content__box">
                    <div class="inner-box">
                        <?php
                        if (isset($error)) {
                        ?>
                            <p class="form-error"><?php echo $error ?></p>
                        <?php
                        }
                        ?>
                        <p class="form-error hide js-error">All fields are required</p>
                        <p class="i-title">
                            Patient Full Name:
                            <input type="text" class="medium-input" name="patient_name">
                        <p class="i-title">
                            Age:
                            <input type="text" class="short-input" name="patient_age">
                        </p>
                        </p>
                        <p class="i-title">
                            Address:
                            <input type="text" class="medium-input" name="patient_address">
                        </p>
                        <p class="i-title">
                            Phone Number:
                            <input type="text" class="short-input" name="patient_phone">
                        </p>

                        <p class="i-title">
                            Job:
                            <input type="text" class="medium-input" name="patient_job">
                        </p>
                        <p class="i-title">
                            Reason:
                            <input type="text" class="medium-input" name="reason">
                        </p>
                        <div class="doctor-selection">
                            <p class="i-title">
                                Doctor Name:
                            </p>
                            <select name="doctor" id="doctors">
                                <?php if ($result->num_rows > 0) {
                                    // Load dữ liệu lên website
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value=" <?php echo  $row["user_id"] ?> "> <?php echo  $row["user_id"] . " | " . $row["full_name"]; ?> </option>
                                <?php
                                    }
                                }
                                // $conn->close();
                                ?>

                            </select>

                        </div>

                        <?php if ($_SESSION['position'] == "doctor") : ?>
                            <div class="i-line">
                                <p class="i-title">Specialist Consulting Room (or Analysis):</p>
                            </div>
                            <textarea class="long-input" name="mediregist" rows="5"></textarea>
                        <?php endif ?>
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
                            <p class="i-sign">Receptionist
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" name="submit" class="button button-confirm">
                        <i class="fas fa-check"></i>
                        Confirm
                    </button>
                    <button class="button button-reset">
                        <i class="fas fa-eraser"></i>
                        Reset
                    </button>
                </div>
            </form>

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