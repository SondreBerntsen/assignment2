<?php
session_start();

// Variables for use in all if statements
$user_id = $_SESSION['u_id'];

// Change username
if (isset($_POST['submitusername'])) {

    include_once '../dbh.inc.php';
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    //Error handlers
    // Check for empty fields
    if (empty($username)) {
      header("Location: ../../useredit.php?updateinfo=empty");
      exit();
    } else {
      // Check if input characters are valid
      if (!preg_match("/^[a-zA-Z]*$/", $username)) {
        header("Location: ../../useredit.php?updateinfo=invalid_username");
        exit();
        } else {
          $sql = "SELECT * FROM users WHERE username='$username'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            header("Location: ../../useredit.php?updateinfo=usertaken");
            exit();
          } else {
            // Update username information
            unset($_SESSION['u_name']);
            $_SESSION['u_name'] = $username;
            $sql = "UPDATE users SET username = '$username' WHERE user_id='$user_id'";
            mysqli_query($conn, $sql);
            header("Location: ../../useredit.php?edit=success");
            exit();
          }
        }
      }
    }

// Change email
if (isset($_POST['submitemail'])) {

    include_once '../dbh.inc.php';
    $email = $_SESSION['u_email'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    //Error handlers
    // Check for empty fields
    if (empty($email)) {
      header("Location: ../../useredit.php?updateinfo=empty");
      exit();
    } else {
      // Check if input characters are valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../useredit.php?updateinfo=invalidemail");
        exit();
      } else {
          $sql = "SELECT * FROM users WHERE email='$email'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);

          if ($resultCheck > 0) {
            header("Location: ../../useredit.php?updateinfo=emailtaken");
            exit();
          } else {
            // Update username information
            $sql = "UPDATE users SET email = '$email' WHERE user_id='$user_id'";
            mysqli_query($conn, $sql);
            header("Location: ../../useredit.php?edit=success");
            exit();
          }
        }
      }
    }

if (isset($_POST['submitpassword'])) {

    include_once '../dbh.inc.php';
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //Error handlers
    // Check for empty fields
    if (empty($password)) {
      header("Location: ../../useredit.php?updateinfo=empty");
      exit();
      } else {
            // Update username information
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$hashedPwd' WHERE user_id='$user_id'";
            mysqli_query($conn, $sql);
            header("Location: ../../useredit.php?edit=success");
            exit();
          }
        }


?>
