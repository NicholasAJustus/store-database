<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('login_functions.php');
    require('connection.php');

    $errors = [];

    if (empty($_POST['email'])) {
      $errors[] = 'Email field is empty';
    } else {
      $email = mysqli_real_escape_string($con, trim($_POST['email']));
    }

    if (empty($_POST['password'])) {
      $errors[] = 'Password field is empty';
    } else {
      $password = mysqli_real_escape_string($con, trim($_POST['password']));
    }

    list($check, $data) = check_login($con, $email, $password);

    if ($check) {
      session_start();

      $_SESSION['user_id'] = $data['user_id'];
      $_SESSION['first_name'] = $data['username'];
      $_SESSION['password'] = $data['password'];
      $_SESSION['user_level'] = $data['user_level'];
      $_SESSION['last_login_date'] = $data['last_login_date'];

      $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);

      #set last login date to current login
      $query = "UPDATE users SET last_login_date=NOW() WHERE user_id={$_SESSION['user_id']} LIMIT 1";
      $result = mysqli_query($con, $query) or trigger_error("Query: $query\n<br>MySql Error: " . mysqli_error($con));

      if (mysqli_affected_rows($con) == 1) {
      redirect_user();
      }

    } else {
      $errors = $data;
    }
    mysqli_close($con);
  }

  include('login_form.php');
?>
