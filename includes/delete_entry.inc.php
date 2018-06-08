<?php
if (isset($_POST['submit'])) {

  include_once 'dbh.inc.php';

  $entry_id = $_POST['entry_id'];
  // Delete the selected entry
  $sql = "DELETE FROM entries WHERE entry_id='$entry_id'";
  mysqli_query($conn, $sql);


  //Redirect the user to the indexpage with deletedentry=success
  header("Location: ../user.php?deletedentry=success&selected_topic=$topic_id");
} else {
  header("Location: ../index.php");
}


 ?>
