<?php
include "../connection.php";

// Deleting books
if (isset($_POST['del_btn'])) {
    if (isset($_POST['del'])) {
        foreach ($_POST['del'] as $bookdel) {
            $q = mysqli_query($db, "DELETE FROM book WHERE isbn = '$bookdel' ");

            if ($q) {
?>
                <script>
                    alert("Book(s) deleted.");
                    history.back();
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Operation failed. Please try again.");
                    history.back();
                </script>
<?php
            }
        }
    }
}
?>