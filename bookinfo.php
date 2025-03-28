<?php
include 'database.php';

if (isset($_GET['ID'])) {
    $book_id = mysqli_real_escape_string($conn, $_GET['ID']);
    $query = "SELECT * FROM alumni_data WHERE id ='$book_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $book = mysqli_fetch_array($query_run);
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
</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="container" style="padding-top:120px;">

        <?= $book['book_name'] ?>


    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>