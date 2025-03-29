<?php
include 'database.php';
session_start();

$userId = $_SESSION["user_ID"];
$name = $_SESSION["logged_user"];

if (isset($_SESSION["user_ID"])) {
    $user_id = mysqli_real_escape_string($conn, $_SESSION["user_ID"]);
    $query = "SELECT * FROM logindata WHERE id ='$userID'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_array($query_run);
    }
}



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
        <?= $name ?>
    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>