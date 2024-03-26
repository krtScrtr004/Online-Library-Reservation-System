<?php
include "connection.php";

// Retrieves the code from the URL that was passed as a parameter from the popup form in 'reg.php'
$code = $_POST['code'];

// Admin registration code query
$q = mysqli_query($db, "SELECT * FROM `regc`WHERE code = '$code' ");
$res = mysqli_num_rows($q);
$row = mysqli_fetch_assoc($q);

// If the query is successful
if ($q) {
    // Checks if $code is present in the db
    if ($res == 1) {
?>
        <script>
            window.location = "regad.php"; // Redirects to admin account registration
        </script>
    <?php
        // If the code is not in the db
    } else {
    ?>
        <script>
            alert("Invalid Code.");
            window.location = "reg.php";
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
?>