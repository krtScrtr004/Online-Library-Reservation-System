<?php
include "../connection.php";

// Checks if the user pressed the approve button named 'apr_btn'
if (isset($_POST['apr_btn'])) {

    // Retrieves data from the popup window form
    $isbn= htmlspecialchars($_POST['isbn']);
    $email = htmlspecialchars($_POST['email']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $approve = htmlspecialchars($_POST['approve']);
    $issue = htmlspecialchars($_POST['issue']);
    $due = htmlspecialchars($_POST['due']);

    // IF the request was approved
    if ($approve === "APPROVED") {

        // If the return date is left empty
        if (empty($due)) {

            // Adds 7-day intervals to approval date 
            $due = date('Y-m-d', strtotime($issue . ' +7 days'));

            // Updates the borrowing status data in the db
            $res = mysqli_query($db, "UPDATE `issue_book` SET `approve` = '$approve', `issue` = '$issue', `due` = '$due' WHERE username = '$email' AND isbn= '$isbn'; ");

            // Decrements the limit of the borrowed book
            $res1 = mysqli_query($db, "UPDATE `book` SET `limit` = `limit` - 1 WHERE `isbn` = '$isbn'; ");

            // Increments the book count of the book for most borrowed books statistics
            $res2 = mysqli_query($db, "UPDATE `book` SET bcount = bcount + 1 WHERE isbn= '$isbn'; ");

            // Records request history
            $res3 = mysqli_query($db, "UPDATE `hreq` SET `issue` = '$issue', `due` = '$due' WHERE fname = '$fname' AND lname = '$lname' AND isbn= '$isbn';");

            // If the query is unsuccessful
            if (!$res || !$res1 || !$res2 || !$res3) {
?>
                <script type="text/javascript">
                    alert("An error has occured. Please try again."); // Prints the error
                    history.back();
                </script>
            <?php
            }

            // If the due date is specified
        } else {
            // Updates the borrowing status data in the db
            $res = mysqli_query($db, "UPDATE `issue_book` SET `approve` = '$approve', `issue` = '$issue', `due` = '$due' WHERE username = '$email' AND isbn= '$isbn';");

            // Decrements the limit of the borrowed book
            $res1 = mysqli_query($db, "UPDATE `book` SET `limit` = `limit` - 1 WHERE isbn= '$isbn';");

            // Increments the book count of the book for most borrowed books statistics
            $res2 = mysqli_query($db, "UPDATE `book` SET bcount = bcount + 1 WHERE isbn= '$isbn';");

            // Increments the book count of the book for most borrowed books statistics
            $res3 = mysqli_query($db, "UPDATE `hreq` SET `issue` = '$issue', `due` = '$due' WHERE fname = '$fname' AND lname = '$lname' AND isbn= '$isbn';");

            // If the query is unsuccessful
            if (!$res || !$res1 || !$res2 || !$res3) {
            ?>
                <script type="text/javascript">
                    alert("An error has occured. Please try again."); // Prints the error
                    history.back();
                </script>
        <?php
            }
        }
        ?>
        <script>
            window.location = "request.php";
        </script>
        <?php
        // If the request was denied
    } else if ($approve === "DENIED" || $approve === "REJECTED") {
        // Updates the borrowing status data in the db
        $res = mysqli_query($db, "UPDATE `issue_book` SET `approve` = 'DENIED' WHERE username = '$email' AND isbn= '$isbn' ");

        // If the status is not denied
        if (!$res) {
        ?>
            <script type="text/javascript">
                alert("Status has not been updated. Please try again."); // Prints the error
                history.back();
            </script>
        <?php
        }

        ?>
        <script>
            window.location = "request.php";
        </script>
<?php
    }
}
?>