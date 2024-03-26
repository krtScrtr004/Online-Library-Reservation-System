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
    <title>DESCRIPTION</title>
</head>

<style>
    .box {
        height: fit-content;
        width: 60vw;
    }

    .low_container {
        height: 100%;
        width: 100%;
        display: flex;
        padding: 0;
    }

    .child1 {
        flex: 1;
        display: flex;
        flex-direction: row;
        padding: 10px;
    }

    .cover {
        flex: 1;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    img {
        height: 450px;
    }

    .child2 {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 10px;
        overflow-y: auto;
        color: black;
    }

    .info {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: left;
        color: black;
    }

    .desc {
        flex: 1;
        height: 90%;
        width: 100%;
        overflow: scroll;
        text-align: justify;
    }

    @media screen and (min-width: 701px) and (max-width: 1200px) {
        body {
            height: 100%;
        }

        .box {
            overflow-y: auto;
            width: 90vw;
        }
    }


    @media screen and (max-width: 700px) {
        body {
            height: fit-content;
        }

        .box {
            width: 90vw;
        }

        .low_container {
            flex-direction: column;
        }

        .child1 {
            flex: 0.5;
        }

        img {
            height: 150px;
        }

        .child2 {
            flex: 1.5;
            padding: 10px;
            overflow-y: auto;
        }
    }

    @media screen and (max-height: 700px) and (max-height: 700px) {
        .wrapper {
            display: block;
            height: 100%;
            margin-top: 70px;
            padding-bottom: 10px;
        }
    }
</style>

<body>
    <div class="wrapper">
        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

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
                        <div class="child1">
                            <div class="cover">
                                <div class="img_cntr"><img src="../lib/bpic/<?php echo $bpic; ?>" alt="Book cover image"></div>
                            </div>
                            <br>
                        </div>
                        <div class="child2">
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
                            <div class="desc">
                                <?php
                                echo $desc;
                                ?>
                            </div>
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