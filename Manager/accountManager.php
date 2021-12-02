<?php
require "../php/ConnectionConfig/DataBase.php";
session_start();
$db = new Database();
$conn = $db->dbConnect();
// $sql = "SELECT * FROM account JOIN personal_info ON account.user_id = personal_info.user_id 
//                             WHERE account.position = 'manager'";
// $result = $conn->query($sql);
$result = mysqli_query($conn, "SELECT count(user_id) AS total FROM account WHERE account.position = 'manager'");
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;
$result = mysqli_query($conn, "SELECT * FROM account JOIN personal_info ON account.user_id = personal_info.user_id 
                                                    WHERE account.position = 'manager' 
                                                    LIMIT $start, $limit");
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
                        <input type="checkbox"/>       
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
                                        Username:
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
                                <div class="switch-container center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
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
                                        <i class="fas fa-user-circle"></i>
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
                        if ($current_page > 1 && $total_page > 1){
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page='.($current_page-1).'">Prev</a> ';
                        }
            
                        for ($i = 1; $i <= $total_page; $i++){
                            if ($i == $current_page){
                                echo '<span class="page active" >'.$i.'</span> ';
                            }
                            else{
                                echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page='.$i.'">'.$i.'</a> ';
                            }
                        }
                        if ($current_page < $total_page && $total_page > 1){
                            echo '<a class="page" href="/Web_HospitalManagement/Pharmacist/checkStock.php?page='.($current_page+1).'">Next</a> ';
                        }
                        $conn->close();
                    ?>
                    </div>         
                    <!-- <li class="card-drop"> 
                        <input type="checkbox"/>       
                        <div class="short-card">
                            <div class="inner-card">
                                <div class="inner-detail">
                                    <p class="i-title">
                                        Person Full Name:
                                    <p class="i-value medium-text">
                                        Nguyen Van A
                                    </p>                                 
                                    </p>
                                    <p class="i-title">
                                        Username:
                                    <p class="i-value medium-text">
                                        This is Email
                                    </p>                                 
                                    </p>
                                    <p class="i-title">
                                        Specialized Field:
                                    <p class="i-value short-text">
                                        Chat and chat only
                                    </p>
                                </div>
                                <div class="switch-container center">
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
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
                                        Load data from Database
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        Phone Number:
                                    <p class="i-value  medium-text">
                                        Load data from Database
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        IDCard Number:
                                    <p class="i-value medium-text">
                                        Load data from Database
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        IDCard Date:
                                    <p class="i-value medium-text">
                                        Load data from Database
                                    </p>
                                    </p>
                                    <p class="i-title change-element ">
                                        Address:
                                    <p class="i-value medium-text">
                                        Load data from Database
                                    </p>
                                    </p>
                                    </p>
                                    <p class="i-title">
                                        Avatar:
                                    </p>
                                    <div class="i-avatar">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> -->
                </ul>
            </div>
            <div class="container__floatbutton">
                <div class="float js-login" id="button-plus">
                    <i class="fas fa-plus"></i>
                </div>
                <a href="" class="float" id="button-up">
                    <i class="fas fa-arrow-up"></i>
                </a>
                <a href="" class="float" id="button-search">
                    <i class="fas fa-search"></i>
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
        <div class="modal center_hide">
            <div class="modal__overlay">
            </div>
            <div class="modal__body">
                <div class="modal__inner">
                    <div class="inner-title">
                        <h2>Create New Account
                            <div class="js-confirm"><i class="fas fa-times center"></i></div>
                        </h2>
                        <p>Enter new account information...</p>
                    </div>
                    <div class="inner-box">
                        <form action="../php/LogIn-SignUp/signup.php" method="post">
                            <p class="i-title">User Full Name</p>
                            <input type="text" class="medium-input" name="fullname">
                            <div class="i-line">
                                <p class="i-title">Account Type:</p>
                                <input type="text" class="short-input" name="position">
                            </div>
                            <div class="i-line">
                                <p class="i-title">Specialized Field:</p>
                                <input type="text" class="short-input" name="field">
                            </div>
                            <div class="i-line">
                                <p class="i-title">Username:</p>
                                <input type="text" class="short-input" name="username">
                            </div>
                            <div class="i-line">
                                <p class="i-title">Password:</p>
                                <input type="text" class="short-input" name="password">
                            </div>
                            <div class="i-line">
                                <p class="i-title">Validated Email:</p>
                                <input type="text" class="short-input" name="email">
                            </div>
                            <button type="submit" class="button button-confirm js-confirm">
                                <i class="fas fa-check"></i>
                                Confirm
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
</body>

</html>
<script>
    const loginBtn = document.querySelector('.js-login')
    const loginBox = document.querySelector('.modal')
    const closeBox = document.querySelector('.js-confirm')

    function showLoginBox() {
        loginBox.classList.add('open')
    }
    function closeLoginBox() {
        loginBox.classList.remove('open')
    }

    loginBtn.addEventListener('click', showLoginBox)
    closeBox.addEventListener('click', closeLoginBox)
</script>