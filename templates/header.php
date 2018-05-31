<?php
session_start();
include_once 'includes/dbh.inc.php';
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <title>The Urban Dictionary</title>
  </head>

  <body>
    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">The Urban Dictionary</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signup.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Posts</a>
          </li>
        </ul>
      </div>

        <?php
        if (isset($_SESSION['u_id'])) {
          echo '<form class="form-inline my-2 my-lg-0" action="includes/logout.inc.php" method="POST">
                  <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="submit">Logout</button>
                </form>';
        } else {
          echo '<form class="form-inline my-2 my-lg-0" action="includes/login.inc.php" method="POST">
                  <input name="username" class="form-control mr-sm-2" type="text" placeholder="username" aria-label="username">
                  <input name="password" class="form-control mr-sm-2" type="password" placeholder="password" aria-label="password">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Login</button>';
        }
        ?>


      </form>



    </nav>
