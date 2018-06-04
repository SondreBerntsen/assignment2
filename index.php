<?php
include_once 'templates/header.php';
?>


    <!--Super Content-->

<div class="container">
<?php

if (isset($_SESSION['u_type'])) {
  $username = $_SESSION['u_name'];
  echo '<div class="jumbotron">
          <h1 class="display-5">Welcome ' . $username . '</h1>
          <hr class="my-4">
          <p>Since you are registered to the website you get the neat option of creating your own entry!</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entryModal">
              Create new entry!
            </button>
        </div>

';
}
 ?>

    <!-- NEW ENTRY MODAL FORM -->

    <?php
      $sql = "SELECT * FROM topics ORDER BY topic_id DESC LIMIT 0,6";
      $result = mysqli_query($conn, $sql);
    ?>

    <div class="modal fade" id="entryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="entryModalLabel">Entry Creation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/entries.inc.php" method="POST">
              <div class="form-group">
                <label for="topic">New entry</label>
                <input type="text" class="form-control" placeholder="Enter entry title" name="title">
              </div>
              <div class="form-group">
                <textarea class="form-control" name="content" rows="5"></textarea>
                <small id="usernameHelp" class="form-text text-muted">Hope your new entry is a hit!</small>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Select topic</label>
                <select class="form-control" name="topics">
                  <?php
                      while ($row = mysqli_fetch_array($result)) {
                          echo "<option name='topics' value='" . $row['topic_id'] . "'>" . $row['topic_name'] . "</option>";
                      }
                  ?>
                </select>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- NEW TOPIC FORM MODAL -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Topic creation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/topic.inc.php" method="POST">
              <div class="form-group">
                <label for="topic">New topic</label>
                <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="Enter topic name" name="topic_name">
                <small id="usernameHelp" class="form-text text-muted">Hope your new topic is a hit!</small>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <div class="container">
  <div class="row">
    <div class="col-sm-3">
      <div class="list-group">

        <?php
          $sql = "SELECT * FROM topics ORDER BY topic_id DESC LIMIT 0,6";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_array($result)) {
              echo '<a class=list-group-item list-group-item-action href=index.php?selected_topic=' . $row['topic_id'] . '>' . $row['topic_name'] . '</a>';
          }

          if (isset($_SESSION['u_type'])) {
            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create new topic
                  </button>';
          }

        ?>

      </div>
    </div>
    <div class="col">
      <?php
      if (isset($_GET['selected_topic'])) {
        $selected_entries = $_GET['selected_topic'];
        $sql = "SELECT * FROM entries WHERE topic_id = $selected_entries";
        $result = mysqli_query($conn, $sql);


        $uid_query = "SELECT user_id FROM entries WHERE topic_id = '$selected_entries'";
        $uid_from_entries = mysqli_query($conn, $uid_query);
        $fetch_uid = mysqli_fetch_row($uid_from_entries);
        $fetch_uid_string = implode($fetch_uid);


        $username_query = "SELECT username FROM users WHERE user_id = '$fetch_uid_string'";
        $username_from_users = mysqli_query($conn, $username_query);
        $fetch_username = mysqli_fetch_row($username_from_users);
        $fetch_username_string = implode($fetch_username);


        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="card">
          			    <div class="card-body">
          			      <h5 class="card-title">' . $row['title'] . '</h5>
          			      <p class="card-text">' . $row['content'] . '</p>
          			      <p class="card-text"><small class="text-muted">Created by ' . $fetch_username_string . '</small></p>
          			    </div>
          				</div>';
        }
      }
      ?>


			</div>
    </div>
  </div>
</div>





<?php
  include_once 'templates/footer.php';
 ?>
