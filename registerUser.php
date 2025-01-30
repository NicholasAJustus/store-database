<?php
$page_title = 'Create an Account';
include ('header.html');
include ('connection.php');
?>
<div class="container-fluid">
	<form name="User Registration" id="myform" method="POST" action="user_submit.php" enctype="multipart/form-data">
		<br>
		<input type="hidden" id="changed" name="changed" value="yes" />
		<div class="border border-info" style="background-color: #5bc0de;">
			<div class="form-check" style="padding: 20px;">
				<h1>Create Account</h1>
				<div class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="username">Username</label>
						<input required  name="username" id="username" type="text" class="form-control" placeholder="Username" style="width: 30vw;" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
					</div>
				</div>
				<br>
				<div class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="email">Email</label>
						<input required name="email" id="email" type="email" class="form-control" style="width: 30vw;" placeholder="Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
					</div>
				</div>
				<br>
				<div class="form-inline">
					<div class="form-group">
						<label class="sr-only" for="password">Password</label>
						<input required name="password" id="password" type="password" class="form-control" style="width: 30vw;" placeholder="Password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
					</div>
				</div>
			</div>
		</div>
		<br>
	<div class="border border-info">
		<div class="form-check">
			<br>
			<button class="btn btn-primary" type="submit" name="submit">Create</button>
			<a href="login.php"><input class="btn btn-secondary" type="button" value="Cancel and Exit"></a>
		</div>
		<br>
	</form>
	</div>
</div>
<?php
include ('footer.html');
$con->close();
?>
