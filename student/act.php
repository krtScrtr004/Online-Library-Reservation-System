<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email']);

// Cancelling books
if (isset($_POST['reg_cnl_btn'])) {
    if (isset($_POST['reg_cnl'])) {
        foreach ($_POST['reg_cnl'] as $bookdel) {
            $result = mysqli_query($db, "SELECT approve FROM `issue_book` WHERE username = '$ses_email' AND isbn = '$bookdel'");
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
                    $q = mysqli_query($db, "DELETE FROM `issue_book` WHERE username = '$ses_email' AND isbn= '$bookdel' AND approve = ' ' OR approve = 'DENIED' AND issue = ' ' ");

                    // If the request is deleted
                    if ($q) {
                        echo "<script> alert('Request(s) cancelled.') </script>";
                        echo "<script>window.location ='breq.php';</script>";
                        // If the request is not deleted
                    } else {
?>
                        <script type="text/javascript">
                            alert("An error has occured. Please try again."); // Prints the error
                            history.back();
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
    }
}
?>
