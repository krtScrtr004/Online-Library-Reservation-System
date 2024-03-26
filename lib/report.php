` <?php
    include "../connection.php";
    include "navbar.php";
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../stylerprt.css">
    <title>REPORT</title>
</head>

<body>

    <?php
    $ses_email = htmlspecialchars($_SESSION['email1']);

    // Checks if the user is logged in
    if (isset($ses_email)) {
    ?>

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
            $report = $_POST['report'];

            // Inserts data to the report table in the db where commentator is set to session email
            $sql = "INSERT INTO `report` (`email`, `comment`) VALUES('$ses_email', '$report');";
            $q = mysqli_query($db, $sql);

            // If the reprort has submitted successfuly
            if ($q) {
        ?>
                <script>
                    alert("Thank you, we will evaluate your report/feedback.")
                </script>
            <?php
                // If the reprort has not submitted successfuly
            } else {
            ?>
                <script type="text/javascript">
                    alert("There was an error submitting your report/feedback. Please try again."); // Prints the error
                    history.back();
                </script>
        <?php
            }
        }
        ?>

    <?php
        // If the user is not logged in
    } else {
    ?>
        <br>
        <h1 style="margin-left: 350px; color: red; font-size: 50px; font-weight: bold;">YOU ARE NOT LOGGED-IN</h1>

        <script>
            window.location = "../index.php";
        </script>
    <?php
    }
    ?>
</body>

</html>