<?php
require "../Models/ConnectionConfig/DataBase.php";
require "../Models/News/News.php";
require "../AjaxControllers/NewsController.php";
session_start();

$list = News::fetchNews();

if (isset($_GET['news_id'])) {
    $curr = News::fetchNewsById($_GET['news_id']);
} else
    $curr = News::fetchLatestNews();
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
                <?php if ($list->num_rows > 0) { ?>
                    <ul class="news_list">
                        <?php while ($listItem = $list->fetch_assoc()) { ?>
                            <li class="news_item center" onclick="document.getElementById('submit-<?php echo $listItem['news_id'] ?>').click();">
                                <form class="hide" action="">
                                    <input id="submit-<?php echo $listItem['news_id'] ?>" type="submit" name="news_id" value="<?php echo $listItem['news_id'] ?>" />
                                </form>
                                <?php if ($listItem['news_img'] == "") { ?>
                                    <div class="thumpnail center">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php } else { ?>
                                    <img class="thumpnail center" src="<?php echo $listItem['news_img'] ?>"></img>
                                <?php } ?>
                                <div class="news_description">
                                    <div class="news_des_head">
                                        <h2 class="title"><?php echo $listItem['news_title'] ?></h2>
                                        <p class="author">- <?php echo $listItem['news_author'] ?></p>
                                    </div>
                                    <div class="des_content_container">
                                        <p class="des_content">
                                            <?php echo $listItem['news_content'] ?>
                                        </p>
                                    </div>
                                    <p class="update_time">
                                        <?php echo $listItem['news_date'] ?>
                                    </p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
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
        console.log("aaaaa")
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../AjaxControllers/NewsController.php", true);
        xhr.send(null);
        xhr.onreadystatechange = function() {
         
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("vmnvnvn")
                console.log(xhr)
                bb.innerHTML = xhr
            }

        }
    }
</script>
</html>