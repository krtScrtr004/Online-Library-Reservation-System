<?php
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS UPLOAD</title>
</head>

<body>
    <div class="wrapper1">

        <?php
        $ses_email = htmlspecialchars($_SESSION['email1']);

        // Checks if the user is logged in
        if (isset($ses_email)) {
        ?>
            <div class="table_cont">
                <!-- Refreshes the page when clicked -->
                <div class="divider">
                    <h2 id="hname" class="exempt-hover"><a href="uploader.php" class="a-exempt" style="color: black">BOOK UPLOADS</a></h2>
                    <!-- Search Bar -->
                    <div class="srch">
                        <form method="post">
                            <input type="text" name="search" placeholder="Search..." required>
                            <button type="submit" name="submit"> S
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Table Area -->
                <div class="scroll">
                    <?php
                    // Checks if the user pressed the search button named 'submit'
                    if (isset($_POST['submit'])) {
                        // Retreives the search term from the search bar
                        // Search query
                        $search_term = "%" . $_POST["search"] . "%";
                        $q = mysqli_query($db, "SELECT * FROM `book` WHERE isbn= '$search_term' OR name = '$search_term' OR authors = '$search_term' OR edition = '$search_term' OR department = '$search_term' ");
                        // If the query is successful
                        if ($q) {
                            // If the search term does not match to any data
                            if (mysqli_num_rows($q) == 0) {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> No book matched. </div>";
                                // If the search term matched to data
                            } else {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>";
                                echo "COVER";
                                echo "</th>";
                                echo "<th>";
                                echo "ISBN";
                                echo "</th>";
                                echo "<th>";
                                echo "NAME";
                                echo "</th>";
                                echo "<th>";
                                echo "AUTHOR NAME";
                                echo "</th>";
                                echo "<th>";
                                echo "EDITION";
                                echo "</th>";
                                echo "<th>";
                                echo "STATUS";
                                echo "</th>";
                                echo "<th>";
                                echo "LIMIT";
                                echo "</th>";
                                echo "<th>";
                                echo "DEPARTMENT";
                                echo "</th>";
                                echo "<th>";
                                echo "</th>";
                                echo "</tr>";
                                // Iterates db to output all data
                                while ($row = mysqli_fetch_assoc($q)) {
                                    $isbn= htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $status = htmlspecialchars($row['status']);
                                    $limit = htmlspecialchars($row['limit']);
                                    $department = htmlspecialchars($row['department']);

                                    echo "<tr>";
                                    echo "<td>" . $isbn. "</td>";
                                    echo "<td>" . $name . "</td>";
                                    echo "<td>" . $authors . "</td>";
                                    echo "<td>" . $edition . "</td>";
                                    echo "<td>" . $status . "</td>";
                                    echo "<td>" . $limit . "</td>";
                                    echo "<td>" . $department . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            // If the query is unsuccessful
                        } else {
                    ?>
                            <script type="text/javascript">
                                alert("An error has occured. Please try again."); // Prints the error
                                history.back();
                            </script>
                            <?php
                        }
                    } else {
                        // Book Query
                        $sql = mysqli_query($db, "SELECT * FROM `book` where uploader = '$ses_email';");
                        // If the query is successful
                        if ($sql) {
                            // If there is a book uploaded
                            if (mysqli_num_rows($sql) > 0) {
                                echo "<table>";
                                echo "<th>";
                                echo "ISBN";
                                echo "</th>";
                                echo "<th>";
                                echo "NAME";
                                echo "</th>";
                                echo "<th>";
                                echo "AUTHOR";
                                echo "</th>";
                                echo "<th>";
                                echo "EDITION";
                                echo "</th>";
                                echo "<th>";
                                echo "STATUS";
                                echo "</th>";
                                echo "<th>";
                                echo "LIMIT";
                                echo "</th>";
                                echo "<th>";
                                echo "DEPARTMENT";
                                echo "</th>";
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $isbn= htmlspecialchars($row['isbn']);
                                    $name = htmlspecialchars($row['name']);
                                    $authors = htmlspecialchars($row['authors']);
                                    $edition = htmlspecialchars($row['edition']);
                                    $status = htmlspecialchars($row['status']);
                                    $limit = htmlspecialchars($row['limit']);
                                    $department = htmlspecialchars($row['department']);

                                    echo "<tr>";
                                    echo "<td>" . $isbn. "</td>";
                                    echo "<td>" . $name . "</td>";
                                    echo "<td>" . $authors . "</td>";
                                    echo "<td>" . $edition . "</td>";
                                    echo "<td>" . $status . "</td>";
                                    echo "<td>" . $limit . "</td>";
                                    echo "<td>" . $department . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            ?>
                </div>
            </div>
            }
        <?php
                                // If there is no uploaded book
                            } else {
                                echo "<br>";
                                echo "<br>";
                                echo "<div style='margin-left:20px;'> Librarian has not uploaded yet. </div>";
                            }
                            // If the query is unsuccessful
                        } else {
        ?>
        <script type="text/javascript">
            alert("An error has occured. Please try again."); // Prints the error
        </script>
<?php
                        }
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

    </div>
</body>

</html>