<?php
if (isset($_POST['submit'])) {

  include_once 'dbh.inc.php';

  $topic_id = $_POST['topics'];
  // First delete entries in selected topic
  $sql = "DELETE FROM entries WHERE topic_id='$topic_id'";
  mysqli_query($conn, $sql);

  // Then delete the selected topic
  $sql = "DELETE FROM topics WHERE topic_id='$topic_id'";
  mysqli_query($conn, $sql);

  //Redirect the user to the indexpage with deletedtopic=success
  header("Location: ../index.php?deletedtopic=success&selected_topic=$topic_id");
} else {
  header("Location: ../index.php");
}


 ?>
