
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

		if (empty($_POST['cat_name'])) {
			throw new Exception("Category Name Can Not be empty");
			
		}

		$cat_name = $_POST['cat_name'];

		$sql = "SELECT * FROM `tbl_category` WHERE `cat_name`= '$cat_name' ";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
	 	if ($num > 0) {
	 			throw new Exception("Category allredy Exsit");
	 		}else{

	 $sqll = "INSERT INTO `tbl_category`(`cat_name`) VALUES ('$cat_name')";
	 mysqli_query($conn,$sqll);
	 $success_message = "Category Name has been inserted successfully";

	 		}
 		
 	
	}
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
}

?>



<?php

if (isset($_POST['form2'])) {

	try{

		if (empty($_POST['cat_name'])) {
			throw new Exception("Category name can not be empty");
			
		}
		$cat_name1 =$_POST['cat_name'];
		$cat_id1 =$_POST['cat_id'];

$sql2 = " UPDATE tbl_category SET cat_name = '$cat_name1' WHERE cat_id = '$cat_id1' ";

	 mysqli_query($conn,$sql2);
	 $success_message1 = "Category Name has been Updated successfully";



	}

	catch(Exception $e){
		$error_message1 = $e->GetMessage();
	}
}


if (isset($_REQUEST['id'])) {
	
	$id = $_REQUEST['id'];

	$sql3 = " DELETE FROM `tbl_category` WHERE `cat_id`= $id ";
	mysqli_query($conn,$sql3);

	  $success_message2 = "Category Name has been Delete successfully";

}



?>






	<?php include 'header.php'; ?>			
				<h2>Add New Category</h2>

				<?php

					if (isset($error_message)) {
						echo $error_message;
					}
					if (isset($success_message)) {
						echo $success_message;
					}

				?>

				<form action="" method="post">
					<table class="tbl1">
						<tr>
							<td>Category Name</td>
						</tr>
						
						<tr>
							<td><input class="short" type="text" name="cat_name"></td>
						</tr>
						<tr>
							<td><input type="submit" value="SAVE" name="form1"></td>
						</tr>
					</table>
				</form>

				<h2>View All Category</h2>

				<?php

					if (isset($error_message1)) {
						echo $error_message1;
					}
					if (isset($success_message1)) {
						echo $success_message1;
					}

					if (isset($success_message2)) {
						echo $success_message2;
					}

				?>

				<table class="tbl2" width="100%">
						<tr>
							<th width="5%">Serial</th>
							<th width="75%">Category Name</th>
							<th width="15%">Action</th>
						</tr>

 			 <?php
 			 $sql = "SELECT * FROM tbl_category";
     		 $result = mysqli_query($conn,$sql);
             	 $i=0;
         			while($row = mysqli_fetch_assoc($result)) { 
             	 $i++;
         		?>

						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row['cat_name']?></td>
							<td>
							<a class="fancybox" href="#inline1<?php echo $i ?>" >Edit	</a>
								<div id="inline1<?php echo $i ?>" style="width:400px;height:100px;overflow:auto;display: none;">
									<h3>Edit Data</h3>
									<p>
										<form action="" method="post">
											<input type="hidden" name="cat_id" value="<?php echo $row['cat_id']?> ">
										<table>
											
											<tr>
												<td>Ctegory Name</td>
											</tr>
									<tr>
									<td><input type="text" name="cat_name" value="<?php echo $row['cat_name']?>"></td>
									</tr>
											<tr>
												<td><input type="submit" name="form2" value="UPDATE"></td>
											</tr>
										</table>
										</form>
									</p>
								
								</div>
							

								&nbsp;|&nbsp;
								<a onclick="return confirmDelete();" href="manage-category.php?id=<?php echo $row['cat_id'] ?>">Delete</a>
							</td>
						</tr>
						<?php

							}
						?>
				</table>

				
	<?php include 'footer.php'; ?>	