<?php
include "../connection.php";
session_start();

$ses_email = htmlspecialchars($_SESSION['email']);

// Checks if the user is logged in
if (isset($ses_email)) {
  // Retrieves data from the URL 
  $isbn = htmlspecialchars($_POST['isbn']);
  $email = htmlspecialchars($_POST['email']);
  $due = htmlspecialchars($_POST['due']);

  // Isssue-Book Query
  $res = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username = '$email' AND isbn = '$isbn' AND (approve = 'APPROVED' OR approve = ' ');");
  $row = mysqli_fetch_assoc($res);

  // Book Query
  $res1 = mysqli_query($db, "SELECT * FROM `book` WHERE isbn = '$isbn'; ");
  $row1 = mysqli_fetch_assoc($res1);
  // Retrieves limit from the db
  $limit = $row1['limit'];
  $status = $row1['status'];

  // If the query is successful
  if ($res && $res1) {
    //Checks if the book is already requested
    if ($row) {
?>
      <script>
        alert("You can only request for the same book once.");
        window.location = "book.php";
      </script>
    <?php
      // If the limit reached 0
    } else if ($limit === '0' || $status === 'Not Available') {
    ?>
      <script>
        alert("Book is not available at the moment");
        window.location = "book.php";
      </script>
      <?php
      // If the request is unique
    } else {
      // Inserts request to the db
      $sql = mysqli_query($db, "INSERT INTO `issue_book` VALUES ('$email', '$isbn', ' ', ' ', '$due');");

      // If the query is successful
      if ($sql) {
        // For request history 
        // Book Query
        $res2 = mysqli_query($db, "SELECT * FROM `book` WHERE isbn= '$isbn'");
        $row2 = mysqli_fetch_assoc($res2);
        // Retrieves name from the db
        $bname = htmlspecialchars($row2['name']);

        // Student Query
        $res3 = mysqli_query($db, "SELECT * FROM `student` WHERE email = '$email'");
        $row3 = mysqli_fetch_assoc($res3);
        // Retrieves data from the db
        $fname = htmlspecialchars($row3['fname']);
        $lname = htmlspecialchars($row3['lname']);
        // Inserts history to the db

        // If the query is successful
        if ($res2 && $res3) {
          $result = mysqli_query($db, "INSERT INTO `hreq` VALUES ('$isbn', '$bname', '$fname', '$lname', ' ', ' ');");

          // If the request is successful
          if ($result) {
      ?>
            <script type="text/javascript">
              alert("Book requested");
              window.location = "breq.php";
            </script>
          <?php
            // If the request is unsuccessful
          } else {
          ?>
            <script type="text/javascript">
              alert("The book has not been requested. Please try again."); // Prints the error
              history.back();
            </script>
          <?php
          }
          // If the query is unsuccessful
        } else {
          ?>
          <script type="text/javascript">
            alert("An error has occured. Please try again."); // Prints the error
          </script>
        <?php
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