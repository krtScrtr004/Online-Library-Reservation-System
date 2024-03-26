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

  <body>
    <div class="wrapper" style="flex-direction: column;">

      <?php
      $ses_email = htmlspecialchars($_SESSION['email1']);
      // Checks if the user is logged in
      if (isset($ses_email)) {
      ?>

        <!-- Navigations -->
        <div class="grid_prnt exempt-hover">
          <a href="book.php" class="a-exempt"> <!-- Book Page -->
            <div class="grid" id="top_cncl">
              <img src="../img/book.png">
              <h1 style="float: right">BOOKS</h1>
            </div>
          </a>
          <a href="request.php" class="a-exempt"> <!-- Book Requests Page -->
            <div class="grid" id="top_cncl">
              <img src="../img/req.png">
              <h1>BOOK <br> REQUEST</h1>
            </div>
          </a>
          <a href="addbook.php" class="a-exempt"> <!-- Add Book Page -->
            <div class="grid" id="top_cncl">
              <img src="../img/add.png">
              <h1>ADD BOOK</h1>
            </div>
          </a>
        </div>

        <div class="grid_prnt exempt-hover">
          <a href="issue_info.php" class="a-exempt"> <!-- Issued Books Page -->
            <div class="grid">
              <img src="../img/issue.png">
              <h1>ISSUED <br> BOOKS <br> INFORMATION</h1>
            </div>
          </a>
          <a href="profile.php" class="a-exempt"> <!-- Profile Info Page -->
            <div class="grid">
              <img src="../img/profile.png">
              <h1>PROFILE</h1>
            </div>
            <a href="student.php" class="a-exempt"> <!-- Student List Page -->
              <div class="grid">
                <img src="../img/stud icon.png">
                <h1 style="margin-right: 0">STUDENT <br> INFORMATION</h1>
              </div>
            </a>
        </div>


        <?php
        // Statistics Queries
        // Student query that counts the number of the verified student accounts
        $student = mysqli_query($db, "SELECT COUNT(*) as total1 FROM `student` WHERE verify = 'VERIFIED' ");
        // Issue_book query that counts the number of the unapproved requests
        $req = mysqli_query($db, "SELECT COUNT(*) as total2 FROM `issue_book` WHERE approve = ' ' ");
        // Issue_book query that counts the number of the approved requests
        $borrowed = mysqli_query($db, "SELECT COUNT(*) as total3 FROM `issue_book` WHERE approve = 'APPROVED' ");

        // Stores the counted numbers to variables
        $row1 = mysqli_fetch_array($student); // No. of verified student accounts
        $row2 = mysqli_fetch_array($req); // No. of prending requests
        $row3 = mysqli_fetch_array($borrowed); // No. of borrowed books

        // If the query is successful 
        if ($student && $req && $borrowed) {
        ?>

          <!-- Displays the statistics -->
          <div class="grid_prnt">
            <div class="grid stats" style="background-color: #f81c10;">
              <div style="flex: column;">
                <p>NO OF STUDENTS</p>
                <h1><?php echo htmlspecialchars($row1['total1']); ?></h1>
              </div>
            </div>
            <div class="grid stats" style="background-color: #2716de;">
              <div style="flex: column;">
                <p>NO OF REQUESTS</p>
                <h1><?php echo htmlspecialchars($row2['total2']); ?></h1>
              </div>
            </div>
            <div class="grid stats" style="background-color: #268c04;">
              <div style="flex: column;">
                <p>BORROWED BOOKS</p>
                <h1><?php echo htmlspecialchars($row3['total3']); ?></h1>
              </div>
            </div>
          </div>

        <?php
        // If the query is unsuccessful
        } else {
        ?>
          <script type="text/javascript">
            alert("An error occured. Please try again."); // Prints the error
          </script>
        <?php
          exit();
        }
        // If the user is not logged in
      } else {
        ?>
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