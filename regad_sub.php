<?php
include "connection.php";

// Checks if the user pressed the registration button named 'submit'
if (isset($_POST['submit'])) {
    // Retrieves the date from the registration form
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $contact = htmlspecialchars($_POST['contact']);
    $id = htmlspecialchars($_POST['did']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

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

    // Student Query
    $student_query = mysqli_query($db, "SELECT * FROM student WHERE email='$email' OR sid = '$id'; ");
    $student_rows = mysqli_num_rows($student_query);
    $student_data = mysqli_fetch_assoc($student_query);

    // Librarian Query
    $lib_query = mysqli_query($db, "SELECT * FROM lib WHERE email='$email' OR aid = '$id'; ");
    $lib_rows = mysqli_num_rows($lib_query);
    $lib_data = mysqli_fetch_assoc($lib_query);

    // Admin Query
    $admin_query = mysqli_query($db, "SELECT * FROM admin WHERE email='$email' OR did = '$id'; ");
    $admin_rows = mysqli_num_rows($admin_query);
    $admin_data = mysqli_fetch_assoc($admin_query);

    // If the query is successful
    if ($student_query && $lib_query && $admin_query) {
        // If the email and id is already in use
        if ($student_data > 0 || $lib_data > 0 || $admin_data > 0) {
        ?>
            <script>
                alert("Email/Admin ID is already in use.");
                history.back();
            </script>
            <?php
        } else {
            $numericRegex = '/^[0-9]{12}$/';
            // If the ID is invalid
            if (!preg_match($numericRegex, $id)) {
            ?>
                <script type="text/javascript">
                    alert("Invalid ID. Please input a valid one.");
                    history.back();
                </script>
                <?php
                exit();
            // Inserts new data in the db
            } else {
                $sql = mysqli_query($db, "INSERT `admin` VALUES('$fname', '$lname', '$contact', '$id', '$email', '$password'); ");

                // If the query is successful
                if ($sql) {
                ?>
                    <script type="text/javascript">
                        alert("Registered Successfully");
                        window.location = "index.php";
                    </script>
                <?php

                    // If the query is unsuccessful
                } else {
                ?>
                    <script type="text/javascript">
                        alert("An error occured. Please try again."); // Prints the error
                        window.location = "index.php";
                    </script>
        <?php
                    exit();
                }
            }
        }
        // If the query is unsuccessful
    } else {
        ?>
        <script type="text/javascript">
            alert("An error occured. Please try again."); // Prints the error
            window.location = "index.php";
        </script>
<?php
        exit();
    }
}
?>