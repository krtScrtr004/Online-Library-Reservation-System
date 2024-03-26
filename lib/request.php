<?php
include "../connection.php";
include "navbar.php";
include "request_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../stylepopW.css">
    <title>REQUEST INFORMATION</title>
</head>

<style>
    .img_cntr {
        text-align: center;
    }
</style>

<body>
    <div class="wrapper1">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Check if the user is logged
        if (isset($ses_email)) {
        ?>

            <div class="table_cont">
                <div class="divider">
                    <!-- Refreshes the page when clicked -->
                    <h2 id="hname" class="exempt-hover"><a href="request.php" class="a-exempt" style="color: black">BOOK REQUESTS</a></h2>
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
                        $q = mysqli_query($db, "SELECT student.fname, student.lname, student.contact, student.sid, student.email, book.isbn, book.name, book.authors, book.edition, book.status FROM student INNER JOIN issue_book ON student.email = issue_book.username INNER JOIN book ON issue_book.isbn= book.isbn WHERE issue_book.approve = ' ' AND (student.fname LIKE '$search_term' OR student.lname LIKE '$search_term' OR student.sid LIKE '$search_term' OR student.email LIKE '$search_term' OR book.name LIKE '$search_term' OR book.authors LIKE '$search_term' OR book.isbn LIKE '$search_term')");
                        // If the query is not successful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No data matched. </div>";
                                // If the search term matched to data
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "BOOK COVER";
                                echo "</th>";
                                echo "<th>";
                                echo "BORROWER INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $lname = htmlspecialchars($row['lname']);
                                    $fname = htmlspecialchars($row['fname']);
                                    $sid = htmlspecialchars($row['sid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);
                                    $bpic = htmlspecialchars($row['bpic']);
                                    $isbn = htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $status = htmlspecialchars($row['status']);

                                    echo "<tr>";
                                    echo "<td>";
                    ?>
                                    <div class="img_cntr"><img src="bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
                            <?php
                                    echo "</td>";

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
                                    echo "<div class='td_info'>STATUS:";
                                    echo $status;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    // Button to open a popup window form
                                    // When pressed, openPopup function runs
                                    echo "<button class='button a-exempt' onclick='openPopup()'>APPROVE</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
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
                        // Student, Book, Issue_Book Query
                        $sql = "SELECT `student` . fname, lname, contact, sid, email, `book` . isbn, name, authors, edition, status, bpic FROM `student` INNER JOIN `issue_book` on `student` . email = `issue_book` . username INNER JOIN `book` ON `issue_book` . isbn = `book` . isbn WHERE `issue_book` . approve = ' ';";
                        $res = mysqli_query($db, $sql);
                        // If the query is successful
                        if ($res) {
                            // If there is no book requested
                            if (mysqli_num_rows($res) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No pending request. </div>";
                                // If there is book requested
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "BOOK COVER";
                                echo "</th>";
                                echo "<th>";
                                echo "BORROWER INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "BOOK INFO";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $lname = htmlspecialchars($row['lname']);
                                    $fname = htmlspecialchars($row['fname']);
                                    $sid = htmlspecialchars($row['sid']);
                                    $email = htmlspecialchars($row['email']);
                                    $contact = htmlspecialchars($row['contact']);
                                    $bpic = htmlspecialchars($row['bpic']);
                                    $isbn = htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $status = htmlspecialchars($row['status']);

                                    echo "<tr>";
                                    echo "<td>";
                            ?>
                                    <div class="img_cntr"><img src="bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
                            <?php
                                    echo "</td>";

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
                                    echo "<div class='td_info'>STATUS:";
                                    echo $status;
                                    echo "</div>";
                                    echo "</td>";

                                    echo "<td>";
                                    // Button to open a popup window form
                                    // When pressed, openPopup function runs
                                    echo "<button class='button a-exempt' onclick='openPopup()'>APPROVE</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        } else {
                            ?>
                            <script type="text/javascript">
                                alert("An error has occured. Please try again."); // Prints the error
                                history.back();
                            </script>
                        <?php
                        }
                        ?>
                </div>

                <!-- Functions for opening and closing popup window form -->
                <script>
                    function openPopup() {
                        document.getElementById("popup").style.display = "block"; // Makes the popup form visible
                    }

                    function closePopup() {
                        document.getElementById("popup").style.display = "none"; // Makes the popup window form hidden
                    }
                </script>

                <!-- Popup Window Form -->
                <div class="popupWin" id="popup">
                    <?php
                        // Student, Book, Issue_Book Query
                        $sql = "SELECT `student` . fname, lname, contact, sid, email, `book` . isbn, name, authors, edition, status FROM `student` INNER JOIN `issue_book` on `student` . email = `issue_book` . username INNER JOIN `book` ON `issue_book` . isbn= `book` . isbn WHERE `issue_book` . approve = ' ';";
                        $res = mysqli_query($db, $sql);

                        // If the query is succesful
                        if ($res) {
                            $row = mysqli_fetch_assoc($res);
                            // Retrieves the data from the db
                            $email = htmlspecialchars($row['email']);
                            $isbn = htmlspecialchars($row['isbn']);
                            $fname = htmlspecialchars($row['fname']);
                            $lname = htmlspecialchars($row['lname']);

                            // Issue_Book Query
                            $q1 = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username = '$email' AND approve = ' ' ");

                            // If the query is sucessful
                            if ($q1) {
                                $row1 = mysqli_fetch_assoc($q1);
                                // Retrieves the data from the db
                                $due = htmlspecialchars($row1['due']);
                                $current_date = date("Y-m-d"); // Retrieves current date

                    ?>
                            <div class="blue_header">
                                <h3>APPROVE REQUEST</h3>
                                <div class="cursor-x" style="float: right; margin-right: 15px; color: white;" onclick="closePopup()">&times;</div>
                            </div> <br><br><br>
                            <form id="popup-form" action="request_sub.php" method="POST">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="isbn" value="<?php echo $isbn ?>">
                                <input type="hidden" name="fname" value="<?php echo $fname ?>">
                                <input type="hidden" name="lname" value="<?php echo $lname ?>">
                                <label for="approve">Approve:</label>
                                <input type="text" name="approve" id="approve" value="APPROVED" required> <br><br>
                                <label for="issue">Issue Date:</label>
                                <input type="text" name="issue" id="email" placeholder="(yyyy-mm-dd)" value="<?php echo $current_date ?>" required> <br><br>
                                <label for="due">Due Date:</label>
                                <input type="text" name="due" id="due" placeholder="(yyyy-mm-dd)" value="<?php echo $due; ?>"> <br><br><br>
                                <button class="button exempt-hover" type="submit" name="apr_btn" onclick="closePopup()">APPROVE</button> <br><br>
                            </form>
                        <?php
                                // If the query is unsuccessful
                            } else {
                        ?>
                            <script type="text/javascript">
                                alert("An error has occured. Please try again."); // Prints the error
                                history.back();
                            </script>
                        <?php
                            }
                            // If the query is unsuccessful
                        } else {
                        ?>
                        <script type="text/javascript">
                            alert("An error has occured. Please try again."); // Prints the error
                            history.back();
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
</body>

</html>