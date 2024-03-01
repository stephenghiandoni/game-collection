<?php
include('def.php');
$current_page = basename($_SERVER['PHP_SELF']);
if(isset($_POST['login'])){
	if($current_page == 'index.php') header("Location:php/login_page.php");
	else header("Location:login_page.php");
	exit;
}
 ?>
<div class="container" id="header_container">
<h1 id="title_header">Steve's Domain</h1>
<form method="post" id="header_form">
<input type="submit" name="login" id="login_btn" class="button" value="Login"/><br/><br/>
</form>
</div>
<script src="<?php ($current_page == 'index.php') ? "javascript/header_bar.js" : "../javascript/header_bar.js"; ?>"></script>
