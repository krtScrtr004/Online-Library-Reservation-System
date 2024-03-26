<?php
include "../connection.php";

// Checks if the user pressed the edit profile button named 'submit'
if (isset($_POST['submit'])) {
    $ses_email = htmlspecialchars($_SESSION['email2']);

    // Retrieves the data from the edit profile form
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);

    // Checks if email contains "@"
    if (strpos($email, '@') === false) {
        // If email does not contain "@", display an error message 
?>
        <script>
            alert("Invalid email address. Please enter a valid one.");
            history.back();
        </script>
        <?php
        exit();
    }

    // Admin Query
    $sql = "SELECT * FROM `admin` WHERE email = '$ses_email'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    // If the query is successful
    if ($sql) {

        // Updates account information
        $res = mysqli_query($db, "UPDATE `admin` SET `fname` = '$fname', `lname` = '$lname', `contact` = '$contact', `email` = '$email', `password` = '$pass' WHERE `email` = '$ses_email' ");

        // If the query is successful
        if ($res) {
        ?>
            <script type="text/javascript">
                alert("Profile has edited successfuly.");
                window.location = "profile.php";
            </script>
        <?php
            // If the query is unsuccessful
        } else {
        ?>
            <script type="text/javascript">
                alert("Profile has not edited. Please try again.");
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