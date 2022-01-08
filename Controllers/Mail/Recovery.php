<?php
    require "../../Models/ConnectionConfig/DataBase.php";

    if (isset($_POST["submit"])) {
        if (isset($_GET["token"])) {
            if (!empty($_POST["new_pass"]) && !empty($_POST["confirm_pass"])) {
                if ($_POST["new_pass"] == $_POST["confirm_pass"]) {
                    $db = new DataBase();
                    if ($db->dbConnect()) {
                        $change = $db->changePassword("account", $_GET["token"], $_POST["new_pass"]);
                        if ($change) {
                            $result = "Password Recovery Successful. You can now use your new password to enter the app";
                        } else {
                            $result = "Recovery Failed";
                        };
                    } else {
                        $result = "Connection Error!";
                    }
                } else {
                    $result = "Your confirm password doesn't match your new password";
                }
            } else {
                $result = "All fields are required";
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Recovery</title>
</head>
<style>
    body {
        justify-content: center;
        align-items: center;
        height: 50vh;
        box-sizing: border-box;
    }

    h1 {
        margin-top: 0px;
    }

    h5 {
        margin: 0px;
    }

    p {
        margin: 0px;
        font-size: 12px;
    }

    .section-bold {
        margin-right: 10px;
        margin-bottom: 10px;
        padding-top: 3px;
        height: 22px;
        font-weight: 1000;
        box-sizing: border-box;
        font-size: 16px;
    }

    input {
        margin-bottom: 10px;
    }

    .my_form {
        width: max-content;
        border: solid;
        padding: 20px;
    }

    .column-flex {
        display: flex;
        flex-direction: column;
    }

    .content {
        display: flex;
    }

    .hide-show {
        display: flex;
        align-self: end;
    }

    .hide-show p {
        padding-top: 2px;
    }

    .button {
        width: max-content;
        align-self: end;
    }
    .notification{
        width: 200px;
    }
</style>

<body class="column-flex">
    <form action="" method="post" class="my_form column-flex">
        <h5>Hospital Healthcare Management</h5>
        <h1>Password Recovery</h1>
        <div class="content">
            <div class="section column-flex">
                <p class="section-bold">Enter your new password : </p>
                <p class="section-bold">Confirm your new password : </p>
                <?php
                if (isset($result)) {
                ?>
                    <p class = "notification"><?php echo $result ?></p>
                <?php } ?>
            </div>
            <div class="section column-flex">
                <input type="password" name="new_pass" id="pass1" value="<?php echo (isset($_POST['new_pass']) ? $_POST['new_pass'] : "") ?>">
                <input type="password" name="confirm_pass" id="pass2" value="<?php echo (isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : "") ?>">
                <div class="hide-show">
                    <input type="checkbox" onclick="myFunction()">
                    <p>Show Password</p>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" class="button"></input>
    </form>

    <script>
        function myFunction() {
            var x1 = document.getElementById("pass1");
            var x2 = document.getElementById("pass2");
            if (x1.type === "password" && x2.type === "password") {
                x1.type = "text";
                x2.type = "text";
            } else {
                x1.type = "password";
                x2.type = "password";
            }
        }
    </script>
</body>


</html>