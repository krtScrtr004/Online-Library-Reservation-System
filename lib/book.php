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
  <title>BOOKS</title>
</head>

<style>
  .scroll {
    min-height: fit-content;
  }

  tr td:last-child {
    padding: 10px;
  }

  @media screen and (min-width: 621px) and (max-width: 820px) {
    td {
      padding-right: 0;
    }
  }

  @media screen and (max-width: 600px) {
    .popupWin {
      height: fit-content;
    }
  }
</style>

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

        <div class="book_div">
          <!-- Table Area -->
          <div class="tbl_sec">
            <div class="scroll">
              <?php
              // Checks if the user pressed the search button named 'submit'
              if (isset($_POST['submit'])) {
                // Retreives the search term from the search bar
                $search_term = "%" . $_POST["search"] . "%";
                // Search query
                $q = mysqli_query($db, "SELECT * FROM `book` WHERE isbn like '$search_term' OR name like '$search_term' OR authors like '$search_term' OR status like '$search_term' OR department like '$search_term'");
                // If the query is successful
                if ($q) {
                  // If the search term does not match to any data
                  if (mysqli_num_rows($q) == 0) {
                    echo "<br>";
                    echo "<br>";
                    echo "<div style='margin-left:20px;'> No book matched. </div>";
                    // If the search term matched to data
                  } else {
                    echo "<form action='act.php' method='POST'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th style='background-color:red; padding: 2px;'>";
              ?>
                    <input class="a-exempt" type="submit" name="del_btn" id="" value="&#128465;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                    <?php
                    echo "</th>";
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
                      echo "<td style='width: 5px; padding:0;'>";
                    ?>
                      <input type="checkbox" name="del[]" value="<?php echo $isbn; ?>" style="width: 50px; height: 20px;">
                      <?php
                      echo "</td>";
                      echo "<td>";
                      ?>
                      <div class="img_cntr"><img src="bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
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
                      // Button to view the book where 'isbn' is passed as a parameter
                      echo "<div><a href='read.php?isbn=$isbn' class='tb_btn a-exempt' style='background-color: rgb(6, 4, 129);'>VIEW</a></div>";
                      echo "<br>";
                      // Button to view the book description where 'isbn' is passed as a parameter
                      echo "<div><a href='description.php?isbn=$isbn' class='tb_btn a-exempt' style='background-color: rgb(6, 4, 129);'>DESCRIPTION</a></div>";
                      echo "<br>";
                      // Button to edit the book where 'isbn' is passed as a parameter
                      echo "<div><a href='editbook.php?isbn=$isbn' class='a-exempt tb_btn' style='background-color: rgb(6, 4, 129);'>EDIT</a></div>";
                      echo "<br>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                    echo "</form>";
                  }
                  // If the query is unsuccessful
                } else {
                  ?>
                  <script type="text/javascript">
                    alert("An error occured. Please try again."); // Prints the error
                  </script>
                  <?php
                  exit();
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
                    echo "<form action='act.php' method='POST'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th style='background-color:red; padding: 2px;'>";
                  ?>
                    <input class="a-exempt" type="submit" name="del_btn" id="" value="&#128465;" style="width: fit-content; height: 100%; cursor: pointer; padding: 0; border: none; box-shadow: none; color: white; background-color: transparent; font-weight: bold; font-size: 20px">
                    <?php
                    echo "</th>";
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
                      $pdf = $row['pdf'];

                      echo "<tr>";
                      echo "<td style='width: 5px; padding:0;'>";
                    ?>
                      <input type="checkbox" name="del[]" value="<?php echo $isbn; ?>" style="width: 50px; height: 20px;">
                      <?php
                      echo "</td>";
                      echo "<td>";
                      ?>
                      <div class="img_cntr"><img src="bpic/<?php echo $bpic; ?>" alt="Book cover image" style="height: 100px; border-radius: 5px;"></div>
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
                      // Button to view the book where 'isbn' is passed as a parameter
                      echo "<div><a href='read.php?isbn=$isbn' class='tb_btn a-exempt' style='background-color: rgb(6, 4, 129);'>VIEW</a></div>";
                      echo "<br>";
                      // Button to view the book description where 'isbn' is passed as a parameter
                      echo "<div><a href='description.php?isbn=$isbn' class='tb_btn a-exempt' style='background-color: rgb(6, 4, 129);'>DESCRIPTION</a></div>";
                      echo "<br>";
                      // Button to edit the book where 'isbn' is passed as a parameter
                      echo "<div><a href='editbook.php?isbn=$isbn' class='a-exempt tb_btn' style='background-color: rgb(6, 4, 129);'>EDIT</a></div>";
                      echo "<br>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                    echo "</form>";
                  }
                  // If the query is unsuccessful
                } else {
                  ?>
                  <script type="text/javascript">
                    alert("An error occured. Please try again."); // Prints the error
                  </script>
              <?php
                  exit();
                }
              }
              ?>
            </div>
          </div>

          <!-- Add Book Button -->
          <div class="btn_sec">
            <div id="book_btn">
              <button class="button exempt-hover"><a href="addbook.php" class="a-exempt" style="color: white;">ADD BOOK</a></button> <!-- Redirects to addbook.php when pressed -->
            </div>
          </div>
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