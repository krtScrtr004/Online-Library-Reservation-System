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
  <link rel="stylesheet" type="text/css" href="../stylepopW.css">
  <link rel="stylesheet" type="text/css" href="../stylepopup.css">
  <link rel="stylesheet" type="text/css" href="custom_popup.css">
  <title>BOOKS</title>
</head>

<style>
  .popup .popuptext {
    top: -35%;
    left: 95%;
  }
</style>

<body>
  <div class="wrapper1">

    <?php
    $ses_email = htmlspecialchars($_SESSION['email']);
    // Checks if the user is logged in
    if (isset($ses_email)) {
    ?>

      <div class="table_cont">
        <div class="divider">
          <!-- Refreshes the page when clicked -->
          <h2 id="hname" class="exempt-hover"><a href="book.php" class="a-exempt" style="color: black">BOOKS</a></h2>
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
            $search_term = "%" . $_POST["search"] . "%";
            // Search query
            $q = mysqli_query($db, "SELECT * FROM `book` WHERE name like '$search_term' OR isbnlike '$search_term' OR authors like '$search_term' OR status like '$search_term' OR department like '$search_term'");
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
                echo "INFORMATION";
                echo "</th>";
                echo "<th>";
                echo "</th>";
                echo "</tr>";
                // Iterates db to output all data
                while ($row = mysqli_fetch_assoc($q)) {
                  $bpic = htmlspecialchars($row['bpic']);
                  $isbn = htmlspecialchars($row['isbn']);
                  $name = htmlspecialchars($row['name']);
                  $authors = htmlspecialchars($row['authors']);
                  $edition = htmlspecialchars($row['edition']);
                  $status = htmlspecialchars($row['status']);
                  $limit = htmlspecialchars($row['limit']);
                  $department = htmlspecialchars($row['department']);

                  echo "<tr>";
                  echo "<td>";
          ?>
                  <div class="img_cntr"><img src="../lib/bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
              <?php
                  echo "</td>";
                  echo "<td>";
                  echo "<div class='td_info'>ISBN: ";
                  echo $isbn;
                  echo "</div>";
                  echo "<div class='td_info'>NAME: ";
                  echo $name;
                  echo "</div>";
                  echo "<div class='td_info'>STATUS: ";
                  echo $status;
                  echo "</div>";
                  echo "<div class='td_info'>LIMIT: ";
                  echo $limit;
                  echo "</div>";
                  echo "<td>";

                  // Button to view description, where isbnis passed as a parameter
                  echo "<div class='exempt-hover'><button class='button a-exempt' style='width:135px; height: 40px; padding: 0;'><a href='description.php?isbn=$isbn' class='btn'>DESCRIPTION</a></button><div>";
                  echo "<br>";
                  // Button to open a popup window form, where isbn is passed as a parameter
                  // When pressed, openPopup function runs
                  echo "<div class='exempt-hover'><button class='button a-exempt' onclick='openPopup(\"" . $row['isbn'] . "\")' style='width:135px; height: 40px; padding: 0'><a class='btn'>REQUEST</a></button></div>";
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
          } else {
            // Book Query
            $res = mysqli_query($db, "SELECT * FROM `book` ORDER BY `isbn` ASC;");
            // If the query is successful
            if ($res) {
              // If there is no book available
              if (mysqli_num_rows($res) == 0) {
                echo "<br>";
                echo "<br>";
                echo "<div style='margin-left:20px;'> No book available. </div>";
                // If there is a book available
              } else {
                echo "<table>";
                echo "<tr>";
                echo "<th>";
                echo "COVER";
                echo "</th>";
                echo "<th>";
                echo "INFORMATION";
                echo "</th>";
                echo "<th>";
                echo "</th>";
                echo "</tr>";
                // Iterates db to output all data
                while ($row = mysqli_fetch_assoc($res)) {
                  $bpic = htmlspecialchars($row['bpic']);
                  $isbn = htmlspecialchars($row['isbn']);
                  $name = htmlspecialchars($row['name']);
                  $authors = htmlspecialchars($row['authors']);
                  $edition = htmlspecialchars($row['edition']);
                  $status = htmlspecialchars($row['status']);
                  $limit = htmlspecialchars($row['limit']);
                  $department = htmlspecialchars($row['department']);

                  echo "<tr>";
                  echo "<td>";
              ?>
                  <div class="img_cntr"><img src="../lib/bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
              <?php
                  echo "</td>";
                  echo "<td>";
                  echo "<div class='td_info'>ISBN: ";
                  echo $isbn;
                  echo "</div>";
                  echo "<div class='td_info'>NAME: ";
                  echo $name;
                  echo "</div>";
                  echo "<div class='td_info'>STATUS: ";
                  echo $status;
                  echo "</div>";
                  echo "<div class='td_info'>LIMIT: ";
                  echo $limit;
                  echo "</div>";
                  echo "<td>";

                  // Button to view description, where isbnis passed as a parameter
                  echo "<div class='exempt-hover'><button class='button a-exempt' style='width:135px; height: 40px; padding: 0;'><a href='description.php?isbn=$isbn' class='btn'>DESCRIPTION</a></button><div>";
                  echo "<br>";
                  // Button to open a popup window form, where isbnis passed as a parameter
                  // When pressed, openPopup function runs
                  echo "<div class='exempt-hover'><button class='button a-exempt' onclick='openPopup(\"" . $row['isbn'] . "\")' style='width:135px; height: 40px; padding: 0'><a class='btn'>REQUEST</a></button></div>";
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

      <script>
        // Function that displays the popup when hovered and for opening and closing the popup window form
        function popup() {
          var popup = document.getElementById("myPopup");
          popup.classList.toggle("show"); // Displays the popup
        }

        function openPopup(isbn) {
          document.getElementById("popup").style.display = "block"; // Makes the popup form visible
          document.getElementById("isbn").value = isbn;
        }

        function closePopup() {
          document.getElementById("popup").style.display = "none"; // Makes the popup description window form hidden
        }
      </script>

      <!-- Popup Window Form -->
      <div class="popupWin" id="popup">
        <div class="blue_header">
          <h3>REQUEST FOR BOOK</h3>
          <div class="cursor-x" style="float: right; margin-right: 15px; color: white;" onclick="closePopup()">&times;</div>
        </div> <br><br><br>
        <form id="popup-form" action="request.php" method="POST">
          <input type="hidden" name="isbn" id="isbn" value="<?php echo $bid; ?>">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?php echo $ses_email ?>" required> <br><br>
          <div class="popup"> <!-- Popup hover -->
            <label for="due">Due Date:</label>
            <input type="text" name="due" id="due" placeholder="(yyyy-mm-dd)"> <br><br><br>
            <span class="popuptext" name="due" id="myPopup">Adds 7-day interval to issue date when left blank.</span> <!-- Popup content -->
          </div> <br>
          <button class="button exempt-hover" type="submit" onclick="closePopup()">REQUEST</button> <br><br>
        </form>
      </div>

    <?php
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