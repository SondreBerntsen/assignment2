<?php
include_once 'templates/header.php';
if (!isset($_SESSION['u_id'])) {
  header("Location: index.php?state=notloggedin");
}
?>

<div class="container">
  <form class="formwidth" action="includes/edituser/updateuser.php" method="POST">
    <div class="form-group">
      <label for="username">New Username</label>
      <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="Enter username" name="username">
      <small id="usernameHelp" class="form-text text-muted">Choose a cool one!.. or a superlame one, no one will judge you.</small>
      <button type="submit" name="submitusername" class="btn btn-primary">Change username</button>
    </div>


    <div class="form-group">
      <label for="email">New Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      <button type="submit" name="submitemail" class="btn btn-primary">Change email</button>
    </div>

    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Super Top Secret Password" name="password">
      <small id="emailHelp" class="form-text text-muted">Psst, dont tell anyone about this part, okay?</small>
      <button type="submit" name="submitpassword" class="btn btn-primary">Change password</button>
    </div>
  </form>
  -->



</div>





<?php
  include_once 'templates/footer.php';
 ?>
