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
    <script type="text/javascript">
        function validateForm() {
            var a = document.forms["Form"]["answer_a"].value;
            var b = document.forms["Form"]["answer_b"].value;
            var c = document.forms["Form"]["answer_c"].value;
            var d = document.forms["Form"]["answer_d"].value;
            if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "") {
                alert("Please Fill All Required Field");
                return false;
            }
        }
    </script>

    <form method="post" name="Form" onsubmit="return validateForm()" action="">
        <textarea cols="30" rows="2" name="answer_a" id="a"></textarea>
        <textarea cols="30" rows="2" name="answer_b" id="b"></textarea>
        <textarea cols="30" rows="2" name="answer_c" id="c"></textarea>
        <textarea cols="30" rows="2" name="answer_d" id="d"></textarea>
        <button type="submit"></button>
    </form>

</body>

</html>