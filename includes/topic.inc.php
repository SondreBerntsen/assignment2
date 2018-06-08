<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $topic_name = mysqli_real_escape_string($conn, $_POST['topic_name']);
    $user_id = $_SESSION['u_id'];


    //Error handlers
    // Check for empty fields
    if (empty($topic_name)) {
      header("Location: ../index.php?topic=empty");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $topic_name)) {
        header("Location: ../index.php?topicname=invalid");
        exit();
      } else {
        // Check if email is invalid
          $sql = "SELECT * FROM topics WHERE topic_name='$topic_name'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            header("Location: ../index.php?topic=topic_exists");
            exit();
            // Insert the user into the database
            } else {
              $sql = "INSERT INTO topics (topic_name, user_id) VALUES ('$topic_name','$user_id')";
              mysqli_query($conn, $sql);
              header("Location: ../index.php?newtopic=success");
              exit();
          }
        }
      }

} else {
    // sends user to the signup page if they access signup file via URL
    header("Location: ../index.php?somethinghappened");
    exit();
}
