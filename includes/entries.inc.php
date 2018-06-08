<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';


    $user_id = $_SESSION['u_id'];

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $publishedDate = date('Y/m/d');

    $topic_id_post = mysqli_real_escape_string($conn, $_POST['topics']);
    $select_topic_id = "SELECT topic_id FROM topics WHERE topic_id = '$topic_id_post'";
    $topic_id_query = mysqli_query($conn, $select_topic_id);
    $topic_id = mysqli_fetch_assoc($topic_id_query);
    $topic_id_string = implode($topic_id);

    //Error handlers
    // Check for empty fields
    if (empty($title) || empty($content)) {
      header("Location: ../index.php?entry=empty");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $title)) {
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

              $sql = "INSERT INTO entries (title, pub_date, user_id, topic_id, content) VALUES ('$title', '$publishedDate', '$user_id', '$topic_id_string', '$content')";
              mysqli_query($conn, $sql);

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

if (isset($_POST['delete_entry'])) {
  include_once 'dbh.inc.php';

  $topic_id = $_POST['topics'];
  // First delete entries in selected topic
  $sql = "DELETE FROM entries WHERE topic_id='$topic_id'";
  mysqli_query($conn, $sql);

  // Then delete the selected topic
  $sql = "DELETE FROM topics WHERE topic_id='$topic_id'";
  mysqli_query($conn, $sql);

  //Redirect the user to the indexpage with deletedtopic=success
  header("Location: ../index.php?delete_entry=success");
}   header("Location: ../index.phpi_see_you_trying_to_access_this_file");
    exit();
