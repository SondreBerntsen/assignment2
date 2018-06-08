<?php
include_once 'templates/header.php';
if (!isset($_SESSION['u_id'])) {
  header("Location: index.php?state=notloggedin");
}
?>


    <!--Super Content-->

<div class="container">

    <!-- NEW ENTRY MODAL FORM -->

    <!-- Delete topic modal -->
    <h2 class="modal-title" id="deletetopicmodaltitle">Edit your entries and topics</h2>
    <p>Below you can find a list of all the topics you have created and all entries you have made.</p>

    <div class="modal fade" id="deletetopicmodal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deletetopicmodaltitle">Delete topic</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="includes/deletetopic.inc.php" method="POST">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Select topic</label>
                <select class="form-control" name="topics">
                  <?php
                  $session_id = $_SESSION['u_id'];
                  $sql = "SELECT * FROM topics WHERE user_id = '$session_id' ORDER BY topic_id DESC LIMIT 0,6";
                  $result = mysqli_query($conn, $sql);

                  while ($row = mysqli_fetch_array($result)) {
                      echo "<option name='topic_id' value='" . $row['topic_id'] . "'>" . $row['topic_name'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="alert alert-danger" role="alert">
                Warning! Deleting topic will also delete all entries in selected topic.
              </div>
              <button type="submit" name="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="You will permanently delete topic!">
                Delete topic
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- NEW TOPIC FORM MODAL -->

    <div class="modal fade" id="newtopicmodal" tabindex="-1" role="dialog" aria-labelledby="newtopicmodal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newtopicmodaltitle">Topic creation</h5>
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
        // New topic modal trigger button, is only shown if user is logged in
        if (isset($_SESSION['u_type'])) {
          echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newtopicmodal">
                  Create new topic
                </button>';
        }



          //Showing all topics created by user
          $session_id = $_SESSION['u_id'];
          $sql = "SELECT * FROM topics WHERE user_id = $session_id  ORDER BY topic_id DESC LIMIT 0,6";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_array($result)) {
              echo '
              <a class=list-group-item list-group-item-action href=user.php?selected_topic=' . $row['topic_id'] . '>' . $row['topic_name'] . '</a>
              ';

          }

          //Shows edit topic button, allowing user to delete topics they have created.
          if (isset($_SESSION['u_type'])) {
            echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetopicmodal">
                    Edit topics
                  </button>';
          }


        ?>

      </div>
    </div>

    <!-- displaying users entries with a delete button-->
    <div class="col">
      <form action="includes/delete_entry.inc.php" method="POST">
      <?php
      if (isset($_GET['selected_topic'])) {
        $selected_entries = $_GET['selected_topic'];
        $sql = "SELECT * FROM entries WHERE user_id = $_SESSION[u_id]";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="card">
          			    <div class="card-body">
          			      <h5 class="card-title">' . $row['title'] . '</h5>
          			      <p class="card-text">' . $row['content'] . '</p>
                      <input type="hidden" name="entry_id" value= ' . $row['entry_id'] . '>
          			      <p class="card-text"><small class="text-muted">Created by you!</small></p>
                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this entry?\');">Delete entry</button>
          			    </div>
          				</div>';
        }
      }

      while ($row = mysqli_fetch_array($result)) {
          echo '
          <a class=list-group-item list-group-item-action href=index.php?selected_topic=' . $row['topic_id'] . '>' . $row['topic_name'] . '</a>
          ';

      }
      ?>
      </form>


			</div>
    </div>
  </div>
</div>





<?php
  include_once 'templates/footer.php';
 ?>
