<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/login_page.css?version=1" type="text/css">
<title>Login</title>
<?php

if(isset($_POST['login_btn'])){
	login("n");
	exit;
}

if(isset($_POST['signup_btn'])){
	login("y");
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
<label>Username: </label><input type="text" id="uname" name="uname"><br>
<label>Password: </label><input type="text" id="pword" name="pword"><br><br>
<input type="submit" name="login_btn" class="button" value="Login">
<input type="submit" name="signup_btn" class="button" onclick="toggle_signup_form()" value="Sign Up">
</form>
<form method="post" id="signup_form">
<h1>Register New Account</h1>
<label>Username: </label><input type="text" id="new_uname" name="new_uname"><br>
<label>Password: </label><input type="text" id="new_pword" name="new_pword"><br>
<label>Confirm Password: </label><input type="text" id="confirm_new_pword" name="confirm_new_pword"><br><br>
<input type="submit" name="register_btn" class="button" value="Register">
</form>


<?php
function login($new_user){
	$username = escapeshellarg($_POST['uname']);
	$password = escapeshellarg($_POST['pword']);
	$login_dir = "/var/www/html/cs/PasswordHasher";
	$command = "./../cs/PasswordHasher/bin/release/net8.0/linux-arm64/PasswordHasher $username $password $new_user";
	//$output = shell_exec("$command 2>&1 ");
	$output = exec("$command 2>&1 ");
	echo $output;
}
?>
<script src="../javascript/login_page.js"></script>
</body>
</html>
