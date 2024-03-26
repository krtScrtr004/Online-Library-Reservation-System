 <?php
    include "../connection.php";

if (isset($_POST['submit'])) {
    // Checks if the user pressed the edit profile button named 'submit'
        $isbn= htmlspecialchars($_POST['isbn']);
        $email = htmlspecialchars($_POST['email']);
        $issue = htmlspecialchars($_POST['issue']);
        $due = htmlspecialchars($_POST['due']);

            // Updates account information
            $q = mysqli_query($db, "UPDATE `issue_book` SET `issue` = '$issue', `due` = '$due' WHERE username = '$email' AND isbn= '$isbn' AND approve = 'APPROVED'; ");

            // If the info is successfully edited
            if ($q) {
    ?>
             <script type="text/javascript">
                 alert("Info has edited successfuly");
                window.location = "issue_info.php";
             </script>
         <?php
                // If the info has not been edited
            } else {
            ?>
             <script type="text/javascript">
                 alert("Info has not been edited."); // Prints the error
                 history.back();
             </script>
         <?php
            }
    }
    ?>