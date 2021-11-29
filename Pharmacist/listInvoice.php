
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
            <li class="navbar--item has-dropdown-menu">
                <a href="/Web_HospitalManagement/Doctor/patientCaring.php" class="navbar--item-link is-active-in-navbar">Workspace</a>
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
                    <li class="card-drop"> 
                        <input type="checkbox"/>       
                        <div class="short-card">
                            <div class="inner-card">
                                <div class="inner-detail">
                                    <div class="datetime-containter">
                                        <p class="i-datetime">Date:
                                            <p class="i-value i-datetime">DD/MM/YYYY</p>
                                        </p>                                       
                                    </div>
                                    <p class="i-title">
                                        Customer Full Name:
                                    <p class="i-value short-text">Nguyen Van A</p>                                    
                                    </p>
                                    <p class="i-title">
                                        Address:
                                    <p class="i-value short-text">XXX YYY ZZZ</p>                                    
                                    </p>
                                    <p class="i-title">
                                        Total Bill:
                                    <p class="i-value short-text">xxxxxx 000 VND</p>                                    
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
                                <div class="inner-detail has-border-top">
                                    <p class="i-title">
                                        List of Medicines:
                                    <p class="i-value long-text">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita voluptatum,
                                        animi aspernatur vel quas beatae natus dolore, iusto tenetur magni hic nam?
                                        Dolores iste esse fuga excepturi. Magni, culpa. Deleniti?
                                    </p>
                                    </p>
                                </div>
                                <div class="switch-container center">
                                </div>
                                <div class="icon-container center">
                                    <i class="fas fa-print"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="card-drop"> 
                        <input type="checkbox"/>       
                        <div class="short-card">
                            <div class="inner-card">
                                <div class="inner-detail">
                                    <div class="datetime-containter">
                                        <p class="i-datetime">Date:
                                            <p class="i-value i-datetime">DD/MM/YYYY</p>
                                        </p>                                       
                                    </div>
                                    <p class="i-title">
                                        Customer Full Name:
                                    <p class="i-value short-text">Nguyen Van A</p>                                    
                                    </p>
                                    <p class="i-title">
                                        Address:
                                    <p class="i-value short-text">XXX YYY ZZZ</p>                                    
                                    </p>
                                    <p class="i-title">
                                        Total Bill:
                                    <p class="i-value short-text">xxxxxx 000 VND</p>                                    
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
                                <div class="inner-detail has-border-top">
                                    <p class="i-title">
                                        List of Medicines:
                                    <p class="i-value long-text">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita voluptatum,
                                        animi aspernatur vel quas beatae natus dolore, iusto tenetur magni hic nam?
                                        Dolores iste esse fuga excepturi. Magni, culpa. Deleniti?
                                    </p>
                                    </p>
                                </div>
                                <div class="switch-container center">
                                </div>
                                <div class="icon-container center">
                                    <i class="fas fa-print"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="container__floatbutton">
                <a href="" class="float" id="button-up">
                    <i class="fas fa-arrow-up"></i>
                </a>
                <a href="" class="float" id="button-search">
                    <i class="fas fa-search"></i>
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
</body>

</html>