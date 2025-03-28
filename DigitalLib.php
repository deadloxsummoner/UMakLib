<?php include 'database.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMAKLib</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <div>
                <img src="img/umaklogo.png" class="umaklogo">
                <h1>University Of Makati</h1>
            </div>
            <div id="nav-buttons">
                <a href="#">Home</a>
                <a href="#">Resources</a>
                <a href="#">Digital Library</a>
                <a href="#">Services</a>
                <a href="#">About Us</a>
                <a href="#">News</a>
                <a href="#">Help</a>
                <a href="#">My Account</a>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top:120px;">
        <div class="wrapper">
            <div class="result-container">
                <div class="result-search-bar-container">
                    <form action="DigitalLib.php" method="POST">
                        <div>
                            <div class="search-wrapper">
                                <input type="text" name="search-bar-filter" id="searchFilter"><input type="image" src="img/search-icon.png" alt="Submit" id="searchButt">
                            </div>
                            <div class="filter-wrapper">
                                <div class="search-filter-dropdown">
                                    <select class="search-filter-options" name="search-filter-name">
                                        <option value="book">BOOK</option>
                                        <option value="author">AUTHOR</option>
                                        <option value="title">TITLE</option>
                                        <option value="subject">SUBJECT</option>
                                        <option value="callno">CALLNO</option>
                                        <option value="barcode">BARCODE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="result-table-container">
                    <?php
                    $search_query = "SELECT * FROM bookinfo WHERE 1=1 ";

                    if (!isset($_POST['search-bar-filter'])) {
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
                                <div class="result-bar-container">
                                    <div class="result-bar-img" style="background-image: url(<?= ?>);"></div>
                                    <div></div>
                                </div>
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