<?php include '../config.php'; ?>


<?php
session_start();
if (isset($_POST['login_form'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);

	$sql = "SELECT * FROM tbl_login WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);
 if ($num == 1) {
 		$_SESSION['login'] = true;
 		header("location: index.php");
 	}else{
 		$_SESSION['error'] = true;
 	header("location: login.php");
 	}

}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login-Sample Blog With PHP</title>
	<link rel="stylesheet" href="../style-admin.css">
</head>
<body>
	<div id="wrapper-login">
		<h1>Admin Login</h1>
		<form action="" method="post">
		<table>
				<tr>
					<td>Username</th>
					<td><input type="text" name="username" required=""></th>
				</tr>
				<tr>
					<td>Password</th>
					<td><input type="password" name="password" required=""></th>
				</tr>
				<tr>
					<td></th>
					<td><input type="submit" name="login_form" value="Login"></th>
				</tr>
		</table>
	</form>
	</div>
</body>
</html>