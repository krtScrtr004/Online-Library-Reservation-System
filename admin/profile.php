<?php
include "../connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE</title>
</head>

<style>
    table {
        width: 95%;
    }

    th,
    td {
        padding: 8px;
        border: 1px thin black;
        text-align: left;
        border: none;
    }
</style>

<body>

    <div class="wrapper">
        <?php
        $ses_email = htmlspecialchars($_SESSION['email2']);
        
        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="box" style="height: 400px;">
                <?php
                // Admin Query
                $q = mysqli_query($db, "SELECT * FROM `admin` where email = '$ses_email';");

                // If the query is successful
                if ($q) {
                ?>

                    <h2>PROFILE INFORMATION</h2> <br>
                    <?php
                    $row = mysqli_fetch_assoc($q);
                    // Retrieves data from the db
                    $fname = htmlspecialchars($row['fname']);
                    $lname = htmlspecialchars($row['lname']);
                    $contact = htmlspecialchars($row['contact']);
                    $did = htmlspecialchars($row['did']);
                    $email = htmlspecialchars($row['email']);
                    ?>

                    <!-- Displays profile information -->
                    <div class="low_container">
                        <br> <br>
                        <?php
                        echo "<table>";
                        echo "<th>";
                        echo "ADMIN";
                        echo "</th>";
                        echo "<th>";
                        echo "</th>";
                        echo "<tr>";
                        echo "<td>";
                        echo "<b>First Name </b>";
                        echo "</td>";
                        echo "<td>";
                        echo $fname;
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<b>Last Name </b>";
                        echo "</td>";
                        echo "<td>";
                        echo $lname;
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<b>Contact Number </b>";
                        echo "</td>";
                        echo "<td>";
                        echo $contact;
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<b>Admin ID </b>";
                        echo "</td>";
                        echo "<td>";
                        echo $did;
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<b>Email </b>";
                        echo "</td>";
                        echo "<td>";
                        echo $email;
                        echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                        ?>
                        <br>
                        <!-- Edit Profile Button -->
                        <form method="POST">
                            <button class="button exempt-hover" style="margin-right: 50px; margin-top: 10px; margin: 0 auto; background-color: rgb(2, 24, 153);" name="submit1"><a href="editprof.php" class="a-exempt" style="color: white;;">EDIT</a></button>
                        </form>
                    </div>
            </div>
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
<br>
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