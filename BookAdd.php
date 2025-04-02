<?php
include 'database.php';
session_start();

if ($_SESSION['user_type'] != 'admin') {
    header('location:DigitalLib.php');
}

$lastId_query = "SELECT * FROM bookinfo
                 ORDER BY id DESC
                 LIMIT 1";

$lastId_run = mysqli_query($conn, $lastId_query);

if (mysqli_num_rows($lastId_run) > 0) {
    
    $data = mysqli_fetch_assoc($lastId_run);
    

    $last_ID = $data['id'] + 1;
    
  
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
        <form method="POST" action="addbook.php">
            <div class="book-add-input-wrapper">
                <p>Book Name </p>
                <input type="text" name="book_name">
            </div>
            <div class="book-add-input-wrapper">
                <p>Author</p>
                <input type="text" name="book_author">
            </div>
            <div class="book-add-input-wrapper">
                <p>Call no.</p>
                <input type="text" name="book_callno">
            </div>
            <div class="book-add-input-wrapper">
                <p>Book Rating</p>
                <input type="text" name="book_rating">
            </div>
            <div class="book-add-input-wrapper">
                <p>Book Cover (Image)</p>
                <input type="file" name="book_cover" accept="image/*">
            </div>
            <div class="book-add-input-wrapper">
                <p>Genre</p>
                <input type="text" name="book_genre" placeholder="e.g., Fiction, Non-fiction, Mystery">
            </div>
            <div class="book-add-input-wrapper">
                <p>ISBN</p>
                <input type="text" name="book_isbn" placeholder="Enter the ISBN number">
            </div>
            <div class="book-add-input-wrapper">
                <p>Summary</p>
                <textarea name="book_summary" placeholder="Write a brief summary of the book"></textarea>
            </div>
            <div class="book-add-input-wrapper">
                <p>Status</p>
                <input type="text" name="book_status" placeholder="Available, Checked Out, etc.">
            </div>
            <div class="book-add-input-wrapper">
                <p>Quantity</p>
                <input type="number" name="book_quantity" min="1" placeholder="Enter the quantity">
            </div>
            <input type="submit" value="Add Book">
        </form>
        </div>
    </div>
    <?php
    include 'footer.php';

    $book_name = $_POST['book_name'] ?? ''; 
    $book_author = $_POST['book_author'] ?? '';
    $book_callno = $_POST['book_callno'] ?? '';
    $book_rating = $_POST['book_rating'] ?? '';
    $book_cover = $_POST['book_cover'] ?? '';
    $book_genre = $_POST['book_genre'] ?? '';
    $book_isbn = $_POST['book_isbn'] ?? '';
    $book_summary = $_POST['book_summary'] ?? '';
    $book_status = $_POST['book_status'] ?? '';
    $book_quantity = $_POST['book_quantity'] ?? '';

    if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] == 0) {
        $file_tmp_name = $_FILES['book_cover']['tmp_name'];
        $file_name = $_FILES['book_cover']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
       
        $new_file_name = $last_ID . '.' . $file_ext;
        
        
        $upload_dir = 'book_cover/';
        $upload_path = $upload_dir . $new_file_name;
        
        if (move_uploaded_file($file_tmp_name, $upload_path)) {
            echo "Book cover uploaded successfully!";
            
        
            $conn = new mysqli("localhost", "username", "password", "database");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO bookinfo (book_name, book_author, book_callno, book_rating, book_cover, book_genre, book_isbn, book_summary, book_status, book_quantity)
                    VALUES ('$book_name', '$book_author', '$book_callno', '$book_rating', '$new_file_name', '$book_genre', '$book_isbn', '$book_summary', '$book_status', '$book_quantity')";
            if ($conn->query($sql) === TRUE) {
                echo "New book added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } else {
            echo "Failed to upload the book cover image.";
        }
    }

    
    ?>
</body>

</html>