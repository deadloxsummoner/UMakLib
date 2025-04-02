<?php
include 'database.php';
session_start();
ini_set('display_errors', 'Off');
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
        <div class="wrapper">
            <div class="result-container">
                <div class="result-search-bar-container">
                    <form action="DigitalLib.php" method="POST">
                        <div>
                            <div class="search-wrapper">
                                <input type="text" name="search-bar-filter" id="searchFilter"><input type="image" src="img/search-icon.png" alt="Submit" id="searchButt" name="search-butt">
                            </div>
                            <div class="filter-wrapper">
                                <?php

                                if ($_SESSION["user_type"] == 'admin') {
                                ?>
                                    <div class="add-book-butt"><a href="BookAdd.php">Add <box-icon name='add-to-queue' color='#cacaca'></box-icon></a></div>
                                <?php
                                }

                                ?>
                                <div class="search-filter-dropdown">
                                    <select class="search-filter-options" name="search-filter-name">
                                        <option value="book_name">BOOK</option>
                                        <option value="book_author">AUTHOR</option>
                                        <option value="book_name">TITLE</option>
                                        <option value="book_genre">SUBJECT</option>
                                        <option value="book_callno">CALLNO</option>
                                        <option value="barcode">BARCODE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="result-table-container">
                    <?php


                    if (!isset($_POST['search-bar-filter'])) {
                        $search_query = "SELECT * FROM bookinfo WHERE 1=1 ";
                        $search_query .= " LIMIT 5";
                        $result = mysqli_query($conn, $search_query);

                    ?>

                        <div class="result-head-2">
                            <p>TOP PICKS</p>
                        </div>

                        <?php

                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $result_row) {
                        ?>
                                <a href="bookinfo.php?id=<?= $result_row['id'] ?>" class="open-result-bar">
                                    <div class="result-bar-container">
                                        <div class="result-bar-img" style="background-image: url(book_cover/<?= $result_row['book_cover'] ?>);"></div>
                                        <div class="result-bar-info">
                                            <div class="result-bar-titles">
                                                <p class="book-title"><?= $result_row['book_name'] ?></p>
                                                <p class="book-author"><?= $result_row['book_author'] ?></p>
                                            </div>
                                            <div class="result-bar-subtitle">
                                                <div>
                                                    <p class="result-bar-sub-head">RATING</p>
                                                    <p class="result-bar-sub-head-2"><?= $result_row['book_rating'] ?>/5.0</p>
                                                </div>
                                                <div class="sub-head-bar-2">
                                                    <div>
                                                        <p class="result-bar-sub-head">CALL NO.</p>
                                                        <p class="result-bar-sub-head-2"><?= $result_row['book_callno'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="result-bar-sub-head">STATUS</p>
                                                        <p class="result-bar-sub-head-2"><?= $result_row['book_status'] ?></p>
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

                    if (isset($_POST['search-bar-filter'])) {
                        $search_filter = $_POST['search-bar-filter'];
                        $filter = $_POST['search-filter-name'];
                        $search_query = "SELECT * FROM bookinfo WHERE 1=1 ";
                        $search_query .= " AND `$filter` LIKE '%$search_filter%'";
                        $result = mysqli_query($conn, $search_query);

                        ?>

                        <div class="result-head-2">
                            <p>RESULTS</p>
                        </div>

                        <?php

                        if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $result_row) {
                        ?>
                                <a href="bookinfo.php?id=<?= $result_row['id'] ?>" class="open-result-bar">
                                    <div class="result-bar-container">
                                        <div class="result-bar-img" style="background-image: url(book_cover/<?= $result_row['book_cover'] ?>);"></div>
                                        <div class="result-bar-info">
                                            <div class="result-bar-titles">
                                                <p class="book-title"><?= $result_row['book_name'] ?></p>
                                                <p class="book-author"><?= $result_row['book_author'] ?></p>
                                            </div>
                                            <div class="result-bar-subtitle">
                                                <div>
                                                    <p class="result-bar-sub-head">RATING</p>
                                                    <p class="result-bar-sub-head-2"><?= $result_row['book_rating'] ?>/5.0</p>
                                                </div>
                                                <div class="sub-head-bar-2">
                                                    <div>
                                                        <p class="result-bar-sub-head">CALL NO.</p>
                                                        <p class="result-bar-sub-head-2"><?= $result_row['book_callno'] ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="result-bar-sub-head">STATUS</p>
                                                        <p class="result-bar-sub-head-2"><?= $result_row['book_status'] ?></p>
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