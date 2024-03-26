<?php
include "connection.php";
include "index_sub.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="stylepref.css">

    <title>LOG-IN</title>
</head>

<style>
    body {
        margin-top: 0;
    }

    .a-exempt {
        border-color: inherit;
        box-shadow: none;
    }

    input[type="submit"] {
        background-color: rgb(2, 24, 153);
        border: none;
        border-color: #333;
        box-shadow: 0 0 5px #333;
    }

    .exempt-hover a:hover {
        background-color: inherit;
        padding: 0px;
        font-weight: bold;
    }

    .login_box {
        height: 250px;
        width: 300px;
    }

    .login_box h1 {
        margin-top: -170px;
    }

    .login_box p {
        margin-bottom: -180px;
        font-size: 10px;
    }
</style>

<body style="font-family: Arial, sans-serif;">

    <section>
        <div class="box_flex">
            <div class="left-box">
                <div class="topnav_sec">
                    <!-- Navigation Bar -->
                    <div class="topnav">
                        <a class="active" href="">LOG IN</a>
                        <a href="reg.php">REGISTER</a>
                        <a href="reportlogin.php">REPORT</a>
                    </div>
                </div>

                <div class="logbox_sec">
                    <div class="login_box">
                        <!-- Login Form -->
                        <h1 name="frname">LOG IN</h1>
                        <form action="index_sub.php" method="POST" style="margin-top: 20px;">
                            <input type="email" name="email" placeholder="Email" required> <br> <br>
                            <input type="password" name="password" placeholder="Password" required> <br> <br>
                            <input class="button" type="submit" name="submit" value="LOG IN">
                        </form> <br>
                        <!-- Redirects to change password page -->
                        <p class="exempt-hover"><a href="frpass.php" class="a-exempt" style="align-items: flex-end; color: white;">FORGET PASSWORD</a></p>
                    </div>
                </div>
            </div> 

            <div class="right-box">
                <img src="img//LOGO.png">
                <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
            </div>
        </div>
    </section>

    </div>

</body>

</html>