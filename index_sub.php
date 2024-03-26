<?php
include "connection.php";
session_start();
date_default_timezone_set('Asia/Manila'); // Sets the timezone to Asia/Manila

// Checks if the user pressed the login button named 'submit'
if (isset($_POST['submit'])) {
    // Retrieves the data from the login form
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $current_date = date("Y-m-d"); // Retrieves current date (Year-Month-Day)
    $current_time = date("h:i:s a"); // Retreieves current time (Hour-Minute-Seconds AM/PM)

    // Student Query
    $student_query = mysqli_query($db, "SELECT * FROM student WHERE email='$email' AND password='$password'");
    $student_rows = mysqli_num_rows($student_query);
    $student_data = mysqli_fetch_assoc($student_query);

    // Librarian Query
    $lib_query = mysqli_query($db, "SELECT * FROM lib WHERE email='$email' AND password='$password'");
    $lib_rows = mysqli_num_rows($lib_query);
    $lib_data = mysqli_fetch_assoc($lib_query);

    // Admin Query
    $admin_query = mysqli_query($db, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
    $admin_rows = mysqli_num_rows($admin_query);
    $admin_data = mysqli_fetch_assoc($admin_query);

    // If the query is successful
    if ($student_query && $lib_query && $admin_query) {
        // Checks if the email and password is present in student db
        if ($student_rows == 1) {
            // Checks if account has already been validated
            if ($student_data['verify'] == 'VERIFIED') {
                $_SESSION['email'] = $email; // Creates session
                mysqli_query($db, "INSERT INTO log (email, date, log) VALUES ('$email', '$current_date', '$current_time')"); // Records in time
                header("location: student/home.php"); // Redirects to home page
                // Checks if account has been rejected
            } else if ($student_data['verify'] == 'REJECTED') {
?>
                <script>
                    alert("Your account was rejected.");
                    window.location = "index.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Wait until your account is verified by the Admins.");
                    window.location = "index.php";
                </script>
            <?php
            }
            // Checks if the email and password is present in librarian db
        } else if ($lib_rows == 1) {
            // Checks if account has already been validated
            if ($lib_data['verify'] === 'VERIFIED') {
                $_SESSION['email1'] = $email; // Creates session
                mysqli_query($db, "INSERT INTO log (email, date, log) VALUES ('$email', '$current_date', '$current_time')"); // Records in time
                header("location: lib/home.php"); // Redirects to home page
            } else if ($lib_data['verify'] == 'REJECTED') {
            ?>
                <script>
                    alert("Your account was rejected.");
                    window.location = "index.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Wait until your account is verified by the Admins.");
                    window.location = "index.php";
                </script>
            <?php
            }
            // Checks if the email and password is present in admin db
        } else if ($admin_rows == 1) {
            $_SESSION['email2'] = $email; // Creates session
            ?>
            <script>
                window.location = "admin/home.php"; // Redirects to home page
            </script>
        <?php
            // If invalid inputs
        } else {
        ?>
            <script>
                alert("Invalid email/password.");
                window.location = "index.php";
            </script>
        <?php
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