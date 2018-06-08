<?php
session_start();

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['search'])) {

    //including database file
    include_once 'dbh.inc.php';

    //search keyword from search form
    $searchword = $_POST['search'];

    // Use keyword to search database for topics where name is the same as keyword.
    $querySearchTopics = "SELECT topic_id FROM topics WHERE topic_name = '$searchword'";
    $result = mysqli_query($conn, $querySearchTopics);

    // Count matches. If matches = 0 send user to index where no matches found message is shown.
    $resultCheck = mysqli_num_rows($result);
    $fetch_topic_id = mysqli_fetch_row($result);


    if ($resultCheck > 0) {

      // Implode result
      $fetch_topic_id_string = implode($fetch_topic_id);
      // Set get value to show topic of searched keyword.
      header('Location: ../index.php?selected_topic='.$fetch_topic_id_string);
      } else {
        header('Location: ../index.php?searchresults=0');
    }

} else {
    // sends user to index if they accessed file via URL
    header("Location: ../index.php?somethinghappened");
    exit();
}
