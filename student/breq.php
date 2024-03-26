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
    <title>REQUEST INFORMATION</title>
</head>

<body>
    <div class="wrapper1">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email']);

        // Check if the user is logged
        if (isset($ses_email)) {

        ?>

            <div class="table_cont">
                <div class="divider">
                    <!-- Refreshes the page when clicked -->
                    <h2 id="hname" class="exempt-hover"><a href="breq.php" class="a-exempt" style="color: black">BOOK REQUESTS</a></h2>
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
                        $q = mysqli_query($db, "SELECT `book` .name, `issue_book` . isbn, approve, issue, due FROM `book` INNER JOIN `issue_book` ON `book` . isbn= `issue_book` . isbnWHERE `book` . isbnLIKE '$search_term' OR name LIKE '$search_term' OR approve LIKE '$search_term' ");
                        // If the query is successful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No book matched. </div>";
                                // If the search term matched to data
                            } else {
                                echo "<form action='act.php' method='POST'>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th style='background-color:red; padding: 2px;'>";
                    ?>
                                <input class="a-exempt" type="submit" name="reg_cnl_btn" id="" value="&#10006;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "APPROVAL STATUS";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $isbn = htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $approve = htmlspecialchars($row['approve']);
                                    $issue = htmlspecialchars($row['issue']);
                                    $due = htmlspecialchars($row['due']);

                                    echo "<tr>";
                                    echo "<td style='width: 5px; padding: 0;'>";
                                ?>
                                    <input type="checkbox" name="reg_cnl[]" value="<?php echo $isbn; ?>" style="width: 50px; height: 20px;">
                            <?php
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<div class='td_info'>ISBN: ";
                                    echo $isbn;
                                    echo "</div>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $name;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $approve;
                                    echo "</div>";
                                    echo "<div class='td_info'>ISSUE DATE: ";
                                    echo $issue;
                                    echo "</div>";
                                    echo "<div class='td_info'>DUE DATE: ";
                                    echo $due;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    // Button to view the book where 'isbn' is passed as a parameter
                                    echo "<div><a href='read.php?isbn=$isbn' class='a-exempt tb_btn' style='background-color: rgb(6, 4, 129); padding: 5px; border-radius: 5px; color: white'>OPEN</a></div>";
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
                                alert("An error has occured. Please try again."); // Prints the error
                            </script>
                            <?php
                        }
                    } else {
                        // Issue_Book, Book Query
                        $sql = mysqli_query($db, "SELECT `book` .name, `issue_book` . isbn, approve, issue, due FROM `book` INNER JOIN `issue_book` ON `book` . isbn= `issue_book` . isbn WHERE username = '$_SESSION[email]'");
                        // If the query is successful
                        if ($sql) {
                            // If there is no request
                            if (mysqli_num_rows($sql) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No book requested. </div>";
                                // If there is no request
                            } else {
                                echo "<form action='act.php' method='POST'>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th style='background-color:red; padding: 2px;'>";
                            ?>
                                <input class="a-exempt" type="submit" name="reg_cnl_btn" id="" value="&#10006;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                                <?php
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "APPROVAL STATUS";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $isbn = htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $approve = htmlspecialchars($row['approve']);
                                    $issue = htmlspecialchars($row['issue']);
                                    $due = htmlspecialchars($row['due']);

                                    echo "<tr>";
                                    echo "<td style='width: 5px; padding:0;'>";
                                ?>
                                    <input type="checkbox" name="reg_cnl[]" value="<?php echo $isbn; ?>" style="width: 50px; height: 20px;">
                            <?php
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<div class='td_info'>ISBN: ";
                                    echo $isbn;
                                    echo "</div>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $name;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>STATUS: ";
                                    echo $approve;
                                    echo "</div>";
                                    echo "<div class='td_info'>ISSUE DATE: ";
                                    echo $issue;
                                    echo "</div>";
                                    echo "<div class='td_info'>DUE DATE: ";
                                    echo $due;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    // Button to view the book where 'isbn' is passed as a parameter
                                    echo "<div><a href='read.php?isbn=$isbn' class='a-exempt tb_btn' style='background-color: rgb(6, 4, 129); padding: 5px; border-radius: 5px; color: white'>OPEN</a></div>";
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
                                alert("An error has occured. Please try again."); // Prints the error
                            </script>
                        <?php
                        }
                        ?>
                </div>
            </div>

        <?php
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

    </div>
</body>

</html>