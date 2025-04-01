<?php
include 'database.php';
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header('location:DigitalLib.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container" style="height:calc(100vh - 120px);padding-top:120px;">
        <div class="wrapper">

        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>