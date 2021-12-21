<?php
require "../php/ConnectionConfig/DataBase.php";
require "../php/Patient/Patient.php";
require "../php/Prescription/Prescription.php";
require "../php/Prescription/CreatePrescription.php";

session_start();

$result = Patient::fetchConsultedPatientForDoctor($_SESSION['user_id']);

if (isset($_POST['submit'])) {
    $error = CreatePrescription::Create();
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
                    <a href="/Web_HospitalManagement/Doctor/formPrescription.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
                        <?php if ($_SESSION['specialized_field'] == "Tổng quát") { ?>
                            <li class="has-border-bottom">
                                <i class="fas fa-user-injured"></i>
                                <a href="/Web_HospitalManagement/Doctor/patientCaring.php">Caring</a>
                            </li>
                        <?php } ?>
                        <li class="has-border-bottom">
                            <i class="fas fa-hands-helping"></i>
                            <a href="/Web_HospitalManagement/Doctor/patientAsigned.php">Asigned Patient</a>
                        </li>
                        <li>
                            <i class="fas fa-address-book"></i>
                            <a href="/Web_HospitalManagement/Doctor/patientList.php">All Patients</a>
                        </li>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Create New Form</p>
                    <ul>
                        <?php if ($_SESSION['specialized_field'] != "Tổng quát") { ?>
                            <li>
                                <i class="fas fa-hand-holding-medical"></i>
                                <a href="/Web_HospitalManagement/Doctor/formSpecCon.php">Special Consulting Register</a>
                            </li>
                        <?php } else { ?>
                            <li class="is-active-in-menu">
                                <i class="fas fa-briefcase-medical"></i>
                                <a href="/Web_HospitalManagement/Doctor/formPrescription.php">Prescription</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="box menu__box middle__box">
                    <p>Form Lists</p>
                    <ul>
                        <li class="has-border-bottom">
                            <i class="fas fa-hand-holding-medical"></i>
                            <a href="/Web_HospitalManagement/Doctor/listSpecCon.php">Special Consulting Register</a>
                        </li>
                        <li>
                            <i class="fas fa-briefcase-medical"></i>
                            <a href="/Web_HospitalManagement/Doctor/listPrescription.php">Prescription</a>
                        </li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                function validateForm() {
                    const errorLog = document.querySelector('.js-error');

                    var pId = document.forms["Form"]["patient_id"].value;
                    var pName = document.forms["Form"]["patient_name"].value;
                    var pAddress = document.forms["Form"]["patient_address"].value;
                    var pPhone = document.forms["Form"]["patient_phone"].value;
                    var pAge = document.forms["Form"]["patient_age"].value;
                    var pJob = document.forms["Form"]["patient_job"].value;
                    var conclusion = document.forms["Form"]["conclusion"].value;
                    var medicines = document.forms["Form"]["medicines"].value;

                    if (pId == null || pId == "" || pName == null || pName == "" || pAge == null || pAge == "" || pAddress == null || pAddress == "" ||
                        pPhone == null || pPhone == "" || pJob == null || pJob == "" || conclusion == null || conclusion == "" || medicines == null || medicines == "") {
                        errorLog.classList.remove('hide');
                        // alert("AAAAa")
                        return false;
                    }
                }
            </script>
            <form name="Form" class="container__content" action="" method="post" onsubmit="return validateForm();">
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
                        <?php
                        if (isset($_POST["patients"])) {
                            $currPatient = Patient::fetchConsultedPatientByQueue($_POST["patients"]);
                            if ($currPatient->num_rows > 0) {
                                $currPatient = $currPatient->fetch_assoc();
                        ?>
                                <p class="i-title hide">
                                    Patient ID:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_id" value="<?php echo $currPatient["pat_id"] ?>">
                                </p>
                                <p class="i-title">
                                    Patient Full Name:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_name" value="<?php echo $currPatient["pat_name"] ?>">
                                <p class="i-title">
                                    Age:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="patient_age" value="<?php echo $currPatient["pat_age"] ?>">
                                </p>
                                </p>
                                <p class="i-title">
                                    Address:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_address" value="<?php echo $currPatient["pat_address"] ?>">
                                </p>
                                <p class="i-title">
                                    Phone Number:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="patient_phone" value="<?php echo $currPatient["pat_phone"] ?>">
                                </p>

                                <p class="i-title">
                                    Job:
                                    <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_job" value="<?php echo $currPatient["pat_job"] ?>">
                                </p>
                            <?php }
                        } else { ?>
                            <p class="i-title hide">
                                Patient ID:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_id">
                            </p>
                            <p class="i-title">
                                Patient Full Name:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_name">
                            </p>
                            <p class="i-title">
                                Age:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="patient_age">
                            </p>

                            <p class="i-title">
                                Address:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_address">
                            </p>
                            <p class="i-title">
                                Phone Number:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="short-input" name="patient_phone">
                            </p>

                            <p class="i-title">
                                Job:
                                <input type="text" readonly="readonly" onfocus="this.blur()" tabindex="-1" class="medium-input" name="patient_job">
                            </p>
                        <?php } ?>
                        <div class="i-line">
                            <p class="i-title">
                                Conclusion:
                            </p>
                        </div>
                        <textarea class="long-input" name="conclusion" rows="5"></textarea>
                        <p class="i-title">
                            List of Medicine:
                        </p>
                        <textarea class="long-input" name="medicines" rows="5"></textarea>
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
                            <p class="i-sign">Doctor
                            </p>
                        </div>
                    </div>
                </div>
                <div class="content__button">
                    <button name="submit" type="submit" class="button button-confirm">
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
            </form>
            <div class="container__select">
                <form method="POST" action="">
                    <select name="patients" class="content__select" onchange="this.form.submit()">
                        <option value="" disabled selected>--</option>
                        <?php if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <!-- <option value="01" selected>01</option> -->
                                <option value=<?php echo $row['queue_number'] ?> <?= isset($_POST["patients"]) && $_POST["patients"] == $row['queue_number'] ? ' selected="selected"' : ''; ?>><?php echo $row['queue_number'] ?></option>
                                <!-- <option value="03">03</option> -->
                        <?php }
                        } ?>
                    </select>
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