<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email']);

// Checks if the user is logged in
if (isset($ses_email)) {
    // If the user pressed 'Yes' button
    if (isset($_GET["btn_yes"])) {
        // Retrieves the isbnfrom the URL that was passed as a parameter from 'book.php' 
        $isbn= htmlspecialchars($_GET["isbn"]);

        // Issue_Book Query
        $result = mysqli_query($db, "SELECT approve FROM `issue_book` WHERE username = '$ses_email' AND isbn= '$isbn'");
        $row = mysqli_fetch_assoc($result);
        // Retrieves data from the db
        $approve = htmlspecialchars($row['approve']);

        // If the query is successful
        if ($result) {
            // If the request is approved
            if ($approve == 'APPROVED') {
                echo "<script> alert('You cannot cancel an approved request.') </script>";
                echo "<script>window.location ='breq.php';</script>";
                // If the request is not yet approved
            } else {
                // Deletes request data
                $q = mysqli_query($db, "DELETE FROM `issue_book` WHERE username = '$ses_email' AND isbn= '$isbn' AND approve = '' OR approve = 'DENIED' AND issue = ' ' ");

                // If the request is deleted
                if ($q) {
                    echo "<script> alert('Request cancelled.') </script>";
                    echo "<script>window.location ='breq.php';</script>";
                    // If the request is not deleted
                } else {
?>
                    <script type="text/javascript">
                        alert("An error has occured. Please try again."); // Prints the error
                    </script>
            <?php
                }
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

    // If the user pressed 'No' button
    if (isset($_GET["btn_no"])) {
        echo "<script>window.location.href='issue_info.php';</script>";
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
?>