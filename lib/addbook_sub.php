 <?php
    include "../connection.php";

    // Checks if the user pressed the add book button named 'submit'
    if (isset($_POST['submit'])) {
        // Retrieves book id from the add book form
        $data = htmlspecialchars($_POST["isbn"]);

        // Book Query
        $query = "SELECT * FROM book WHERE isbn= '$data'";
        $result = mysqli_query($db, $query);
        $count = mysqli_num_rows($result);

        // Move files to permanent directories
        move_uploaded_file($_FILES['file']['tmp_name'], "bpic/" . $_FILES['file']['name']); // Book Cover

        // If the query is successful
        if ($query) {
            // If book id is already in use
            if ($count > 0) {
                echo "<script>alert('Book ID already exists.');</script>";
                // Inserts new data in the db
            } else {
                // Retrieves data from the add book form
                session_start();
                $ses_email = htmlspecialchars($_SESSION['email1']);
                $bpic = $_FILES['file']['name'];
                $isbn= htmlspecialchars($_POST['isbn']);
                $name = htmlspecialchars($_POST['name']);
                $authors = htmlentities($_POST['authors']);
                $edition = htmlspecialchars($_POST['edition']);
                $status = htmlspecialchars($_POST['status']);
                $limit = htmlspecialchars($_POST['limit']);
                $department = htmlspecialchars($_POST['department']);
                $desc = htmlspecialchars($_POST['desc']);
                $glink = htmlspecialchars($_POST['glink']);

                // Inserts new book in the db
                $sql = mysqli_query($db, "INSERT INTO `book` VALUES ('$bpic', '$isbn', '$name', '$authors', '$edition', '$desc', '$status', '$limit', '$department', '0', '$ses_email', '$glink');");

                // If the book is successfully added
                if ($sql) {
    ?>
             <script type="text/javascript">
                 alert("Book added successfuly");
                 window.location = "book.php";
             </script>
         <?php
             // If the book is unsuccessfully added
        } else {
            ?>
         <script type="text/javascript">
             alert("Book has not been added. Please try again."); // Prints the error
             history.back();
         </script>
 <?php
            exit();
        }
            }
            // If the query is unsuccessful
        } else {
            ?>
         <script type="text/javascript">
             alert("An error occured. Please try again."); // Prints the error
             history.back();
         </script>
 <?php
            exit();
        }
    }
    ?>