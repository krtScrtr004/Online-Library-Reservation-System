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
  <title>HOME</title>
</head>

<style>
  table {
    background-color: #f2f2f2;
    border: none;
    box-shadow: none;
  }

  td,
  tr {
    border: none;
  }

  tr:hover td {
    background-color: inherit;
    text-shadow: none;
  }

  @media screen and (max-width: 1200px) {
    .wrapper {
      height: inherit;
      display: flex;
      flex-direction: column;
      justify-content: start;
    }
  }
</style>

<body>
  <div class="wrapper">

    <?php
    $ses_email = htmlspecialchars($_SESSION['email']);

    // Checks if the user is logged in
    if (isset($ses_email)) {
    ?>

      <div class="grid_section">
        <div id="main_home">
          <!-- Slideshow -->
          <div class="mainh_div">
            <div class="sl_show">
              <div class="slideshow-container">

                <div class="mySlides fade">
                  <img src="slide/sl1.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                  <img src="slide/sl2.png" style="width:100%">
                </div>

                <div class="mySlides fade">
                  <img src="slide/sl3.png" style="width:100%">
                </div>
              </div>
            </div>
            <br>

            <script src="slide.js"></script> <!-- Functions for slide -->

            <!-- Navigations -->
            <div class="navs">
              <div class="grid_prnt exempt-hover">
                <a href="book.php" class="a-exempt"> <!-- Book Page -->
                  <div class="grid">
                    <img src="../img/book.png">
                    <h1 style="float: right">BOOKS</h1>
                  </div>
                </a>
                <a href="breq.php" class="a-exempt"> <!-- Request Page -->
                  <div class="grid">
                    <img src="../img/req.png">
                    <h1>BOOK <br> REQUEST</h1>
                  </div>
                </a>
                <a href="profile.php" class="a-exempt"> <!-- Profile Info Page -->
                  <div class="grid">
                    <img src="../img/profile.png">
                    <h1>PROFILE</h1>
                  </div>
                </a>
                <a href="admin.php" class="a-exempt"> <!-- Librarian List Page -->
                  <div class="grid">
                    <img src="../img/admin.png">
                    <h1>LIBRARIAN <br> LIST</h1>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>

      <div id="wht_box">
        <div class="white_box">
          <div class="blue_header">
            <h3 style="text-align: center; color: white;">MOST BORROWED BOOKS</h3>
          </div>

          <br>

          <div class="scroll">
            <?php
            // Most Borrowed Books
            // Book Query limited to 10 
            $trending = mysqli_query($db, "SELECT name, bcount FROM `book` ORDER BY bcount DESC LIMIT 0, 10;");
            // If the query is successful
            if ($trending) {
              // Iterates to output all the books
              while ($row = mysqli_fetch_assoc($trending)) {
                $bcount = htmlspecialchars($row['bcount']);
                $name = htmlspecialchars($row['name']);

                echo "<table style='background-color: transparent;'>";
                echo "<tr>";
                echo "<td>";
                echo "<div style='text-align: left;'>" . $bcount . "x | " . $name . "</div>";
                echo "</td>";
                echo "</tr>";
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
            ?>
          </div>

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