<?php
include_once 'templates/header.php';
?>


    <!--Super Content-->

<div class="container">
  <div class="row">
    <div class="col">
      1 of 2
    </div>
    <div class="col-lg">
      2 of 2
  </div>
</div>
<div class="container">
  <div class="contentcheck">
    <h2>Home</h2>
  <?php
    if (isset($_SESSION['u_id'])) {
      echo "You are logged in";
    }
   ?>
  </div>
<?php
  $sql = "SELECT * FROM topics ORDER BY topic_id DESC LIMIT 0,6";
  $result = mysqli_query($conn, $sql);
?>
  <form>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Select topic</label>
      <select class="form-control" id="exampleFormControlSelect1">
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['topic_id'] . "'>" . $row['topic_name'] . "</option>";
            }
        ?>
      </select>
    </div>
  </form>

<?php

if (isset($_SESSION['u_type'])) {
  echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Launch demo modal
        </button>';
}

?>

<div class="list-group">
  <?php
    $sql = "SELECT * FROM topics ORDER BY topic_id DESC LIMIT 0,6";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<a class='list-group-item list-group-item-action href='index.php?selected_topic=" . $row['topic_name'] . "value=" . $row['topic_id'] . ">" . $row['topic_name'] . "</a>";
        echo '<a class=list-group-item list-group-item-action href=index.php?selected_topic="' . $row['topic_name'] . '"></div>';
    }

    if (isset($_GET['select_topic'])) {
      select_topic($_GET['selected_topic']);
    }

    function Search($res)
    {
        //real search code goes here
        echo $res;
    }
  ?>
</div>
  <!-- Button trigger modal -->

  <!-- Modal -->
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
</div>





<?php
  include_once 'templates/footer.php';
 ?>
