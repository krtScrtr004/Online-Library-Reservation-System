<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email2']);

// Checks if the user is logged in
if (isset($ses_email)) {
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