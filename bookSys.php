<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "umaklib";

$conn = "";
try {
    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "could not connect";
}


session_start();

$borrowId = $_SESSION["borrow_id"];
$bookId = $_SESSION["book_id"];



$insert_query = "INSERT INTO booklog values('', $borrowId,$bookId)";
$insert = mysqli_query($conn, $insert_query);
$temp = $bookId;
unset($_SESSION["borrow_id"]);
unset($_SESSION["book_id"]);
echo "<script type='text/javascript'>alert('Hello nigga');</script>";

header('location:bookinfo.php?id=' . $temp);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>


</html>