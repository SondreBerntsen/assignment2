<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $user_id = $_SESSION['u_id'];
    $topicTitle = mysqli_real_escape_string($conn, $_POST['topic']);
    $topicId = "SELECT topic_id FROM topics WHERE title = $topicTitle";
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $publishedDate = date('d/m/Y');

    //Error handlers
    // Check for empty fields
    if (empty($title) || empty($content)) {
      header("Location: ../index.php?entry=empty");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z0-9]*$/", $title)) {
        header("Location: ../index.php?entryname=invalid");
        exit();
      } else {
        // Check if entry exists
          $sql = "SELECT * FROM entries WHERE title='$title'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            header("Location: ../index.php?entry=entry_exists");
            exit();
            // Insert the entry into the database
            } else {
              print_r($select_id);
              print_r($topicId);

              $sql = "INSERT INTO entries (user_id, title, content, pub_date) VALUES ('$user_id','$title','$content','$publishedDates')";
              mysqli_query($conn, $sql);

              $sql3 = "INSERT INTO belongs_to(entry_id,topic_id) VALUES ('$select_id','$topicId')";
              mysqli_query($conn, $sql3);

              header("Location: ../index.php?newentry=success");

              exit();
          }
        }
      }

} else {
    // sends user to the signup page if they access signup file via URL
    header("Location: ../index.php?somethinghappened");
    exit();
}
