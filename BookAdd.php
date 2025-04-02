<?php
include 'database.php';
session_start();


if ($_SESSION['user_type'] != 'admin') {
    header('location:DigitalLib.php');
    exit();
}


$lastId_query = "SELECT id FROM bookinfo ORDER BY id DESC LIMIT 1";
$lastId_run = mysqli_query($conn, $lastId_query);

if (mysqli_num_rows($lastId_run) > 0) {
    $data = mysqli_fetch_assoc($lastId_run);
    $last_ID = $data['id'] + 1;
} else {
 
    $last_ID = 1;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $book_name = $_POST['book_name'] ?? ''; 
    $book_author = $_POST['book_author'] ?? '';
    $book_callno = $_POST['book_callno'] ?? '';
    $book_rating = $_POST['book_rating'] ?? '';
    $book_genre = $_POST['book_genre'] ?? '';
    $book_isbn = $_POST['book_isbn'] ?? '';
    $book_summary = $_POST['book_summary'] ?? '';
    $book_status = $_POST['book_status'] ?? '';
    $book_quantity = $_POST['book_quantity'] ?? '';

  
    if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] == 0) {
        $file_tmp_name = $_FILES['book_cover']['tmp_name'];
        $file_name = $_FILES['book_cover']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_extensions)) {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }


        if ($_FILES['book_cover']['size'] > 2 * 1024 * 1024) {
            echo "File is too large. Maximum size is 2MB.";
            exit;
        }

     
        $new_file_name = $last_ID . '.' . $file_ext;
        $upload_dir = 'book_cover/';
        $upload_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp_name, $upload_path)) {
            echo "Book cover uploaded successfully!";
            
       
            $stmt = $conn->prepare("INSERT INTO bookinfo (book_name, book_author, book_callno, book_rating, book_cover, book_genre, book_isbn, book_summary, book_status, book_quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssss", $book_name, $book_author, $book_callno, $book_rating, $new_file_name, $book_genre, $book_isbn, $book_summary, $book_status, $book_quantity);

            if ($stmt->execute()) {

            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload the book cover image.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add Book</title>
    
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container" style="height:calc(100vh - 120px);padding-top:120px;">
        <div class="wrapper" id="add-book-container">
            <form method="POST" enctype="multipart/form-data" class="add-book-form">
                <div class="book-add-input-wrapper">
                    <p>Book Name</p>
                    <input type="text" name="book_name" oninput="this.value = this.value.toUpperCase();" onchange="document.getElementById('bookTitle').innerHTML = this.value;" id="bookNameGet"required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Author</p>
                    <input type="text" name="book_author" oninput="this.value = this.value.toUpperCase()" onchange="document.getElementById('bookAuthor').innerHTML = this.value;" id="bookAuthorGet" required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Call no.</p>
                    <input type="text" name="book_callno" oninput="this.value = this.value.toUpperCase()"onchange="document.getElementById('bookCallno').innerHTML = this.value;" id="bookCallnoGet"required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Book Rating</p>
                    <input type="text" name="book_rating" oninput="this.value = this.value.toUpperCase()" id="bookRatingGet" onchange="document.getElementById('bookRating').innerHTML = this.value;" required >
                </div>
                <div class="book-add-input-wrapper">
                    <p>Book Cover (Image)</p>
                    <input type="file" id="bookCoverInput" name="book_cover" oninput="this.value = this.value.toUpperCase()" accept="image/*" required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Genre</p>
                    <input type="text" name="book_genre" oninput="this.value = this.value.toUpperCase()" id="bookGenreGet"  placeholder="e.g., Fiction, Non-fiction, Mystery" required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>ISBN</p>
                    <input type="text" name="book_isbn" oninput="this.value = this.value.toUpperCase()"id="bookISBNGet" placeholder="Enter the ISBN number" required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Summary</p>
                    <textarea name="book_summary" placeholder="Write a brief summary of the book" required id="bookSummaryGet"></textarea>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Status</p>
                    <input type="text" name="book_status" placeholder="Available, Checked Out, etc." oninput="this.value = this.value.toUpperCase()" onchange="document.getElementById('bookStatus').innerHTML = this.value;"  required>
                </div>
                <div class="book-add-input-wrapper">
                    <p>Quantity</p>
                    <input type="number" name="book_quantity" min="1" placeholder="Enter the quantity" oninput="this.value = this.value.toUpperCase()" required>
                </div>
                <input type="submit" value="Add Book" id="addBookButt">
            </form>
            <div class="preview-con">
                <a class="open-result-bar" style="font-family: 'Metropolis';">
                    <div class="result-bar-container">
                        <div class="result-bar-img" id="resultBarImage"></div> 
                        <div class="result-bar-info">
                            <div class="result-bar-titles">
                                <p class="book-title" id="bookTitle"></p>
                                <p class="book-author" id="bookAuthor"></p>
                            </div>
                            <div class="result-bar-subtitle">
                                <div>
                                    <p class="result-bar-sub-head">RATING</p>
                                    <p class="result-bar-sub-head-2"><p id="bookRating" style="display: inline-block;"></p>/5.0</p>
                                </div>
                                <div class="sub-head-bar-2">
                                    <div>
                                        <p class="result-bar-sub-head">CALL NO.</p>
                                        <p class="result-bar-sub-head-2" id="bookCallno"></p>
                                    </div>
                                    <div>
                                        <p class="result-bar-sub-head">STATUS</p>
                                        <p class="result-bar-sub-head-2" id="bookStatus"></p>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div> 
                </a> 
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="app.js">
        
    </script>
</body>

</html>
