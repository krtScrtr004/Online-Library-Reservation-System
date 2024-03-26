<?php
include "../connection.php";
include "navbar.php";
include "addbook_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="modify_book.css">
    <title>ADD BOOK</title>
</head>

<body>
    <div class="wrapper">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="box">
                <div>
                    <h2>ADD NEW BOOK</h2> <br>
                </div> <br>

                <div class="low_container">
                    <!-- Add Book Form -->
                    <form action="addbook_sub.php" method="POST" enctype="multipart/form-data">
                        <div class="info">
                            <div id="addb">
                                <div class="divider_form">
                                    <label for="bpic">BOOK COVER:</label>
                                    <input type="file" name="file" id="bpic"> <br><br><br>
                                </div>
                                <input type="text" name="glink" id="glink" placeholder="GDrive Link" required style="display: inline-block;">
                                <input type="text" name="isbn" placeholder="Book ISBN" required style="display: inline-block;"> <br><br>
                                <input type="text" name="name" placeholder="Book Name" required style="display: inline-block;">
                                <input type="text" name="authors" placeholder="Author(s)" required style="display: inline-block;"> <br><br>
                                <input type="text" name="edition" placeholder="Edition" style="display: inline-block;">
                                <input type="text" name="status" placeholder="Status" value="Available" style="display: inline-block;"> <br><br>
                                <input type="text" name="limit" placeholder="Limit" value="100" required style="display: inline-block;">
                                <input type="text" name="department" placeholder="Department" style="display: inline-block;"> <br><br>
                            </div>
                            <input class="button" type="submit" name="submit" value="ADD"> <br><br>
                            <!-- GDrive Link -->
                            <a class="a-exempt" href="https://drive.google.com/drive/folders/1a6Sj-NRLloxQHzXGGscUw6wr7hCVLdS3?usp=share_link" style="font-size: 10px">GDrive Link</a> <br><br>
                        </div>

                        <div class="desc">
                            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description"></textarea>
                        </div>
                    </form>
                </div>
            </div>

        <?php
            // If the user is not logged in
        } else {
        ?>
            <br> <br> <br>
            <h1 style="margin-left: 350px; color: red; font-size: 50px; font-weight: bold;">YOU ARE NOT LOGGED-IN</h1>

            <script>
                window.location = "../index.php";
            </script>
        <?php
        }
        ?>

    </div>
</body>

</html>