<?php
include "../connection.php";
include "navbar.php";
include "editbook_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="modify_book.css">
    <title>EDIT BOOK</title>
</head>

<style>
    .desc textarea {
        height: 90%;
    }
</style>

<body>
    <div class="wrapper">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Checks if the user is not logged in
        if (isset($ses_email)) {
            // Retrieves the isbnfrom the URL that was passed as a parameter from 'book.php' 
            $isbn = htmlspecialchars($_GET['isbn']);

            // Book Query
            $q = mysqli_query($db, "SELECT * FROM `book` WHERE isbn= '$isbn';");
            $row = mysqli_fetch_assoc($q);

            $name = htmlspecialchars($row['name']);
            $authors = htmlspecialchars($row['authors']);
            $edition = htmlspecialchars($row['edition']);
            $desc = htmlspecialchars($row['description']);
            $status = htmlspecialchars($row['status']);
            $limit = htmlspecialchars($row['limit']);
            $department = htmlspecialchars($row['department']);
            $pdf = htmlspecialchars($row['pdf']);

            // If the query is successful
            if ($q) {

        ?>

                <div class="box">

                    <h2>EDIT BOOK INFORMATION</h2> <br>

                    <div class="low_container">
                        <br>
                        <!-- Edit Book Form -->
                        <form action="editbook_sub.php" method="POST" enctype="multipart/form-data">
                            <div class="info">
                                <div id="addb">
                                    <div class="divider_form">
                                        <label for="bpic">BOOK COVER:</label>
                                        <input type="file" name="bpic" id="bpic"> <br><br><br>
                                    </div>
                                    <input type="text" name="glink" placeholder="GDrive Link" value="<?php echo $pdf; ?>" required style="display: inline-block;">
                                    <input type="hidden" name="org_isbn" value="<?php echo $isbn; ?>"> 
                                    <input type="text" name="new_isbn" placeholder="Book ISBN" value="<?php echo $isbn; ?>" required style="display: inline-block;"> <br><br>
                                    <input type="text" name="name" placeholder="Book Name" value="<?php echo $name; ?>" required style="display: inline-block;">
                                    <input type="text" name="authors" placeholder="Author(s)" value="<?php echo $authors; ?>" required style="display: inline-block;"> <br><br>
                                    <input type="text" name="edition" placeholder="Edition" value="<?php echo $edition; ?>" style="display: inline-block;">
                                    <input type="text" name="status" placeholder="Status" value="<?php echo $status; ?>" style="display: inline-block;"> <br><br>
                                    <input type="text" name="limit" placeholder="Limit" value="<?php echo $limit; ?>" required style="display: inline-block;">
                                    <input type="text" name="department" placeholder="Department" style="display: inline-block;"> <br><br>
                                </div>

                                <input class="button" type="submit" name="submit" value="EDIT"> <br><br>
                                <!-- GDrive Link -->
                                <a class="a-exempt" href="https://drive.google.com/drive/folders/1a6Sj-NRLloxQHzXGGscUw6wr7hCVLdS3?usp=share_link" style="font-size: 10px">GDrive Link</a> <br><br>
                            </div>

                            <div class="desc">
                                <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Description"><?php echo $desc ?></textarea>
                            </div>
                        </form>
                    </div>
                </div>

            <?php
                // If the query is unsuccessful
            } else {
            ?>
                <script type="text/javascript">
                    alert("An error occured. Please try again."); // Prints the error
                </script>
            <?php
                exit();
            }
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