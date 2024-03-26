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
    <link rel="stylesheet" type="text/css" href="../stylepopup.css">
    <link rel="stylesheet" type="text/css" href="description.css">
    <link rel="stylesheet" type="text/css" href="custom_popup.css">
    <title>DESCRIPTION</title>
</head>

<style>
    @media screen and (min-width: 1151px) {
        .popup .popuptext {
            top: -5%;
            left: 95%;
        }
    }

    @media screen and (min-width: 926px) and (max-width: 1150px) {
        .popup .popuptext {
            top: -80%;
            left: 10%;
        }
    }

    @media screen and (min-width: 900px) and (max-width: 925px) {
        .popup .popuptext {
            top: -80%;
            left: 9%;
        }
    }

    @media screen and (min-width: 781px) and (max-width: 900px) {
        .popup .popuptext {
            top: -80%;
            left: 50%;
        }
    }

    @media screen and (max-width: 1150px) {
        .popup .popuptext::after {
            display: none;
        }
    }
</style>

<body>
    <div class="wrapper">
        <?php
        $ses_email = htmlspecialchars($_SESSION['email']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
            $isbn = htmlspecialchars($_GET['isbn']);

            $q = mysqli_query($db, "SELECT * FROM book WHERE isbn= '$isbn'; ");

            // If the query is successful
            if ($q) {
                $row = mysqli_fetch_assoc($q);

                $bpic = htmlspecialchars($row['bpic']);
                $isbn = htmlspecialchars($row['isbn']);
                $name = htmlspecialchars($row['name']);
                $authors = htmlspecialchars($row['authors']);
                $edition = htmlspecialchars($row['edition']);
                $desc = htmlspecialchars($row['description']);
                $status = htmlspecialchars($row['status']);
                $limit = htmlspecialchars($row['limit']);
                $department = htmlspecialchars($row['department']);
                $upl = htmlspecialchars($row['uploader']);

        ?>

                <div class="box">
                    <h2>BOOK DESCRIPTION</h2> <br>

                    <div class="low_container">
                        <div class="parent1">
                            <div class="child1">
                                <div class="cover">
                                    <div class="img_cntr"><img src="../lib/bpic/<?php echo $bpic; ?>" alt="Book cover image"></div>
                                </div>
                                <br>
                                <div class="info">
                                    NAME: <?php echo $name; ?> <br><br>
                                    ISBN: <?php echo $isbn; ?> <br><br>
                                    AUTHOR: <?php echo $authors; ?> <br><br>
                                    EDITION: <?php echo $edition; ?> <br><br>
                                    STATUS: <?php echo $status; ?> <br><br>
                                    LIMIT: <?php echo $limit; ?> <br><br>
                                    DEPARTMENT: <?php echo $department; ?> <br><br>
                                    UPLOADER: <?php echo $upl; ?> <br><br>
                                </div>
                            </div>
                            <div class="child2">
                                <?php
                                echo $desc;
                                ?>
                            </div>
                        </div>
                        <div class="parent-line">
                            <div class="vertical-line"></div>
                        </div>
                        <div class="parent2">
                            <h2>REQUEST FOR BOOK</h2> <br>
                            <form id="popup-form" action="request.php?" method="POST">
                                <input type="hidden" name="isbn" value="<?php echo $isbn ?>">
                                <input type="hidden" name="limit" value="<?php echo $limit ?>">
                                <input type="hidden" name="status" value="<?php echo $status ?>">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" value="<?php echo $ses_email ?>" readonly> <br><br>
                                <div class="popup"> <!-- Popup hover -->
                                    <label for="due">Due Date:</label>
                                    <input type="text" name="due" id="due" placeholder="(yyyy-mm-dd)"> <br><br><br>
                                    <span class="popuptext" name="due" id="myPopup">Adds 7-day interval to issue date when left blank.</span> <!-- Popup content -->
                                </div>
                                <button class="button exempt-hover" type="submit" onclick="closePopup()">REQUEST</button> <br><br>
                            </form>
                        </div>
                    </div>
                </div>
    </div>

<?php
                // If the query is unsuccessful
            } else {
?>
    <script type="text/javascript">
        alert("An error has occured. Please try again."); // Prints the error
    </script>
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
</body>

</html>