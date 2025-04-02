<?php

include 'database.php';


if (isset($_GET['id'])) {
   
    $sent_id = mysqli_real_escape_string($conn, $_GET['id']);
    

    $query = "UPDATE `booklog` SET `book_status` = 'APPROVED' WHERE `id` = $sent_id";
    
    if (mysqli_query($conn, $query)) {
     
        header('Location:/umaklib/booklog.php');
        exit();  
    } else {
     
        echo "Error: " . mysqli_error($conn);
    }
}
?>
