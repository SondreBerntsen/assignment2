<?php

// Check if user has actually clicked submit button or just went to the url for the signup file
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    //Error handlers
    // Check for empty fields
    if (empty($username) || empty($email) || empty($password)) {
      header("Location: ../signup.php?signup=empty");
      exit();
    } else {
      //Check if input characters are valid
      if (!preg_match("/^[a-zA-Z]*$/", $username)) {
        header("Location: ../signup.php?signup=invalid");
        exit();
      } else {
        // Check if email is invalid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          header("Location: ../signup.php?signup=invalid_email");
          exit();
        } else {
          $sql = "SELECT * FROM users WHERE username='$username'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            header("Location: ../signup.php?signup=user_taken");
            exit();
          } else {
            // Hashing the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO users (username, email, password, user_type) VALUES ('$username', '$email', '$hashedPwd', '$user_type');";
            mysqli_query($conn, $sql);
            header("Location: ../signup.php?signup=success");
            exit();
          }
        }
      }
    }

} else {
    // sends user to the signup page if they access signup file via URL
    header("Location: ../signup.php");
    exit();
}
