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

			if (empty($_POST['footer_text'])) {
				throw new Exception("Footer Text Can Not be Empty.");
				
			}

			$description = $_POST['footer_text'];		
			$sql = "UPDATE `tbl_footer` SET `description`='$description' WHERE `id`= 1 ";
      		 mysqli_query($conn,$sql);

      		 $success_message = "Footer Text is Updated Successfully.";

		}
		catch(Exception $e){
			$error_message = $e->getMessage();
		}

	}
?>



<?php
	
	  $sql = "SELECT * FROM tbl_footer WHERE id= 1 ";
		$result = mysqli_query($conn,$sql);

		while($row = mysqli_fetch_assoc($result)) { 
 
         $description = $row['description'];

		}

?>


	<?php include 'header.php'; ?>			
				<h2> Change Footer Text</h2>


				<?php
					if (isset($error_message)) {echo $error_message; }
					if (isset($success_message)) {echo $success_message; }
				?>
				<form action="" method="post">
					<table class="tbl1">
						<tr>
							<td>Footer Text</td>
						</tr>
						<tr>
							<td><input class="long" type="text" name="footer_text" value="<?php echo $description ?>"></td>
						</tr>
						<tr>
							<td><input type="submit" name="form1" value="SAVE"></td>
						</tr>
					</table>
				</form>
				
	<?php include 'footer.php'; ?>	