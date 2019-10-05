
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

		if (empty($_POST['tag_name'])) {
			throw new Exception("Tag Name Can Not be empty");
			
		}

		$tag_name = $_POST['tag_name'];

		$sql = "SELECT * FROM `tbl_tag` WHERE `tag_name`= '$tag_name' ";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
	 	if ($num > 0) {
	 			throw new Exception("Tag allredy Exsit");
	 		}else{

	 $sqll = "INSERT INTO `tbl_tag`(`tag_name`) VALUES ('$tag_name')";
	 mysqli_query($conn,$sqll);
	 $success_message = "Tag Name has been inserted successfully";

	 		}
 		
 	
	}
	catch(Exception $e){
		$error_message = $e->getmessage();
	}
}






if (isset($_POST['form2'])) {

	try{

		if (empty($_POST['tag_name'])) {
			throw new Exception("Tag name can not be empty");
			
		}
		$tag_name1 =$_POST['tag_name'];
		$tag_id1 =$_POST['tag_id'];

$sql2 = " UPDATE tbl_tag SET tag_name = '$tag_name1' WHERE tag_id = '$tag_id1' ";

	 mysqli_query($conn,$sql2);
	 $success_message1 = "Tag Name has been Updated successfully";
	}

	catch(Exception $e){
		$error_message1 = $e->Getmessage();
	}

}




if (isset($_REQUEST['id'])) {
	
	$id = $_REQUEST['id'];

	$sql3 = " DELETE FROM `tbl_tag` WHERE `tag_id`= $id ";
	mysqli_query($conn,$sql3);

	  $success_message2 = "Tag Name has been Delete successfully";

}



?>






	<?php include 'header.php'; ?>			
				<h2>Add New Tag</h2>

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
							<td>Tag Name</td>
						</tr>
						
						<tr>
							<td><input class="short" type="text" name="tag_name"></td>
						</tr>
						<tr>
							<td><input type="submit" value="SAVE" name="form1"></td>
						</tr>
					</table>
				</form>

				<h2>View All Tag</h2>

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
							<th width="75%">Tag Name</th>
							<th width="15%">Action</th>
						</tr>

 			 <?php
 			 $sql = "SELECT * FROM tbl_Tag";
      			$result = mysqli_query($conn,$sql);
             	 $i=0;
         			while($row = mysqli_fetch_assoc($result)) { 
             	 $i++;
         		?>

						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row['tag_name']?></td>
							<td>
							<a class="fancybox" href="#inline1<?php echo $i ?>" >Edit	</a>
								<div id="inline1<?php echo $i ?>" style="width:400px;height:100px;overflow:auto;display: none;">
									<h3>Edit Data</h3>
									<p>
										<form action="" method="post">
											<input type="hidden" name="tag_id" value="<?php echo $row['tag_id']?> ">
										<table>
											
											<tr>
												<td>tag Name</td>
											</tr>
									<tr>
									<td><input type="text" name="tag_name" value="<?php echo $row['tag_name']?>"></td>
									</tr>
											<tr>
												<td><input type="submit" name="form2" value="UPDATE"></td>
											</tr>
										</table>
										</form>
									</p>
								
								</div>
							

								&nbsp;|&nbsp;
								<a onclick="return confirmDelete();" href="manage-tag.php?id=<?php echo $row['tag_id'] ?>">Delete</a>
							</td>
						</tr>
						<?php

							}
						?>
				</table>

				
	<?php include 'footer.php'; ?>	