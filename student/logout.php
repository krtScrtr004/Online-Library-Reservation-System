<?php
include "../connection.php";
session_start();
date_default_timezone_set('Asia/Manila'); // Sets the timezone to Asia/Manila

$ses_email = htmlspecialchars($_SESSION['email']);
// Checks if the user is logged in
if (isset($ses_email)) {
    // Retreives data
    $current_time = date("h:i:s a"); // Current date

    // Records out time
    $sql = mysqli_query($db, "UPDATE `log` SET outm = '$current_time' WHERE email = '$ses_email' AND outm = ' ' ");
    // If the query is unsuccessful
    if (!$sql) {
?>
        <script type="text/javascript">
            alert("An error has occured. Please try again."); // Prints the error
        </script>
    <?php
    }

    // Destroys session
    unset($ses_email);
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
header("location: ../index.php");
?>