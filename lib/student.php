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
  <title>STUDENT INFO</title>
</head>

<body>
  <div class="wrapper1">

    <?php
    $ses_email = htmlspecialchars($_SESSION['email1']);

    // Checks if the user is logged in
    if (isset($ses_email)) {
    ?>

      <div class="table_cont">
        <div class="divider">
          <!-- Refreshes the page when clicked -->
          <h2 id="hname" class="exempt-hover"><a href="student.php" class="a-exempt" style="color: black">STUDENTS' INFORMATION</a></h2>
          <!-- Search Bar -->
          <div class="srch">
            <form method="post">
              <input type="text" name="search" placeholder="Search..." required>
              <button type="submit" name="submit">S</button>
            </form>
          </div>
        </div>

        <!-- Table Area -->
        <div class="scroll">
          <?php
          // Checks if the user pressed the search button named 'submit'
          if (isset($_POST['submit'])) {
            // Retreives the search term from the search bar
            $search_term = "%" . $_POST["search"] . "%";
            // Search query
            $q = mysqli_query($db, "SELECT fname, lname, contact, sid, email FROM `student` WHERE (fname like '$search_term' OR lname like '$search_term' OR contact like '$search_term' OR sid like '$search_term' OR email like '$search_term') AND verify = 'VERIFIED' ");
            // Iff the query is successful
            if ($q) {
              // If the search term does not match to any data
              if (mysqli_num_rows($q) == 0) {
                echo "<br>";
                echo "<br>";
                echo "<div style='margin-left:20px;'> No student matched. </div>";
                // If the search term matched to data
              } else {
                echo "<table>";
                echo "<tr>";
                echo "<th>";
                echo "NAME";
                echo "</th>";
                echo "<th>";
                echo "INFORMATION";
                echo "</th>";
                echo "<th>";
                echo "</th>";
                echo "</tr>";
                // Iterates db to output all data
                while ($row = mysqli_fetch_assoc($q)) {
                  $lname = htmlspecialchars($row['lname']);
                  $fname = htmlspecialchars($row['fname']);
                  $sid = htmlspecialchars($row['sid']);
                  $email = htmlspecialchars($row['email']);
                  $contact = htmlspecialchars($row['contact']);

                  echo "<tr>";
                  echo "<td>";
                  echo $lname . ', ' . $fname;
                  echo "</td>";
                  echo "<td>";
                  echo "<div class='td_info'>ID: ";
                  echo $sid;
                  echo "</div>";
                  echo "<div class='td_info'>EMAIL: ";
                  echo $email;
                  echo "</div>";
                  echo "<div class='td_info'>CONTACT: ";
                  echo $contact;
                  echo "</div>";
                  echo "</td>";
                  echo "<br>";
                  echo "</tr>";
                }
                echo "</table>";
              }
              // If the query is unsuccessful
            } else {
          ?>
              <script type="text/javascript">
                alert("An error has occured. Please try again."); // Prints the error
              </script>
              <?php
            }
          } else {
            $res = mysqli_query($db, "SELECT * FROM `student` WHERE verify = 'VERIFIED' ORDER BY `fname` ASC;");

            // If the query is successful
            if ($res) {
              if (mysqli_num_rows($res) == 0) {
                echo "<br>";
                echo "<br>";
                echo "<div style='margin-left:20px;'> No librarian listed. </div>";
              } else {
                echo "<table>";
                echo "<tr>";
                echo "<th>";
                echo "NAME";
                echo "</th>";
                echo "<th>";
                echo "INFORMATION";
                echo "</th>";
                echo "</tr>";
                // Iterates db to output all data
                while ($row = mysqli_fetch_assoc($res)) {
                  $fname = htmlspecialchars($row['fname']);
                  $lname = htmlspecialchars($row['lname']);
                  $contact = htmlspecialchars($row['contact']);
                  $email = htmlspecialchars($row['email']);
                  $sid = htmlspecialchars($row['sid']);

                  echo "<tr>";
                  echo "<td>";
                  echo $lname . ', ' . $fname;
                  echo "</td>";
                  echo "<td>";
                  echo "<div class='td_info'>ID: ";
                  echo $sid;
                  echo "</div>";
                  echo "<div class='td_info'>EMAIL: ";
                  echo $email;
                  echo "</div>";
                  echo "<div class='td_info'>CONTACT: ";
                  echo $contact;
                  echo "</div>";
                  echo "</td>";
                  echo "</tr>";
                }
                echo "</table>";
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
          ?>
        </div>
      </div>

    <?php
      // If the user is not logged in properly
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