<?php
include 'database.php';
session_start();

$userId = $_SESSION["user_id"];

if (isset($_SESSION["user_id"])) {
    $user_id = mysqli_real_escape_string($conn, $_SESSION["user_id"]);
    $query = "SELECT * FROM logindata WHERE id ='$userId'";
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
        <div class="user-acc-wrapper">
            <div class="user-acc-container">
                <div class="account-info-container">
                    <div class="user-profile">
                        <img src="user_profile/<?= $user['id'] ?>.jpg" class="user-profile">
                    </div>
                    <div class="user-info">
                        <div class="user-head">ACCOUNT INFORMATION</div>
                        <div class="user-sub-head">NAME: <?= $user["name"] ?></div>
                        <div class="user-sub-head">STUDENT ID: <?= $user["student_id"] ?></div>
                        <div class="user-sub-head">YR & SECTION: <?= $user["student_section"] ?></div>
                        <div class="user-sub-head">GENDER: <?= $user["gender"] ?></div>
                    </div>
                    <div class="logout-butt">
                        <a href="logout.php">LOGOUT</a><br><br>
                       <?php if($_SESSION['user_type'] == 'admin'){
                        ?>
                             <a href="booklog.php" class="book-log">BOOK LOG</a>
                        <?php
                       }?>
                    </div>
                </div>
                <div class="account-divider"></div>
                <div class="user-head" style="margin-top: 2%;">BORROWED</div>
                <div class="borrowed-wrapper">
                    <?php

                    $borrow_query = "SELECT * FROM booklog WHERE borrow_id = $user_id";
                    $borrow_result = mysqli_query($conn, $borrow_query);

                    if (mysqli_num_rows($borrow_result) > 0) {
                        foreach ($borrow_result as $borrow) {
                        }
                    }

                    $search_query = "SELECT *
                                    FROM bookinfo
                                    JOIN booklog ON bookinfo.id = booklog.book_id
                                    JOIN logindata ON booklog.borrow_id = logindata.id
                                    WHERE logindata.id = {$user_id};";



                    if (!isset($_POST['search-bar-filter'])) {

                        $result = mysqli_query($conn, $search_query);

                    ?>


                        <?php

                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $result_row) {
                        ?>
                                <a href="bookinfo.php?id=<?= $result_row['id'] ?>" class="open-borrow-bar">
                                    <div class="borrow-bar-container">
                                        <div class="borrow-bar-img" style="background-image: url(book_cover/<?= $result_row['book_cover'] ?>);"></div>
                                        <div class="borrow-bar-info">
                                            <div class="borrow-bar-titles">
                                                <p class="borrow-title"><?= $result_row['book_name'] ?></p>
                                                <p class="borrow-author"><?= $result_row['book_author'] ?></p>
                                            </div>
                                            <div class="borrow-bar-subtitle">
                                                <div>
                                                    <p class="borrow-bar-sub-head">RATING</p>
                                                    <p class="borrow-bar-sub-head-2"><?= $result_row['book_rating'] ?>/5.0</p>
                                                </div>
                                                <div class="sub-head-bar-2">
                                                    <div>
                                                        <p class="borrow-bar-sub-head">CALL NO.</p>
                                                        <p class="borrow-bar-sub-head-2"><?= $result_row['book_callno'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="borrow-bar-sub-head">STATUS</p>
                                                        <p class="borrow-bar-sub-head-2"><?= $result_row['book_status'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                    <?php


                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>