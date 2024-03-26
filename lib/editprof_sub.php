 <?php
 include "../connection.php";

    // Checks if the user pressed the edit profile button named 'submit'
    if (isset($_POST['submit'])) {
        session_start();
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Librarian Query
        $sql = "SELECT * FROM `lib` WHERE email = '$ses_email'";
        $result = mysqli_query($db, $sql);

        // If the query is successful
        if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Retrieves the data from the edit profile form
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $contact = htmlspecialchars($_POST['contact']);
        $pass = htmlspecialchars($_POST['pass']);
        // Updates account information
        $q = mysqli_query($db, "UPDATE `lib` SET `fname` = '$fname', `lname` = '$lname', `contact` = '$contact', `password` = '$pass' WHERE `email` = '$ses_email' ");

        // If the profile is successfully edited
        if ($q) {
    ?>
     <script type="text/javascript">
         alert("Profile has edited successfuly");
         window.location = "profile.php";
     </script>
 <?php
        // If the profile has not been edited
        } else {
    ?>
            <script type="text/javascript">
                alert("Profile has not been edited."); // Prints the error
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