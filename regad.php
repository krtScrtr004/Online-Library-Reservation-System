<?php
include "connection.php";
include "regad_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="stylepref.css">
    <link rel="stylesheet" type="text/css" href="stylepopup.css">
    <link rel="stylesheet" type="text/css" href="stylepopW.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>REGISTRATION</title>
</head>

<style>
    body {
        margin-top: 0;
    }

    .material-icons {
        position: fixed;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }
</style>

<body style="font-family: Arial, sans-serif;">
    <div class="box_flex">
        <div class="left-box">
            <!-- Navigation Bar -->
            <div class="topnav_sec">
                <div class="topnav">
                    <a href="index.php">LOG IN</a>
                    <a class="active" href="">REGISTER</a>
                    <a href="reportlogin.php">REPORT</a>
                    <p></p>
                </div>
            </div>

            <div class="logbox_sec">
                <div class="login_box">
                    <!-- Registration Form -->
                    <h1 style="margin-top: 20px;">REGISTER</h1>
                    <br>
                    <form action="regad_sub.php" method="POST">
                        <p style="margin-left: 25px;">PERSONAL INFORMATION: </p>
                        <br>
                        <input type="text" name="fname" placeholder="First Name" style="display: inline-block;"> <br><br>
                        <input type="text" name="lname" placeholder="Last Name" style="display: inline-block;"> <br><br>
                        <input type="number" name="contact" placeholder="Contact No." style="display: inline-block;"> <br><br>
                        <p style="margin-left: 25px;">ACCOUNT INFORMATION: </p>
                        <br>
                        <input type="number" name="did" placeholder="Admin ID" required style="display: inline-block;"> <br><br>
                        <input type="text" name="email" placeholder="Email" required style="display: inline-block;"> <br><br>
                        <input type="password" name="password" placeholder="Password" required style="display: inline-block;"> <br><br><br>
                        <input class="button" type="submit" name="submit" value="REGISTER" style="height: 40px; text-align: center;">
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

</body>

</html>