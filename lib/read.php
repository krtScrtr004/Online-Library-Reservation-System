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

    <style>
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .pdf-container {
            max-width: 100%;
            overflow-x: scroll;
        }
    </style>
</head>

<body>
    <?php
    $ses_email = htmlspecialchars($_SESSION['email1']);

    // Checks if the user is loged in
    if (isset($ses_email)) {
        // Retrieves the isbnfrom the URL that was passed as a parameter from 'book.php' 
        $isbn= htmlspecialchars($_GET['isbn']);

        // BookQuery
        $select = "SELECT * FROM `book` WHERE isbn= '$isbn'";
        $res = mysqli_query($db, $select);

        // If the query is successful
        if ($res) {
            // Retrieves PDF file in the db
            $row = mysqli_fetch_assoc($res);
            $pdf = $row['pdf'];
            
            header("location: $pdf");

            // If the query is unssucessful
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