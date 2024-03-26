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
        // Checks if the user is logged in
        if (isset($_SESSION['email1'])) {
        ?>

            <div class="table_cont">
                <div class="divider">
                    <!-- Refreshes the page when clicked -->
                    <h2 id="hname" class="exempt-hover"><a href="issue_info.php" class="a-exempt" style="color: black">ISSUED BOOKS INFORMATION</a></h2>
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
                        $q = mysqli_query($db, "SELECT `student`.fname, `student`.lname, `student`.contact, `student`.sid, `student`.email, `book`.isbn, `book`.name, `book`.authors, `book`.edition, `issue_book`.approve, `issue_book`.issue, `issue_book`.due FROM `student` INNER JOIN `issue_book` ON `student`.email = `issue_book`.username INNER JOIN `book` ON `issue_book`.isbn = `book`.isbn WHERE `issue_book`.approve = 'APPROVED' AND (`student`.fname LIKE '$search_term' OR `student`.lname LIKE '$search_term' OR `student`.sid LIKE '$search_term' OR `student`.email LIKE '$search_term' OR `book`.name LIKE '$search_term' OR `book`.authors LIKE '$search_term' OR `book`.isbn LIKE '$search_term') ORDER BY `issue_book`.due ASC;");                        // If the query is successful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No record matched. </div>";
                                // If the search term matched to data
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "BORROWER INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "ISSUE INFO";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $d = date("Y-m-d"); // Retrieves current date
                                    $c = 1; // Counter
                                    $due = htmlspecialchars($row['due']);
                                    $fname = htmlspecialchars($row['fname']);
                                    $lname = htmlspecialchars($row['lname']);
                                    $sid = htmlspecialchars($row['sid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);
                                    $name = htmlspecialchars($row['name']);
                                    $isbn= htmlspecialchars($row['isbn']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $approve = htmlspecialchars($row['approve']);
                                    $issue = htmlspecialchars($row['issue']);

                                    // Checks if a borrowed book's due date is overdue
                                    if ($d > $due) {
                                        // Retrievves  data from the db
                                        $email = htmlspecialchars($row['email']);
                                        $isbn= htmlspecialchars($row['isbn']);
                                        $c = $c + 1; // Counter increment
                                        $var = 'EXPIRED';

                                        // Updates the status to 'EXPIRED', limited by the number of overdue books 
                                        $return1 = mysqli_query($db, "UPDATE `issue_book` SET approve = '$var' WHERE due = '$due' AND approve = 'APPROVED' LIMIT $c;");

                                        // Incremments the limit of the returned book
                                        $return2 = mysqli_query($db, "UPDATE `book` SET `limit` = `limit` + 1 WHERE isbn= '$isbn';");

                                        // Issue_book Query
                                        $result = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username = '$email' AND isbn= '$isbn'");
                                        $row = mysqli_fetch_assoc($result);
                                        // Retrieves the data from the db
                                        $approve = htmlspecialchars($row['approve']);

                                        // If the query is successful
                                        if ($return1 && $return2 && $result) {
                                            // Deletes the overdued data
                                            if ($approve == $var) {
                                                $del = mysqli_query($db, "DELETE FROM `issue_book` WHERE username = '$email' AND isbn= '$isbn'");

                                                // If the data is deleted
                                                if ($del) {
                    ?>
                                                    <script>
                                                        window.location = "issue_info.php";
                                                    </script>
                                                <?php
                                                    // If the data has not deleted
                                                } else {
                                                ?>
                                                    <script type="text/javascript">
                                                        alert("An error occured. Please try again."); // Prints the error
                                                    </script>
                                            <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <script type="text/javascript">
                                                alert("An error occured. Please try again."); // Prints the error
                                            </script>
                            <?php
                                            exit();
                                        }
                                    }
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $lname . ', ' . $fname;
                                    echo "</div>";
                                    echo "<div class='td_info'>ID: ";
                                    echo $sid;
                                    echo "</div>";
                                    echo "<div class='td_info'>EMAIL: ";
                                    echo $email;
                                    echo "</div>";
                                    echo "<div class='td_info'>CONTACT: ";
                                    echo $contact;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $name;
                                    echo "</div>";
                                    echo "<div class='td_info'>ISBN: ";
                                    echo $isbn;
                                    echo "</div>";
                                    echo "<div class='td_info'>AUTHORS: ";
                                    echo $authors;
                                    echo "</div>";
                                    echo "<div class='td_info'>EDITION:";
                                    echo $edition;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>APPROVAL STATUS: ";
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
                                    // Button to redirect to edit approval info, where isbnand email are passed as a parameter
                                    echo "<div class='exempt-hover'><button class='button a-exempt' style='padding:0'><a href='edit_borrow.php?isbn=$isbn&email=$email' style='padding:5px;color:white'>EDIT</a></button><div>";
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
                    } else {
                        // Joined
                        $sql = "SELECT `student` . fname, lname, contact, sid, email, `book` . isbn, name, authors, edition, approve, issue, due FROM `student` INNER JOIN `issue_book` on `student` . email = `issue_book` . username INNER JOIN `book` ON `issue_book` . isbn= `book` . isbn WHERE `issue_book` . approve = 'APPROVED' ORDER BY `issue_book`.`due` ASC";
                        $res = mysqli_query($db, $sql);
                        // If there is no request
                        // If the query is successful
                        if ($res) {
                            if (mysqli_num_rows($res) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No pending request. </div>";
                                // If there is request
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "BORROWER INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "ISSUE INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $d = date("Y-m-d"); // Retrieves current date
                                    $c = 1; // Counter
                                    $due = htmlspecialchars($row['due']);
                                    $fname = htmlspecialchars($row['fname']);
                                    $lname = htmlspecialchars($row['lname']);
                                    $sid = htmlspecialchars($row['sid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);
                                    $name = htmlspecialchars($row['name']);
                                    $isbn= htmlspecialchars($row['isbn']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $approve = htmlspecialchars($row['approve']);
                                    $issue = htmlspecialchars($row['issue']);

                                    // Checks if a borrowed book's due date is overdue
                                    if ($d > $due) {
                                        // Retrievves  data from the db
                                        $email = htmlspecialchars($row['email']);
                                        $isbn= htmlspecialchars($row['isbn']);
                                        $c = $c + 1; // Counter increment
                                        $var = 'EXPIRED';

                                        // Updates the status to 'EXPIRED', limited by the number of overdue books 
                                        $return1 = mysqli_query($db, "UPDATE `issue_book` SET approve = '$var' WHERE due = '$due' AND approve = 'APPROVED' LIMIT $c;");

                                        // Incremments the limit of the returned book
                                        $return2 = mysqli_query($db, "UPDATE `book` SET `limit` = `limit` + 1 WHERE isbn= '$isbn';");

                                        // Issue_book Query
                                        $result = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username = '$email' AND isbn= '$isbn'");
                                        $row = mysqli_fetch_assoc($result);
                                        // Retrieves the data from the db
                                        $approve = htmlspecialchars($row['approve']);

                                        // If the query is successful
                                        if ($return1 && $return2 && $result) {
                                            // Deletes the overdued data
                                            if ($approve == $var) {
                                                $del = mysqli_query($db, "DELETE FROM `issue_book` WHERE username = '$email' AND isbn= '$isbn'");

                                                // If the data is deleted
                                                if ($del) {
                            ?>
                                                    <script>
                                                        window.location = "issue_info.php";
                                                    </script>
                                                <?php
                                                    // If the data has not deleted
                                                } else {
                                                ?>
                                                    <script type="text/javascript">
                                                        alert("An error occured. Please try again."); // Prints the error
                                                    </script>
                                            <?php
                                                }
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
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $lname . ', ' . $fname;
                                    echo "</div>";
                                    echo "<div class='td_info'>ID: ";
                                    echo $sid;
                                    echo "</div>";
                                    echo "<div class='td_info'>EMAIL: ";
                                    echo $email;
                                    echo "</div>";
                                    echo "<div class='td_info'>CONTACT: ";
                                    echo $contact;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>NAME: ";
                                    echo $name;
                                    echo "</div>";
                                    echo "<div class='td_info'>ISBN: ";
                                    echo $isbn;
                                    echo "</div>";
                                    echo "<div class='td_info'>AUTHORS: ";
                                    echo $authors;
                                    echo "</div>";
                                    echo "<div class='td_info'>EDITION:";
                                    echo $edition;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    echo "<div class='td_info'>APPROVAL STATUS: ";
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
                                    // Button to redirect to edit borrow info, where isbnand email are passed as a parameter
                                    echo "<div class='exempt-hover'><button class='button a-exempt' style='padding:0'><a href='edit_borrow.php?isbn=$isbn&email=$email' style='padding:5px;color:white'>EDIT</a></button><div>";
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
</body>

</html>