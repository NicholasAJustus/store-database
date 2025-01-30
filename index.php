<?php
$page_title = 'Catalog Home';
include('header.html');
if(!isset($_SESSION['user_id'])){
	header("Location: login.php");
	die();
}
?>

<div class="page-header"><h1>Home Page</h1></div>
<hr />

<?php
  if (isset($_SESSION['user_id'])) {
    echo "<h2>Welcome, " . $_SESSION['first_name'] . "!</h2>";
  }
 ?>

<?php
  if (isset($_SESSION['user_id'])) {
    echo '<div class="row" style="min-height:50vh;">';
  }

include('footer.html');
?>
