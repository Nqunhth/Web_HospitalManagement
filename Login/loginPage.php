<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HealthCareManagement</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../icon/fontawesome-free-5.15.4-web/css/all.min.css">

    <!--"Roboto" & "M PLUS Rounded 1c font" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
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
            <li class="navbar--item has-dropdown-menu">
                <a href="/Web_HospitalManagement/Doctor/patientCaring.php" class="navbar--item-link">Workspace</a>
                <div class="temporary">
                    <div class="dropdown-user center">
                        <div class="user">
                            <a href="/Web_HospitalManagement/Manager/accountManager.php">Manager<i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="user">
                            <a href="/Web_HospitalManagement/Receptionist/formMedical.php">Receptionist<i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="user">
                            <a href="/Web_HospitalManagement/Doctor/patientCaring.php">Doctor<i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="user">
                            <a href="/Web_HospitalManagement/Pharmacist/formInvoice.php">Pharmacist<i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="navbar--item has-dropdown-menu">
                <a href="/Web_HospitalManagement/About/aboutPage.php" class="navbar--item-link">About</a>
            </li>
            <li class="navbar--flex-spacer">
                <!-- Search Area -->
            </li>
            <li class="navbar--item has-dropdown-menu">
                <a href="/Web_HospitalManagement/Login/loginPage.php" class="navbar--item-link"><i class="far fa-user"></i></a>
                <div class="trans-layer">
                    <div class="dropdown-user center">
                        <div class="user-info">
                            <i class="far fa-user"></i>
                            <p>User Name</p>
                            <p>XXY@gmail.com</p>
                        </div>
                        <div class="user user-manage">
                            <p>My Account</p>
                            <a href="/Web_HospitalManagement/User/infoManage.php">Account Management<i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="user user-logout">
                            <a href="/Web_HospitalManagement">Logout<i class="fas fa-sign-out-alt"></i></a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="login-page">
        <div class="group">
            <div class="card rounded_left_border center">
                <div class="card_heading center">
                    <h2 class="head_prefix">WELCOME TO</h2>
                    <h1 class="head_title">HOSPITAL NAME</h1>
                    <p class="head_subtitle">Log in to get in and start your new day!</p>
                </div>
                <form action="../php/LogIn-SignUp/login.php" method="post" class="input_section center">
                    <div class="input_section center">
                        <div class="input center">
                            <i class="far fa-user login_icon"></i>
                            <input type="text" name="username" id="" placeholder="Username">
                        </div>
                        <div class="input center">
                            <i class="fas fa-key login_icon"></i>
                            <input type="text" name="password" id="" placeholder="Password">
                        </div>
                    </div>
                    <div class="forget_section center">
                        <p class="">Forget your password?</p>
                        <a href="/Web_HospitalManagement/Login/forgetpassPage.php" class="Recovery">Get help here!</a>
                    </div>
                    <button type="submit" class="login_btn">
                        LOG IN
                    </button>
                </form>

            </div>
            <div class="card blue rounded_right_border center">
                <div class="logo--content roboto">
                    <i class="fas fa-hospital logo_in_login"></i>
                    <h1 class="logo-title">HOSPITAL NAME</h1>
                    <h1 class="logo-slogan">Hospital Slogan</h1>
                    <h3>Short Description.....</h3>
                </div>
            </div>
        </div>
    </div>

</body>

</html>