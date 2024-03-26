<?php
include "../connection.php";
include "navbar.php";
include "editborrow_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT BORROW</title>
</head>

<style>
    .low_container {
        height: 99%;
    }
</style>

<body>
    <div class="wrapper">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="box">
                <h2>EDIT BORROW INFORMATION</h2><br>
                <?php
                $isbn= htmlspecialchars($_GET['isbn']);
                $email = htmlspecialchars($_GET['email']);

                // Librarian Query
                $q = mysqli_query($db, "SELECT * FROM `issue_book` where username = '$email' AND isbn= '$isbn'; ");
                $row = mysqli_fetch_assoc($q);

                $issue = htmlspecialchars($row['issue']);
                $due = htmlspecialchars($row['due']);

                // If the query is successful
                if ($q) {
                ?>

                    <div class="low_container">
                        <br> <br>
                        <!-- Edit Profile Form -->
                        <form action="editborrow_sub.php" method="POST">
                            <label for="isbn">BOOK ID:</label>
                            <input type="text" name="isbn" id="isbn" value="<?php echo $isbn; ?>" readonly> <br> <br>
                            <label for="email">EMAIL:</label>
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly> <br> <br>
                            <label for="issue">ISSUE DATE:</label>
                            <input type="text" name="issue" id="issue" value="<?php echo $issue; ?>"> <br> <br>
                            <label for="due">DUE DATE:</label>
                            <input type="text" name="due" id="expiry" value="<?php echo $due; ?>"> <br> <br> <br> <br>
                            <input class="button" type="submit" name="submit" value="UPDATE">
                        </form>
                    </div>
            </div>
        <?php
                    // If the query is unsuccessful
                } else {
        ?>
            <script type="text/javascript">
                alert("An error occured. Please try again."); // Prints the error
            </script>
        <?php
                    exit();
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
    </div>
</body>

</html>