<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email']);
// Checks if the user pressed the edit profile button named 'submit'
if (isset($_POST['submit'])) {
    // Student Query
    $sql = "SELECT * FROM `student` WHERE email = '$ses_email' ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    // If the query is successful
    if ($sql) {
        // Retrieves the data from the edit profile form        
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $contact = htmlspecialchars($_POST['contact']);
        $pass = htmlspecialchars($_POST['pass']);
        // Updates account information
        $q = mysqli_query($db, "UPDATE `student` SET `fname`='$fname', `lname`='$lname', `contact`='$contact', `password`='$pass' WHERE `email`='$ses_email'");

        // If the profile is updated
        if ($q) {
?>
            <script type="text/javascript">
                alert("Profile has edited successfuly");
                window.location = "profile.php";
            </script>
        <?php
            // If the profile has not been updated
        } else {
        ?>
            <script type="text/javascript">
                alert("Profile has not been updated. Please try again."); // Prints the error
                history.back();
            </script>
        <?php
        }
        // If the query is unsuccessful
    } else {
        ?>
        <script type="text/javascript">
            alert("An error has occured. Please try again."); // Prints the error
        </script>
<?php
    }
}
?>