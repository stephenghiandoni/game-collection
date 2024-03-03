<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/login_page.css?version=1" type="text/css">
<title>Login</title>
<?php

if(isset($_POST['login_btn'])){
	$success = login("n");
	if($success === "0") header("Location:../index.php");
	else echo $success;
	exit;
}

if(isset($_POST['register_btn'])){
	$success = login("y");
	echo $success;
	exit;
}

?>
</head>
<body>
<?php
include('../header_bar.php');
?>
<form method="post" id="login_form">
<h1>Login</h1>
<label>Username: <input type="text" id="uname" name="uname"></label><br>
<label>Password: <input type="text" id="pword" name="pword"></label><br><br>
<input type="submit" name="login_btn" class="button" value="Login">
<input type="submit" name="signup_btn" class="button" onclick="toggle_signup_form()" value="Sign Up">
</form>
<form method="post" id="signup_form">
<h1>Register New Account</h1>
<p>Password must be at least 6 characters long</p>
<label>Username: <input type="text" id="new_uname" class="new_account" name="new_uname"></label><br>
<label>Password: <input type="text" id="new_pword" class="new_account" name="new_pword"></label><br>
<label>Confirm Password: <input type="text" id="confirm_new_pword" class="new_account" name="confirm_new_pword"></label><br><br>
<input type="submit" name="register_btn" id="submit_new_account" class="button" value="Register" disabled>
</form>

<?php
function login($new_user){
	$username = ($new_user === "y") ? escapeshellarg($_POST['new_uname']) : escapeshellarg($_POST['uname']);
	$password = ($new_user === "y") ? escapeshellarg($_POST['new_pword']) : escapeshellarg($_POST['pword']);
	$command = "./../cs/PasswordHasher/bin/release/net8.0/linux-arm64/PasswordHasher $username $password $new_user";
	//$output = shell_exec("$command 2>&1 ");
	$output = exec("$command 2>&1 ");
	return $output;
}
?>
<script src="../javascript/login_page.js"></script>
</body>
</html>
