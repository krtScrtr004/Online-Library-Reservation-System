<?php
include "connection.php";
include "reg_sub.php";
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
    <script src="reg.js"></script>
    <title>REGISTRATION</title>
</head>

<style>
    body {
        margin-top: 0;
    }

    .wrapper1 {
        margin-top: 0;
    }

    .popupWin {
        height: 200px;
    }

    form input[type="email"] {
        width: inherit;
        padding-top: 12px;
        padding-bottom: 12px;
        ;
    }

    .material-icons {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }

    @media screen and (max-width: 600px) {
        .popupWin {
            height: 200px;
        }
    }

    @media screen and (max-width: 600px) {
        .popup .popuptext {
            visibility: hidden;
            width: 160px;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            top: -130%;
            left: 50%;
            margin-left: -80px;
        }

        /* Popup arrow */
        .popup .popuptext::after {
            top: 100%;
            left: 50%;
            z-index: 2;
        }
    }
</style>

<body style="font-family: Arial, sans-serif;">
    <div class="box_flex">
        <div class="left-box">
            <div class="topnav_sec">
                <!-- Navigation Bar -->
                <div class="topnav">
                    <a href="index.php">LOG IN</a>
                    <a class="active" href="">REGISTER</a>
                    <a href="reportlogin.php">REPORT</a>
                    <p></p>
                </div>
            </div>

            <div class="logbox_sec">
                <div class="login_box">
                    <h1 style="margin-top: 20px;">REGISTER</h1>
                    <br>
                    <!-- Registration Form -->
                    <form action="reg_sub.php" method="POST">
                        <p style="margin-left: 25px;">PERSONAL INFORMATION: </p>
                        <br>
                        <input type="text" name="fname" placeholder="First Name" required> <br><br>
                        <input type="text" name="lname" placeholder="Last Name" required> <br><br>
                        <input type="number" name="contact" placeholder="Contact Number" required> <br><br>
                        <p style="margin-left: 25px;">ACCOUNT INFORMATION: </p>
                        <br>
                        <div class="popup"> <!-- Popup hover -->
                            <input type="number" name="id" placeholder="Student No. / Librarian ID." required> <br><br>
                            <span class="popuptext" id="myPopup">Use LRN for student or Teacher ID for librarian.</span> <!-- Popup content -->
                        </div>
                        <input type="text" name="email" placeholder="E-mail" required> <br><br>
                        <input type="password" name="password" placeholder="Password" required> <br><br>
                        <select name="regtype" id="regtype">
                            <option value="" selected>Select account type</option>
                            <option value="student">STUDENT</option>
                            <option value="lib">LIBRARIAN</option>
                        </select> <br><br>
                        <input class="button" type="submit" name="submit" value="REGISTER" style="height: 40px; text-align: center;">
                    </form>
                </div>
            </div>
        </div>

        <!-- Icon for entering a code -->
        <i class="material-icons" onclick="openPopup()">computer</i> <!-- When pressed, openPopup function runs -->
        <div class="right-box">
            <img src="img//LOGO.png">
            <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
        </div>
    </div>
    </div>

    <!-- Popup window form where code is entered -->
    <div class="popupWin" id="popup">
        <div class="blue_header">
            <h3>Register</h3>
            <div class="cursor-x" style="float: right; margin-right: 15px; color: white;" onclick="closePopup()">&times;</div>
        </div> <br><br>
        <form id="popup-form" action="codech.php" method="POST"> <!-- When form is submitted, input data are passed to codech.php -->
            <label for="code">Enter Code:</label>
            <input type="text" name="code" id="code" required> <br><br><br>
            <button class="button exempt-hover" type="submit" onclick="closePopup()">ENTER</button> <!-- When pressed, closePopup function runs -->
        </form>
    </div>

</body>

</html>