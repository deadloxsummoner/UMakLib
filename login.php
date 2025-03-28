<?php
include 'database.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMAKLib</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container" style="padding-top:120px;height:calc(100vh - 120px);">
        <form action="login.php" method="POST" class="login-form">
            <div class="login-container">
                <div class="login-head">LOGIN</div>
                <div class="login-inputs">
                    <div class="input-wrap">
                        <p>USERNAME</p>
                        <input>
                    </div>
                    <div class="input-wrap">
                        <p>PASSWORD</p>
                        <input type="password">
                    </div>
                    <a href="#" class="forgot-pass">Forgot password?</a>
                    <input type="submit" id="login-butt" value="SIGN IN">
                    <a href="#" class="forgot-pass" style="text-align:center;">Create account</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>