<?php
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>

<style>
    table {
        max-height: 65vh;
        background-color: #f2f2f2;
        border: none;
        box-shadow: none;
    }

    td,
    tr {
        border: none;
    }

    tr:hover td {
        background-color: inherit;
        text-shadow: none;
    }

    @media screen and (max-width: 1200px) {
        .scroll {
            max-height: 88%;
        }
    }

    @media screen and (max-width: 620px) {
        .wrapper {
            height: inherit;
            display: flex;
            align-items: start;
        }
    }
</style>

<body>
    <div class="wrapper">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email2']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>

            <div class="grid_section">
                <div id="main_home">
                    <br>
                    <!-- Navigations -->
                    <div class="grid_prnt exempt-hover">
                        <a href="student.php" class="a-exempt"> <!-- Student List Page -->
                            <div class="grid" id="top_cncl">
                                <img src="../img/stud icon.png">
                                <h1 style="float: right">STUDENT <br> LIST</h1>
                            </div>
                        </a>
                        <a href="lib.php" class="a-exempt"> <!-- Librarian List Page -->
                            <div class="grid" id="top_cncl">
                                <img src="../img/admin.png">
                                <h1>LIBRARIAN <br> LIST</h1>
                            </div>
                        </a>
                        <a href="hreq.php" class="a-exempt"> <!-- Request History Page -->
                            <div class="grid" style="margin-right: 0;" id="top_cncl">
                                <img src="../img/history.png">
                                <h1>REQUEST <br> HISTORY</h1>
                            </div>
                        </a>
                    </div>

                    <div class="grid_prnt exempt-hover">
                        <a href="studver.php" class="a-exempt"> <!-- Student Verification Page -->
                            <div class="grid">
                                <img src="../img/approve.png">
                                <h1>STUDENT <br> VERIFICATION</h1>
                            </div>
                        </a>
                        <a href="libver.php" class="a-exempt"> <!-- Librarian Verification Page -->
                            <div class="grid">
                                <img src="../img/approve.png">
                                <h1>LIBRARIAN <br> VERIFICATION</h1>
                            </div>
                        </a>
                        <a href="log.php" class="a-exempt"> <!-- Log History Page -->
                            <div class="grid" style="margin-right: 0;">
                                <img src="../img/log.png">
                                <h1>LOG <br> HISTORY</h1>
                            </div>
                        </a>
                    </div>

                    <?php
                    // Statistics Queries
                    // Student query that counts the number of the verified student accounts
                    $student = mysqli_query($db, "SELECT COUNT(*) as total1 FROM `student` WHERE verify  = 'VERIFIED' ");
                    // Librarian query that counts the number of the verified librarian accounts
                    $lib = mysqli_query($db, "SELECT COUNT(*) as total2 FROM `lib` WHERE verify = 'VERIFIED' ");
                    // Librarian query that counts the number of the unverified librarian accounts
                    $ver1 = mysqli_query($db, "SELECT COUNT(*) as total3 FROM `lib` WHERE verify = ' ' ");
                    // Student query that counts the number of the unverified student accounts
                    $ver2 = mysqli_query($db, "SELECT COUNT(*) as total4 FROM `student` WHERE verify = ' ' ");

                    // Stores the counted numbers to variables
                    $row1 = mysqli_fetch_array($student); // No. of verified student accounts
                    $row2 = mysqli_fetch_array($lib); // No. of verified librarian accounts
                    $row3 = mysqli_fetch_array($ver1); // No. of unverified librarian accounts
                    $row4 = mysqli_fetch_array($ver2); // No. of unverified student accounts

                    // If the query is successful 
                    if ($student && $lib && $ver1 && $ver2) {
                    ?>

                        <!-- Displays the statistics -->
                        <div class="grid_prnt">
                            <div class="grid stats" style="background-color: #f81c10;">
                                <div style="flex: column;">
                                    <p>NO OF STUDENTS</p>
                                    <h1><?php echo htmlspecialchars($row1['total1']); ?></h1>
                                </div>
                            </div>
                            <div class="grid stats" style="background-color: #2716de;">
                                <div style="flex: column;">
                                    <p>NO OF LIBRARIANS</p>
                                    <h1><?php echo htmlspecialchars($row2['total2']); ?></h1>
                                </div>
                            </div>
                            <div class="grid stats" style="background-color: #268c04;">
                                <div style="flex: column;">
                                    <p>PENDING LIBRARIAN <br> VERIFICATION</p>
                                    <h1><?php echo htmlspecialchars($row3['total3']); ?></h1>
                                </div>
                            </div>
                            <div class="grid stats" style="background-color: #ac39ac; margin-right: 0;">
                                <div style="flex: column;">
                                    <p>PENDING STUDENT <br> VERIFICATION</p>
                                    <h1><?php echo htmlspecialchars($row4['total4']); ?></h1>
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
            ?>

            <!-- Feedback Area -->
            <div id="wht_box">
                <div class="white_box">
                    <div class="blue_header">
                        <h3 style="text-align: center; color: white;">REPORTS / FEEDBACKS</h3>
                    </div>

                    <br>

                    <div class="scroll">
                        <?php
                        // Report Query
                        $res = mysqli_query($db, "SELECT * FROM `report` ORDER BY ID DESC");
                        // If the query is successful
                        if ($res) {
                            // If there is no report
                            if (mysqli_num_rows($res) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:10px;'> No available report / feedback. </div>";
                                // If there is a report
                            } else {
                                // Iterates to output all the reports
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $comment = htmlspecialchars($row['comment']);
                                    $email = htmlspecialchars($row['email']);

                                    echo "<table style='background-color: transparent;'>";
                                    echo "<tr>";
                                    echo "<td>";
                                    echo "<div style='margin-left: 20px; text-align: left;'>" . $comment . "</div>";
                                    echo "<br>";
                                    echo "<div style='margin-right: 20px; text-align: right; font-size: 10px;'>" . '-' . $email . "</div>";
                                    echo "</td>";
                                    echo "<hr style='margin: 5px 20px 5px 20px;'>";
                                    echo "</tr>";
                                    echo "</table>";
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
                        ?>
                    </div>

                </div>
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