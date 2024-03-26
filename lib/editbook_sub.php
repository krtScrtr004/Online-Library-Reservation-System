<?php
include "../connection.php";

// Checks if the user pressed the edit book button named 'submit'
if (isset($_POST['submit'])) {
    $isbn= htmlspecialchars($_POST['org_isbn']);
    $isbn1 = htmlspecialchars($_POST['new_isbn']);

    // Book Query 
    $sql = "SELECT * FROM book WHERE isbn = '$isbn'; ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    // If the query is successful 
    if ($sql) {
        // Checks if a new book cover is uploaded
        if (isset($_FILES['bpic']) && $_FILES['bpic']['error'] == 0) {
            // Retrieves image from the edit book form
            $bpic = $_FILES['bpic']['name'];

            // Moves new image to permanent directory
            move_uploaded_file($_FILES['bpic']['tmp_name'], "bpic/" . $bpic);

            // If the user did not upload new book cover
        } else {
            // Retrieves old image from the db
            $bpic = $row['bpic'];
        }

        // Retrieves the data from the edit book form
        $glink = htmlspecialchars($_POST['glink']);
        $name = htmlspecialchars($_POST['name']);
        $authors = htmlspecialchars($_POST['authors']); 
        $edition = htmlspecialchars($_POST['edition']);
        $desc = htmlspecialchars($_POST['desc']); 
        $status = htmlspecialchars($_POST['status']);
        $limit = htmlspecialchars($_POST['limit']);
        $department = htmlspecialchars($_POST['department']);
        // Update book information
        $q = mysqli_query($db, "UPDATE `book` SET `bpic` = '$bpic',`name`='$name', `isbn`='$isbn1', `authors`= '$authors',`edition`='$edition', `description` = '$desc', `status`='$status',`limit`='$limit',`department`='$department', `pdf` = '$glink' WHERE `isbn` = '$isbn';");

        // If the book is successfully edited
        if ($q) {

            // If the limit reached 0
            if ($limit === '0') {
                $sql = mysqli_query($db, "UPDATE book SET status = 'Not available' WHERE isbn= '$isbn'; ");

                // If the query is successful
                if (!$sql) {
?>
                    <script type="text/javascript">
                        alert("An error occured. Please try again"); // Prints the error
                        history.back();
                    </script>
                <?php
                }
            } else {
                $sql = mysqli_query($db, "UPDATE book SET status = 'Available' WHERE isbn= '$isbn'; ");

                // If the query is successful
                if (!$sql) {
                ?>
                    <script type="text/javascript">
                        alert("An error occured. Please try again"); // Prints the error
                        history.back();
                    </script>
            <?php
                }
            }
            ?>
            <script type="text/javascript">
                alert("Book has edited successfuly");
                window.location = "book.php";
            </script>
        <?php
            // If book has not been edited succesffuly
        } else {
        ?>
            <script type="text/javascript">
                alert("Book has not been edited."); // Prints the error
                history.back();
            </script>
        <?php
        }
        // If the query is unsuccessful
    } else {
        ?>
        <script type="text/javascript">
            alert("An error occured. Please try again."); // Prints the error
        </script>
<?php
        exit();
    }
}
?>