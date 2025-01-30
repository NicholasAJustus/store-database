<?php
function redirect_user($page = 'index.php') {
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	header("Location: $url");
	exit();
}

function check_login($con, $user_email = '', $user_password = '') {

	$errors = [];
	if (empty($user_email)) {
		$errors[] = 'Please enter an e-mail address.';
	} else {
		$e = mysqli_real_escape_string($con, trim($user_email));
	}
	if (empty($user_password)) {
		$errors[] = 'Please enter a password.';
	} else {
		$p = mysqli_real_escape_string($con, trim($user_password));
	}

	if (empty($errors)) {
		$query = "SELECT * FROM users WHERE email='$e' AND password=SHA1('$p')";
		$result = @mysqli_query($con, $query);

		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return [true, $row];
		} else {
			$errors[] = 'Invalid Credentials.';
		}
	}
	return [false, $errors];
}
