<?php
include "../connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="stylead.css">
    <script src="navbar.js"></script>
</head>


<body style="font-family: Arial, Helvetica, sans-serif;">

    <header style="height: 60px">
        <div class="dividing">

            <?php
            $ses_email = htmlspecialchars($_SESSION['email2']);

            // Checks if the user is logged in
            if (isset($ses_email)) {
            ?>

                <div class="row1">
                    <!-- Side Navigation -->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn a-exempt" onclick="closeNav()">&times;</a>
                        <a href="home.php" class="a-exempt">HOME</a> <br id="hidebr">
                        <a href="profile.php" class="a-exempt">PROFILE</a> <br id="hidebr">
                        <a href="student.php" class="a-exempt">STUDENT LIST</a> <br id="hidebr">
                        <a href="lib.php" class="a-exempt">LIBRARIAN LIST</a> <br id="hidebr">
                        <a href="studver.php" class="a-exempt">STUDENT VERIFICATION</a> <br id="hidebr">
                        <a href="libver.php" class="a-exempt">LIBRARIAN VERIFICATION</a> <br id="hidebr">
                        <a href="hreq.php" class="a-exempt">REQUEST HISTORY</a> <br id="hidebr">
                        <a href="log.php" class="a-exempt">LOG HISTORY</a> <br id="hidebr">
                        <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=library1" target="_blank" class="a-exempt">DATABASE</a> <br id="hidebr">
                        <a href="logout.php" class="a-exempt">LOG-OUT</a> <br>
                    </div>

                    <span class="sidenav_icon" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>

                <div class="row2">
                    <div id="sysn" class="logo exempt-hover"><a href="home.php" class="a-exempt" style="color: white">ONLINE LIBRARY MANAGEMENT SYSTEM</a></div> <br>
                </div>

                <div class="row3">
                    <ul>
                        <div class="exempt-hover" id="log_box">
                            <li style="display: inline; word-spacing: 1px;">
                                <a href="profile.php" style="padding: 8px; color: white; display: flex; text-align: center; align-items: center">
                                    <img src="../img/online.png" alt="online" style="height: 10px; margin-right: 5px"> 

                                    <?php
                                    // Admin Query
                                    $q = mysqli_query($db, "SELECT * FROM `admin` where email = '$ses_email'; ");
                                    $row = mysqli_fetch_assoc($q);

                                    $fname = htmlspecialchars($row['fname']);
                                    $lname = htmlspecialchars($row['lname']);

                                    // If the query is successful
                                    if ($q) {
                                        echo "Logged in as: " . $fname . ' ' . $lname;
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
                                </a>
                            </li>
                        </div>
                    </ul>
                </div>


        </div>
    <?php
                // If the user is not logged in
            } else {
    ?>
        <div style="color: red; word-spacing: 1px;">
            <?php
                echo "!PLEASE LOG-IN!";
            ?>
        </div>
    <?php
            }
    ?>
    </header>

</body>

</html>