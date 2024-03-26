<?php
include "navbar.php";
include "edit_prof_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PROFILE</title>
</head>

<style>
    .low_container {
        height: 99%;
    }
</style>

<body>
    <div class="wrapper">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email2']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="box">
                <h2>EDIT PROFILE INFORMATION</h2><br>
                <?php
                // Admin Query
                $q = mysqli_query($db, "SELECT * FROM `admin` where email = '$ses_email';");
                $row = mysqli_fetch_assoc($q);

                // Retrieves the data from the edit profile form
                $fname = htmlspecialchars($row['fname']);
                $lname = htmlspecialchars($row['lname']);
                $contact = htmlspecialchars($row['contact']);
                $email = htmlspecialchars($row['email']);
                $password = htmlspecialchars($row['password']);

                // If the query is successful
                if ($q) {
                ?>
                    <div class="low_container">
                        <!-- Edit Profile Form -->
                        <form method="POST">
                            <br>
                            <label for="fname">FIRST NAME:</label>
                            <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"> <br> <br>
                            <label for="lname">LAST NAME:</label>
                            <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>"> <br> <br>
                            <label for="contact">CONTACT:</label>
                            <input type="number" name="contact" id="contact" value="<?php echo $contact; ?>"> <br> <br>
                            <label for="text">EMAIL:</label>
                            <input type="text" name="email" id="email" value="<?php echo $email; ?>"> <br><br>
                            <label for="pass">PASSWORD:</label>
                            <input type="text" name="pass" id="pass" value="<?php echo $password; ?>"> <br> <br>
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