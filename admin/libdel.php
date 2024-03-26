<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email2']);

// Checks if the user is logged in
if (isset($ses_email)) {
    // If the user pressed the 'Yes' button
    if (isset($_GET["btn_yes"])) {
        // Retrieves the email from the URL that was passed as a parameter from 'lib.php' 
        $email = htmlspecialchars($_GET["email"]);

        // Deletes the data from the db
        $sql = mysqli_query($db, "DELETE FROM `lib` WHERE email = '$email' ");

        // If the query is succesful
        if ($sql) {
            echo "<script> alert('Librarian Removed.') </script>";
            echo "<script>window.location ='lib.php';</script>";
            // If the query is not successful
        } else {
?>
            <script type="text/javascript">
                alert("An error occured. Please try again."); // Prints the error
            </script>
    <?php
            exit();
        }
    }

    // If the user pressed the 'No' button
    if (isset($_GET["btn_no"])) {
        echo "<script>window.location.href='lib.php';</script>";
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
