<?php
include_once 'templates/header.php';
?>

<!--signup form -->

<form class="formwidth" action="includes/signup.inc.php" method="POST">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="Enter username" name="username">
    <small id="usernameHelp" class="form-text text-muted">Choose a cool one!.. or a superlame one, no one will judge you.</small>
  </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Super Top Secret Password" name="password">
    <small id="emailHelp" class="form-text text-muted">Psst, dont tell anyone about this part, okay?</small>
  </div>

  <div class="form-group">
    <label for="password">Usertype</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="user_type" value="author" checked>
      <label class="form-check-label" for="usertypeAuthor">
        I want to be an Author!
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="user_type" id="exampleRadios2" value="administrator">
      <label class="form-check-label" for="usertypeAdministrator">
        I want to be an Administrator! (That easy huh?)
      </label>
    </div>
  </div>

  <button type="submit" name="submit" class="btn btn-primary" href="signup.php">Submit</button>
</form>

<?php
include_once 'templates/footer.php';
?>
