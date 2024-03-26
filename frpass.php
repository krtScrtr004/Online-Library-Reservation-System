<?php
include "connection.php";
include "frpass_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="stylepref.css">
    <title>FORGET PASSWORD || STUDENT</title>
</head>

<style>
    body {
        margin-top: 0;
    }

    .login_box {
        height: 280px;
        width: 300px;
        margin-top: 35px;
    }

    .login_box h1 {
        margin-top: 10px;
        font-size: 25px;
        text-align: left;
    }

    .login_box form {
        margin-top: 10px;
    }
</style>

<body style="font-family: Arial, sans-serif;">

    <section>
        <div class="box_flex">
            <div class="left-box">
                <!-- Navigation Bar -->
                <div class="topnav_sec">
                    <div class="topnav">
                        <a href="index.php">LOG IN</a>
                        <a href="reg.php">REGISTER</a>
                        <a href="reportlogin.php">REPORT</a>
                    </div>
                </div>

                <div class="logbox_sec">
                    <div class="login_box">
                        <!-- Change Pass Form -->
                        <h1 id="chp">CHANGE <br> PASSWORD</h1>
                        <form action="frpass_sub.php" method="POST">
                            <input type="email" name="email" placeholder="Email" required> <br> <br>
                            <input type="text" name="id" placeholder="Student Number / Librarian ID" required> <br> <br>
                            <input type="password" name="npassword" placeholder="New Password" required> <br> <br>
                            <input class="button" type="submit" name="submit" value="UPDATE" style="height: 40px; text-align: center;">
                        </form>
                    </div>
                </div>
            </div>

            <div class="right-box">
                <img src="img//LOGO.png">
                <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
        </div>
        </div>

    </section>

</body>

</html>