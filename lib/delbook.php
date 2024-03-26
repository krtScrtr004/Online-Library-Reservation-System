<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email1']);

// Checks if the user is logged in
if (isset($ses_email)) {
    // If the user pressed 'Yes' button
    if (isset($_GET["btn_yes"])) {
        // Retrieves the isbnfrom the URL that was passed as a parameter from 'book.php' 
        $isbn= htmlspecialchars($_GET["isbn"]);

        // Deletes data in the db
        $q = mysqli_query($db, "DELETE FROM `book` WHERE isbn= '$isbn' ");

        // If the query is successful
        if ($q) {
            echo "<script> alert('Data Deleted.') </script>";
            echo "<script>window.location ='book.php';</script>";
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

    // If the user pressed 'No' button
    if (isset($_GET["btn_no"])) {
        echo "<script>window.location.href='book.php';</script>";
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