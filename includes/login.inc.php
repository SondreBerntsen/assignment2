<?php

session_start();

if (isset($_POST['submit'])) {
  include 'dbh.inc.php';

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  //Error handlers
  //Check if inputs are empty

  if (empty($username) || empty($password)) {
    header("Location: ../index.php?login=empty");
    exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1) {
            header("Location: ../index.php?login=usernamenotfound");
            exit();
        } else {
          if ($row = mysqli_fetch_assoc($result)) {
            //de-Hashing
            $hashedPwdCheck = password_verify($password, $row['password']);
            if ($hashedPwdCheck == false) {
              header("Location: ../index.php?login=error");
              exit();
            } elseif ($hashedPwdCheck == true) {
              //Log in the user
              $_SESSION['u_id'] = $row['user_id'];
              $_SESSION['u_name'] = $row['username'];
              $_SESSION['u_email'] = $row['email'];
              $_SESSION['u_type'] = $row['user_type'];
              header("Location: ../index.php?login=success");
              exit();
            }
          }
        }
      }
} else {
    header("Location: ../index.php?login=empty");
    exit();
  }
