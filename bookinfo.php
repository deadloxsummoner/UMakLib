<?php
ini_set('display_errors', 'Off');
include 'database.php';
session_start();


$userId = $_SESSION["user_id"];

if (isset($_GET['id'])) {
    $book_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM bookinfo WHERE id ='$book_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $book = mysqli_fetch_array($query_run);
    }
}


$alr_borrowed = "SELECT * FROM booklog WHERE borrow_id = '$userId' AND book_id = '$book_id' AND book_status ='APPROVED' AND book_status ='PENDING'";
$alr_run = mysqli_query($conn, $alr_borrowed);



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
    <div class="container" style="padding-top:140px;">
        <div class="book-info-wrapper">
            <div class="cover-handler">
                <div class="book-info-container">
                    <div class="book-info-cover">
                        <div class="book-cover" style="background-image: url(book_cover/<?= $book['book_cover'] ?>);"></div>
                    </div>
                </div>
            </div>
            <div class="book-info-titles">
                <div class="book-info-head"><?= $book['book_name'] ?></div>
                <div class="book-info-subhead">
                    AUTHOR:
                    <p> <?= $book['book_author'] ?></p>
                </div>
                <div class="book-info-subhead">
                    RATING:
                    <p> <?= $book['book_rating'] ?></p>
                </div>
                <div class="book-info-subhead">
                    STATUS:
                    <p> <?= $book['book_status'] ?></p>
                </div>
                <div class="book-info-subhead">
                    CALL NO:
                    <p> <?= $book['book_callno'] ?></p>
                </div>

                <a class="add-to-cart" href="<?php if (isset($_SESSION["logged_user"])) {
                                                    if (mysqli_num_rows($alr_run) > 0) {
                                                        echo "#";
                                                    } else {
                                                        $_SESSION["borrow_id"] = $userId;
                                                        $_SESSION["book_id"] = $book_id;

                                                        echo "bookSys.php";
                                                    }
                                                } else {
                                                    echo "login.php";
                                                } ?>">
                    <box-icon name='cart' color='#ffffff' id="addToCart"></box-icon> Add to Cart
                </a>
                <br>
                <?php
                if (isset($_SESSION["logged_user"])) {
                    if (mysqli_num_rows($alr_run) > 0) {
                        echo "already borrowed";
                    }
                } else {
                    echo "login to add";
                }
                ?>
            </div>

        </div>

        <div class="summary-wrapper">
            <div>
                <div class="book-info-head">SUMMARY</div>
                <div class="book-summary">
                    <?= $book['book_summary'] ?>
                </div>
            </div>
            <div class="book-details-wrap">
                <div class="book-info-head">DETAILS</div>
                <div class="book-info-subhead">
                    GENRE:
                    <p> <?= $book['book_genre'] ?></p>
                </div>
                <div class="book-info-subhead">
                    ISBN:
                    <p> <?= $book['book_ISBN'] ?></p>
                </div>
                <div class="book-info-subhead">
                    QUANTITY:
                    <p> <?= $book['book_quantity'] ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'footer.php'
    ?>
</body>

</html>