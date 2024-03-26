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
    <title>LIBRARIAN VERIFICATION</title>
</head>

<body>
    <div class="wrapper1">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email2']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="table_cont">
                <div class="divider">
                    <!-- Refreshes the page when clicked -->
                    <h2 id="hname" class="exempt-hover"><a href="libver.php" class="a-exempt" style="color: black">LIBRARIAN ACCOUNT VERIFICATION</a></h2>
                    <!-- Search Bar -->
                    <div class="srch">
                        <form method="post">
                            <input type="text" name="search" placeholder="Search..." required>
                            <button type="submit" name="submit">S</button>
                        </form>
                    </div>
                </div>

                <!-- Table Area -->
                <div class="scroll">
                    <?php
                    // Checks if the user pressed the search button named 'submit'
                    if (isset($_POST['submit'])) {
                        // Retreives the search term from the search bar
                        $search_term = "%" . $_POST["search"] . "%";
                        // Search query
                        $q = mysqli_query($db, "SELECT fname, lname, contact, aid, email FROM `lib` WHERE (fname like '$search_term' OR lname like '$search_term' OR contact like '$search_term' OR aid like '$search_term' OR email like '$search_term') AND verify = ' ' ");
                        // If the query is succesful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No librarian matched. </div>";
                                // If the search term matched to data    
                            } else {
                                echo "<form action='act.php' method='POST'>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th style='background-color:green; padding: 2px;'>";
                    ?>
                                <input class="a-exempt" type="submit" name="lib_apr_btn" id="" value="&#10004;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th style='background-color:red; padding: 2px;'>";
                                ?>
                                <input class="a-exempt" type="submit" name="lib_rej_btn" id="" value="&#10006;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th>";
                                echo "NAME";
                                echo "</th>";
                                echo "<th>";
                                echo "INFORMATION";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $fname = htmlspecialchars($row['fname']);
                                    $lname = htmlspecialchars($row['lname']);
                                    $aid = htmlspecialchars($row['aid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);

                                    echo "<tr>";
                                    echo "<td style='width: 5px; padding:0;'>";
                                ?>
                                    <input type="checkbox" name="lib_apr[]" value="<?php echo $aid; ?>" style="width: 50px; height: 20px;">
                                    <?php
                                    echo "</td>";
                                    echo "<td style='width: 5px; padding:0;'>";
                                    ?>
                                    <input type="checkbox" name="lib_rej[]" value="<?php echo $aid; ?>" style="width: 50px; height: 20px;">
                            <?php
                                    echo "</td>";
                                    echo "<td>";
                                    echo $lname . ', ' . $fname;
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<div class='td_info'>ID: ";
                                    echo $aid;
                                    echo "</div>";
                                    echo "<div class='td_info'>EMAIL: ";
                                    echo $email;
                                    echo "</div>";
                                    echo "<div class='td_info'>CONTACT: ";
                                    echo $contact;
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</form>";
                            }
                            // If the query is unsuccessful
                        } else {
                            ?>
                            <script type="text/javascript">
                                alert("An error occured. Please try again."); // Prints the error
                            </script>
                            <?php
                            exit();
                        }
                    } else {
                        // Libraian Query
                        $res = mysqli_query($db, "SELECT * FROM `lib` WHERE verify = ' ' ");
                        $q = mysqli_num_rows($res);
                        // If the query is successful
                        if ($res) {
                            // If there is no unapproved librarian 
                            if ($q == '0') {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No pending registration. </div>";
                                // If there is an unapproved librarian 
                            } else {
                                echo "<form action='act.php' method='POST'>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th style='background-color:green; padding: 2px;'>";
                            ?>
                                <input class="a-exempt" type="submit" name="lib_apr_btn" id="" value="&#10004;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th style='background-color:red; padding: 2px;'>";
                                ?>
                                <input class="a-exempt" type="submit" name="lib_rej_btn" id="" value="&#10006;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th>";
                                echo "NAME";
                                echo "</th>";
                                echo "<th>";
                                echo "INFORMATION";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $fname = htmlspecialchars($row['fname']);
                                    $lname = htmlspecialchars($row['lname']);
                                    $aid = htmlspecialchars($row['aid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);

                                    echo "<tr>";
                                    echo "<td style='width: 5px; padding:0;'>";
                                ?>
                                    <input type="checkbox" name="lib_apr[]" value="<?php echo $aid; ?>" style="width: 50px; height: 20px;">
                                    <?php
                                    echo "</td>";
                                    echo "<td style='width: 5px; padding:0;'>";
                                    ?>
                                    <input type="checkbox" name="lib_rej[]" value="<?php echo $aid; ?>" style="width: 50px; height: 20px;">
                            <?php
                                    echo "</td>";
                                    echo "<td>";
                                    echo $lname . ', ' . $fname;
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<div class='td_info'>ID: ";
                                    echo $aid;
                                    echo "</div>";
                                    echo "<div class='td_info'>EMAIL: ";
                                    echo $email;
                                    echo "</div>";
                                    echo "<div class='td_info'>CONTACT: ";
                                    echo $contact;
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                                echo "</form>";
                            }
                            // If the query is unsuccessful
                        } else {
                            ?>
                            <script type="text/javascript">
                                alert("An error occured. Please try again."); // Prints the error
                            </script>
                    <?php
                            exit();
                        }
                    }
                    ?>
                </div>
            </div>

        <?php
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