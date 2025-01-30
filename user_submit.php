<?php
  include_once 'connection.php';

  $usernameErr = $emailErr = $passwordErr = "";

  $username = $email = $password = "";

  if(isset($_POST['submit'])) {
    if(!empty($_POST['username'])) {
      $username = test_input($_POST['username']);
    }else{
      $usernameErr = "Item Name is required";
    }
    if(!empty($_POST['email'])) {
      $email = test_input($_POST['email']);
    }else{
      $emailErr = "Item Price is required";
    }
    if(!empty($_POST['password'])) {
      $password = test_input($_POST['password']);
      $hashedPassword = sha1($password);
    }else{
      $passwordErr = "Initial Stock is required";
    }
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $sql = "INSERT INTO users (username, email, password)
   VALUES ('$username', '$email', '$hashedPassword');";
if ($con->query($sql) == TRUE) {
  try {
    $profile_id = mysqli_insert_id($con);
    include 'header.html';
    createHTML();
    include 'footer.html';
  } catch(exception $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}
$con->close();

function createHTML(){
  ?>
  <br>
  <div class="container-fluid">
    <h3>Registration Successful!</h3>
    <br>
    <div class="form-check">
      <a href="login.php">
        <button class="btn btn-primary" name="return">
          Continue to Login</button></a>
    </div>
  </div>
  <br>
  <?php
} ?>
