<?php
include "connection.php";

// Checks if the user pressed the change pass button named 'submit'
if (isset($_POST['submit'])) {
    // Retrieves the data from change pass form
    $email = htmlspecialchars($_POST['email']);
    $id = htmlspecialchars($_POST['id']);
    $npassword = htmlspecialchars($_POST['npassword']);

    // Student Query
    $student_query = mysqli_query($db, "SELECT * FROM student WHERE email='$email' AND sid='$id'");
    $student_rows = mysqli_num_rows($student_query);
    $student_data = mysqli_fetch_assoc($student_query);

    // Librarian Query
    $lib_query = mysqli_query($db, "SELECT * FROM lib WHERE email='$email' AND aid='$id'");
    $lib_rows = mysqli_num_rows($lib_query);
    $lib_data = mysqli_fetch_assoc($lib_query);

    // If the query is successful
    if ($student_query && $lib_query) {
        // If the id and email is present in student db
        if ($student_rows == 1) {
            // Updates the password
            $result = mysqli_query($db, "UPDATE `student` SET password = '$npassword' WHERE email = '$email' AND sid = '$id';");
            // If the process is successful
            if ($result) {
?>
                <script>
                    alert("Password updated successfully");
                    window.location = "index.php";
                </script>;
            <?php
                // If the process is not successful
            } else {
            ?>
                <script>
                    alert("Error updating password");
                    history.back();
                </script>
            <?php
            }
        // If the id and email is present in librarian db
        } else if ($lib_rows == 1) {
            // Updates the password
            $result = mysqli_query($db, "UPDATE `lib` SET password = '$npassword' WHERE email = '$email' AND aid = '$id';");
            // If the process is successful
            if ($result) {
            ?>
                <script>
                    alert("Password updated successfully");
                    window.location = "index.php";
                </script>
            <?php
                // If the process is not successful
            } else {
            ?>
                <script>
                    alert("Error updating password");
                    history.back();
                </script>';
        <?php
            }
        } else {
            ?>
                <script>
                    alert("Email and/or ID does not matched.");
                    history.back();
                </script>
            <?php
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