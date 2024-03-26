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
    <title>LOG HISTORY</title>
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
                    <h2 id="hname" class="exempt-hover"><a href="log.php" class="a-exempt" style="color: black">LOG HISTORY</a></h2>
                    <!-- Search Bar -->
                    <div class="srch">
                        <form method="post">
                            <input type="text" name="search" placeholder="Search..." required>
                            <button type="submit" name="submit"> S
                            </button>
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
                        $q = mysqli_query($db, "SELECT  FROM `log` WHERE email like '$search_term' OR log like '$search_term' OR outm like '$search_term' ");
                        // If the query is successful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No log history matched. </div>";
                                // If the search term matched to data
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "EMAIL";
                                echo "</th>";
                                echo "<th>";
                                echo "DATE";
                                echo "</th>";
                                echo "<th>";
                                echo "IN TIME";
                                echo "</th>";
                                echo "<th>";
                                echo "OUT TIME";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $email = htmlspecialchars($row['email']);
                                    $date = htmlspecialchars($row['date']);
                                    $log = htmlspecialchars($row['log']);
                                    $outm = htmlspecialchars($row['outm']);

                                    echo "<tr>";
                                    echo "<td>";
                                    echo $email;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $date;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $log;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $outm;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            // If the query is successful
                        } else {
                    ?>
                            <script type="text/javascript">
                                alert("An error occured. Please try again."); // Prints the error
                            </script>
                        <?php
                            exit();
                        }
                    } else {
                        $res = mysqli_query($db, "SELECT * FROM `log` ORDER BY date DESC, log DESC");
                        // If the query is successful
                        if ($res) {
                            if (mysqli_num_rows($res) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No available log history. </div>";
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "EMAIL";
                                echo "</th>";
                                echo "<th>";
                                echo "DATE";
                                echo "</th>";
                                echo "<th>";
                                echo "IN TIME";
                                echo "</th>";
                                echo "<th>";
                                echo "OUT TIME";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $email = htmlspecialchars($row['email']);
                                    $date = htmlspecialchars($row['date']);
                                    $log = htmlspecialchars($row['log']);
                                    $outm = htmlspecialchars($row['outm']);

                                    echo "<tr>";
                                    echo "<td>";
                                    echo $email;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $date;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $log;
                                    echo "</td>";
                                    echo "<td>";
                                    echo $outm;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
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