<?php
require "../php/ConnectionConfig/DataBase.php";
require "../php/Mail/SendMail.php";
require '../php/lib/PHPMailer/src/Exception.php';
require '../php/lib/PHPMailer/src/PHPMailer.php';
require '../php/lib/PHPMailer/src/SMTP.php';
require "../php/LogIn-SignUp/signup.php";
require "../php/Manager/Manager.php";

session_start();
$db = new Database();
$conn = $db->dbConnect();

$count = Manager::fetchCountTotal();
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
$result = Manager::fetchManagerPage($start, $limit);

//error show
if (isset($_POST['submit']) && $_POST['submit'] != "cancel") {
    $error = SignUp::SignUp();
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
                    <a href="/Web_HospitalManagement/Manager/accountManager.php" class="navbar--item-link  is-active-in-navbar">Workspace</a>
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
                        <li class="has-border-bottom is-active-in-menu">
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
                        <li class="has-border-bottom">
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
                                            <p class="i-title">
                                                Person Full Name:
                                            <p class="i-value medium-text">
                                                <?php echo $row["full_name"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Email:
                                            <p class="i-value medium-text">
                                                <?php echo $row["email"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Specialized Field:
                                            <p class="i-value short-text">
                                                <?php echo $row["specialized_field"]; ?>
                                            </p>
                                        </div>
                                    
                                        <div class="icon-container center">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="full-card">
                                    <div class="inner-card">
                                        <div class="inner-detail account-card has-border-top">
                                            <p class="i-title">
                                                BirthDay:
                                            <p class="i-value  medium-text">
                                                <?php echo $row["birthday"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Phone Number:
                                            <p class="i-value  medium-text">
                                                <?php echo $row["phone_number"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                IDCard Number:
                                            <p class="i-value medium-text">
                                                <?php echo $row["id_card_number"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                IDCard Date:
                                            <p class="i-value medium-text">
                                                <?php echo $row["id_card_date"]; ?>
                                            </p>
                                            </p>
                                            <p class="i-title change-element ">
                                                Address:
                                            <p class="i-value medium-text">
                                                <?php echo $row["address"]; ?>
                                            </p>
                                            </p>
                                            </p>
                                            <p class="i-title">
                                                Avatar:
                                            </p>
                                            <div class="i-avatar">
                                            <?php if (empty($row['avatar'])) { ?>
                                                <i class="fas fa-user-circle"></i>
                                            <?php } else { ?>
                                                <img class="card-avatar" src="<?php echo $row['avatar']; ?>"></img>
                                            <?php } ?>
                                            </div>
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
                            echo '<a class="page" href="/Web_HospitalManagement/Manager/accountManager.php?page=' . ($current_page - 1) . '">Prev</a> ';
                        }

                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class="page active" >' . $i . '</span> ';
                            } else {
                                echo '<a class="page" href="/Web_HospitalManagement/Manager/accountManager.php?page=' . $i . '">' . $i . '</a> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="page" href="/Web_HospitalManagement/Manager/accountManager.php?page=' . ($current_page + 1) . '">Next</a> ';
                        }
                        $conn->close();
                        ?>
                    </div>
                </ul>
            </div>
            <div class="container__floatbutton">
                <div class="float js-login" id="button-plus">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="" class="float" id="button-up">
                    <i class="fas fa-arrow-up"></i>
                </a>
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
        <?php
        if (isset($error)) {
        ?>
            <div class="modal center_hide open">
            <?php } else { ?>
                <div class="modal center_hide">
                <?php } ?>
                <div class="modal__overlay">
                </div>
                <div class="modal__body">
                    <div class="modal__inner">
                        <form method="post" action="" class="inner-title flex-space">
                            <div>
                                <h2>Create New Account</h2>
                                <p>Enter new account information...</p>
                            </div>
                            <button name="submit" value="cancel" class="js-confirm trans-button"><i class="fas fa-times center"></i></button>
                        </form>
                        <div class="inner-box">
                            <script type="text/javascript">
                                function validateForm() {
                                    const errorLog = document.querySelector('.js-create');

                                    var fullname = document.forms["Form"]["fullname"].value;
                                    var position = document.forms["Form"]["position"].value;
                                    if (position == "doctor")
                                        var field = document.forms["Form"]["field1"].value;
                                    else
                                        var field = document.forms["Form"]["field2"].value;
                                    var username = document.forms["Form"]["username"].value;
                                    var password = document.forms["Form"]["password"].value;
                                    var email = document.forms["Form"]["email"].value;

                                    if (fullname == null || fullname == "" || position == null || position == "" || field == null || field == "" || username == null || username == "" || password == null || password == "") {
                                        errorLog.classList.remove('hide');
                                        return false;
                                    }
                                }
                            </script>
                            <form name="Form" action="" method="post" onsubmit="return validateForm()">
                                <p class="i-title">User Full Name</p>
                                <input type="text" class="medium-input" name="fullname">
                                <div class="i-line">
                                    <p class="i-title">Account Type:</p>
                                    <div class="select" id="account_doctor_create_pos_select" name="position">
                                        <select onchange="validateSelectBox(this)" name="position" value="doctor">
                                            <!-- <option selected disabled>Chọn vị trí</option> -->
                                            <option value="doctor">doctor</option>
                                            <option value="manager">manager</option>
                                            <option value="receptionist">receptionist</option>
                                            <option value="pharmacist">pharmacist</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="i-line">
                                    <p class="i-title">Specialized Field:</p>
                                    <input type="text" class="short-input" id="mytext" name="field1" style="display: none" value="Không" readonly />
                                    <div class="select" id="div_field_select">
                                        <select name="field2" value="Tổng quát">
                                            <!-- <option selected disabled>Chọn chuyên ngành</option> -->
                                            <option value="Tổng quát">Tổng quát</option>
                                            <option value="Răng hàm mặt">Răng hàm hặt</option>
                                            <option value="Tai mũi họng">Tai hũi họng</option>
                                            <option value="Nhãn">Nhãn</option>
                                            <option value="Thẩm mỹ">Thẩm mỹ</option>
                                        </select>
                                    </div>
                                    <script language="javascript">
                                        function validateSelectBox(selectObject) {
                                            var div = document.getElementById('div_field_select');
                                            var input = document.getElementById("mytext");
                                            var pos = selectObject.value;
                                            if (pos == "doctor") {
                                                input.style.display = "none";
                                                div.style.display = "inline-flex";
                                            } else if (pos == "manager") {
                                                input.value = "Nhân sự";
                                                div.style.display = "none";
                                                input.style.display = "inline-flex";

                                            } else if (pos == "receptionist") {
                                                input.value = "Tiếp tân";
                                                div.style.display = "none";
                                                input.style.display = "inline-flex";

                                            } else if (pos == "pharmacist") {
                                                input.value = "Dược sĩ";
                                                div.style.display = "none";
                                                input.style.display = "inline-flex";
                                            }
                                        }
                                    </script>
                                </div>
                                <div class="i-line">
                                    <p class="i-title">Username:</p>
                                    <input type="text" class="short-input" name="username" />
                                </div>
                                <div class="i-line">
                                    <p class="i-title">Password:</p>
                                    <input type="text" class="short-input" name="password" />
                                </div>
                                <div class="i-line">
                                    <p class="i-title">Validated Email:</p>
                                    <input type="text" class="short-input" name="email" />
                                </div>
                                <div class="flex-column right-margin">
                                    <?php
                                    if (isset($error)) {
                                    ?>
                                        <p class="create-error"><?php echo $error ?></p>
                                    <?php } ?>
                                    <p class="create-error js-create hide">All fields are required</p>
                                    <button type="submit" value="submit" name="submit" class="button button-confirm top25px">
                                        <i class="fas fa-check"></i>
                                        Confirm
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
</body>

</html>
<script type="text/javascript">
    const loginBtn = document.querySelector('.js-login')
    const loginBox = document.querySelector('.modal')
    const closeBox = document.querySelector('.js-confirm')
    const errorLogHide = document.querySelector('.js-create')


    function showLoginBox() {
        loginBox.classList.add('open');
        errorLogHide.classList.add('hide');
    }

    function closeLoginBox() {
        loginBox.classList.remove('open')
    }

    loginBtn.addEventListener('click', showLoginBox)
    closeBox.addEventListener('click', closeLoginBox)
</script>