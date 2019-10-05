<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php");
}
include '../config.php'; 
?>


	<?php include 'header.php'; ?>			
				<h2> Welcome to Admin Panel</h2>
				<div style="font-size: 28px;font-weight: bold;text-align: center;padding-top: 50px; color: #3d9ccd">
					Welcome to The Dashboard of <br>
					Sample Blog With PHP
				</div>
	<?php include 'footer.php'; ?>	
			