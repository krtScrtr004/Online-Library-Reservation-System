<?php
include "../connection.php";

// Deleting librarians
if (isset($_POST['lib_del_btn'])) {
    if (isset($_POST['del'])) {
        foreach ($_POST['del'] as $libdel) {
            $q = mysqli_query($db, "DELETE FROM lib WHERE aid = '$libdel' ORDER BY aid ASC LIMIT 1; ");

            if ($q) {
?>
                <script>
                    alert("Librarian(s) deleted successfully");
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

// Verifying librarians
if (isset($_POST['lib_apr_btn'])) {
    if (isset($_POST['lib_apr'])) {
        foreach ($_POST['lib_apr'] as $libapr) {
            $q = mysqli_query($db, "UPDATE lib SET verify = 'VERIFIED' WHERE aid = '$libapr'; ");

            if ($q) {
            ?>
                <script>
                    alert("Librarian(s) verified.");
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

// Rejecting librarians
if (isset($_POST['lib_rej_btn'])) {
    if (isset($_POST['lib_rej'])) {
        foreach ($_POST['lib_rej'] as $librej) {
            $q = mysqli_query($db, "UPDATE lib SET verify = 'REJECTED' WHERE aid = '$librej' ORDER BY aid ASC LIMIT 1; ");

            if ($q) {
            ?>
                <script>
                    alert("Librarian(s) rejected.");
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

// Deleting students
if (isset($_POST['stud_del_btn'])) {
    if (isset($_POST['stud_del'])) {
        foreach ($_POST['stud_del'] as $studdel) {
            $q = mysqli_query($db, "DELETE FROM student WHERE sid = '$studdel' ORDER BY sid ASC LIMIT 1; ");

            if ($q) {
            ?>
                <script>
                    alert("Student(s) deleted.");
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

// Verifying students
if (isset($_POST['stud_apr_btn'])) {
    if (isset($_POST['stud_apr'])) {
        foreach ($_POST['stud_apr'] as $studapr) {
            $q = mysqli_query($db, "UPDATE student SET verify = 'VERIFIED' WHERE sid = '$studapr' ORDER BY sid ASC LIMIT 1; ");

            if ($q) {
            ?>
                <script>
                    alert("Student(s) verified.");
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

// Rejecting students
if (isset($_POST['stud_rej_btn'])) {
    if (isset($_POST['stud_rej'])) {
        foreach ($_POST['stud_rej'] as $studrej) {
            $q = mysqli_query($db, "UPDATE student SET verify = 'REJECTED' WHERE sid = '$studrej' ORDER BY sid ASC LIMIT 1; ");

            if ($q) {
            ?>
                <script>
                    alert("Student(s) rejected.");
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
