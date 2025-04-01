<?php
include 'database.php';
session_start();


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
                        <input type="text" name="username">
                    </div>
                    <div class="input-wrap">
                        <p>PASSWORD</p>
                        <input type="password" name="password">
                    </div>
                    <a href="#" class="forgot-pass">Forgot password?</a>
                    <input type="submit" id="login-butt" value="SIGN IN">
                    <a href="#" class="forgot-pass" style="text-align:center;">Create account</a>
                    <?php
                    ini_set('display_errors', 'Off');

                    $username = $_POST["username"];
                    $userpass = $_POST["password"];

                    if (isset($_SESSION["logged_user"])) {
                        header("location:account.php");
                    }

                    $gett = "SELECT * FROM logindata WHERE username = '$username'";
                    $result = mysqli_query($conn, $gett);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $user_result = $row["username"];
                        $pass_result = $row["password"];
                        $id_result = $row['id'];
                    }
                    if (isset($username, $userpass)) {
                        if ($username == null && $userpass == null) {
                            echo "<br><p id=\"warning\">please enter username and password</p>";
                        } else if ($username != $user_result && $userpass != $pass_result) {
                            echo "<br><p id=\"warning\">wrong username or password</p>";
                        } else if ($username == $user_result && $userpass == $pass_result) {
                            $_SESSION["logged_user"] = $user_result;
                            $_SESSION["user_id"] = $id_result;
                            header("location:account.php");
                        }
                    }
                    ?>
                </div>

            </div>
        </form>
    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>