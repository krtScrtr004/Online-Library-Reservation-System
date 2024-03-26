` <?php
    include "connection.php";
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="stylerprt.css">
    <title>REPORT</title>

</head>

<style>
    #sysn {
        font-size: 20px;
    }

    #log_box {
        font-size: 100%;
    }

    @media screen and (max-height: 820px) {
        #sysn {
            font-size: 100%;
        }
    }

    @media screen and (max-width: 760px) {
        #sysn {
            display: none;
        }
    }

    a {
        box-shadow: 0 0 5px #333;
    }

    @media screen and (max-width: 750px) {
        li {
            margin-right: 0px;
        }
    }
</style>


<body style="font-family: Arial, sans-serif;">

    <!-- Header -->
    <header style="height: 60px;">
        <nav style="padding: 20px; float: right; word-spacing: 20px;">
            <ul>
                <div class="exempt-hover" style="margin-top: -18px;" id="log_box">
                    <li id="li1" style="display: inline; margin-right: 25px; word-spacing: 1px; line-height: 55px;"><a href="index.php" style="color: white; padding: 8px;">LOG IN</a></li>
                    <li id="l2" style="display: inline; margin-right: 25px; word-spacing: 1px; line-height: 55px;"><a href="reg.php" style="color: white; padding: 8px;">REGISTER</a></li>
                </div>
            </ul>
        </nav>

        <div style="margin-top: 19px; padding-left: 80px;">
            <div id="sysn" style="color: white; font-weight: bold;">ONLINE LIBRARY MANAGEMENT SYSTEM</div> <br>
        </div>
    </header>

    <br> <br> <br>
    <div class="container">
        <div class="in_con">
            <div class="box">
                <div class="box_in">
                    <div class="text">
                        <h1>SEND US SOME FEEDBACK!</h1> <br><br>
                        <p>We welcome any feedback you may have and would be grateful if you could share your report or comments with us.</p>
                    </div>
                    <div class="icon">&#x2709;</div>
                </div>
            </div>
            <div class="box2">
                <!-- Report Textarea -->
                <form method="POST">
                    <textarea name="report" cols="50" rows="15" placeholder="Type Here..." required></textarea> <br> <br>
                    <input type="submit" name="submit" value="SUBMIT">
                </form>
            </div>
        </div>
    </div>

    <?php
    // Checks if the user pressed the report button named 'submit'
    if (isset($_POST['submit'])) {
        // Retrieves the data from report textarea
        $report = $_POST['report'];
        $null = "Anonymous"; // Sets the name of the commentator to 'Anonymous'

        // Inserts data to the report table in the db
        $sql = "INSERT INTO `report` (`email`, `comment`) VALUES('$null', '$report');";
        // Report Query
        $res = mysqli_query($db, $sql);

        // If the query is successful
        if ($res) {
    ?>
            <script>
                alert("Thank You, We Will Evaluate Your Report/Feedback.");
            </script>
        <?php
            // If the query is unsuccessful
        } else {
        ?>
            <script type="text/javascript">
                alert("An error occured. Please try again."); // Prints the error
                window.location = "index.php";
            </script>
    <?php
            exit();
        }
    }
    ?>

</body>

</html>