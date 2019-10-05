<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php"); 
}
include '../config.php'; 
?>


<?php 
if (isset($_POST['form1'])) {
try{

	if (empty($_POST['old'])) {
		throw new Exception("Old Password Can Not be Empty.");
	}
	if (empty($_POST['new1'])) {
		throw new Exception(" New Password Can Not be Empty.");
	}if (empty($_POST['new2'])) {
		throw new Exception("Confirm Can Not be Empty.");
	}
	$old = $_POST['old'];		
	$new1 = $_POST['new1'];		
	$new2 = $_POST['new2'];

	 $sql = "SELECT * FROM tbl_login WHERE id=1";
	$result = mysqli_query($conn,$sql);
	
	while($row = mysqli_fetch_assoc($result)) { 
			
			$old_md5 = md5($old);
			if ($old_md5 != $row['password']) {
				throw new Exception("Old Password is wrong.");
			}
	}

	if ($new1 != $new2) {
				throw new Exception("New Password and Confirm Password dose Not Match.");
			}

			$new_final_pass = md5($new1);
			$sql = "UPDATE `tbl_login` SET `password`= $new_final_pass WHERE `id`=1";
			 mysqli_query($conn,$sql);

	
		 $success_message = "Password Updated Successfully.";
}
catch(Exception $e){
	$error_message = $e->getMessage();
}

}

?>



<?php include 'header.php'; ?>			
	<h2> Change Password</h2>

	<?php
		if (isset($error_message)) {echo $error_message; }
		if (isset($success_message)) {echo $success_message; }
	?>
	<form action="" method="post">
		<table class="tbl1">
			<tr>
				<td>Old Password</td>
			</tr>
			<tr>
				<td><input class="short" type="password" name="old"></td>
			</tr>
			<tr>
				<td>New Password</td>
			</tr>
			<tr>
				<td><input class="short" type="password" name="new1"></td>
			</tr>
			<tr>
				<td>Confirm Password</td>
			</tr>
			<tr>
				<td><input class="short" type="password" name="new2"></td>
			</tr>
			<tr>
				<td><input type="submit" name="form1" value="SAVE"></td>
			</tr>
		</table>
	</form>
	
<?php include 'footer.php'; ?>	