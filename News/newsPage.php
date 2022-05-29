<?php
session_start();
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
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body onload="loadDB()">
    <div class="news-page center">
        <div class="header__navbar not_navbar_at_home">
            <ul class="navbar--list">
                <li class="navbar--item">
                    <a href="/Web_HospitalManagement" class="navbar--item-link">HOME</a>
                </li>
                <li class="navbar--item">
                    <a href="/Web_HospitalManagement/News/newsPage.php" class="navbar--item-link is-active-in-navbar">News</a>
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


        <div class="body roundedfont">
            <div class="left_bar">
                <div class="bar_head">
                    News
                </div>
                <div id=news_list></div>
                <div class="bar_foot">
                    See more
                </div>
            </div>


            <div id="bb" class="full_news center">

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
    </div>
</body>
<script language="javascript">
    function loadDB() {
        var url = new URL(window.location.href);
        console.log(url.searchParams.get("news_id"));
        var xhr = new XMLHttpRequest();
        if (!url.searchParams.get("news_id")) {
            xhr.open("GET", "../Ajax/NewsAjax/GetLatestNews.php", true);
            xhr.send(null);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    bb.innerHTML = xhr.responseText
                    console.log(xhr.responseText)
                }
            }
        } else {
            xhr.open("POST", "../Ajax/NewsAjax/GetNewsById.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("chosen_id=" + url.searchParams.get("news_id"));
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    bb.innerHTML = xhr.responseText
                }
            }
        }

        var listNews = new XMLHttpRequest();
        listNews.open("GET", "../Ajax/NewsAjax/GetNewsList.php", true);
        listNews.send(null);
        listNews.onreadystatechange = function() {
            if (listNews.readyState == 4 && listNews.status == 200) {
                news_list.innerHTML = listNews.responseText
            }
        }
    }

    function onClickNewsItem(e) {
        e = e || window.event;
        var news = new XMLHttpRequest();

        window.location.replace("/Web_HospitalManagement/News/newsPage.php?news_id=" + e.currentTarget.value)
    }
</script>

</html>