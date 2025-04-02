<?php
include 'database.php';
session_start();


if ($_SESSION['user_type'] != 'admin') {
    header('location:account.php');
    exit();
}


$borrow_book = "SELECT * FROM booklog WHERE book_status != 'done'";
$borrow_run = mysqli_query($conn, $borrow_book);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Borrow Log</title>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container" style="height:auto;min-height:calc(100vh - 120px);padding-top:120px; justify-content:start;">
        <div class="borrow-log-wrapper">
            <table class="borrowed-table">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Book</td>
                    <td>Status</td>
                    <td>Action</td>
                </tr>

                <?php 
               
                if (mysqli_num_rows($borrow_run) > 0) {
                  
                    while ($result = mysqli_fetch_assoc($borrow_run)) {
                        $borrow_id = $result['borrow_id'];
                        $borrow_book_id = $result['book_id'];
                        
                       
                        $borrow_info = "SELECT * FROM logindata WHERE id ='$borrow_id'";
                        $borrow_info_run = mysqli_query($conn, $borrow_info);
                        $borrow_result = mysqli_fetch_assoc($borrow_info_run); 

                       
                        $book_borrow_info = "SELECT * FROM bookinfo WHERE id ='$borrow_book_id'";
                        $book_borrow_run = mysqli_query($conn, $book_borrow_info);
                        $book_borrow = mysqli_fetch_assoc($book_borrow_run);

                      
                        ?>
                        <tr>
                            <td><?= $result['id']?></td>
                            <td><?= $borrow_result['name']?></td>
                            <td><?= $book_borrow['book_name']?></td>
                            <td><?= $result['book_status']?></td>
                            <td>
                                
                                <?php if ($result['book_status'] == "PENDING"): ?>
                                    <a href="booklogapprove.php?id=<?= $result['id']; ?>">APPROVE</a>
                                <?php endif; ?>
                                
                                <?php if ($result['book_status'] == "APPROVED"): ?>
                                    <a href="bookreturn.php?id=<?= $result['id']; ?>">RETURN</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>
