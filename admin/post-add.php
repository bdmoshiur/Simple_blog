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

		if (empty($_POST['post_title'])) {
			throw new Exception("Title Can Not be Empty");
			
		}
		if (empty($_POST['post_description'])) {
			throw new Exception("Description Can Not be Empty");
			
		}
		if (empty($_POST['cat_id'])) {
			throw new Exception("Category Name Can Not be Empty");
			
		}
		if (empty($_POST['tag_id'])) {
			throw new Exception("Tag Name Can Not be Empty");
			
		}


		$file_name = date("Y-m-d-H-i-s").$_FILES['post_image']['name'];
		$extention = pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION);
		$extention1 = ".".$extention;
		$destination ="../uploads/" . $file_name;

		$filename = $_FILES['post_image']['tmp_name'];

		if(($extention1!='.png')&&($extention1!='.jpg')&&($extention1!='.jpeg')&&($extention1!='.gif'))
		throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

	 	move_uploaded_file($filename, $destination);

		$post_title = $_POST['post_title'];
		$post_description = $_POST['post_description'];
		$cat_id = $_POST['cat_id'];
		$tag_id = $_POST['tag_id'];
			$i = 0;
		if (is_array($tag_id)) {
			foreach ($tag_id as $key => $value) {
				$arr[$i] = $value;
				$i++;
			}
		}
 
		$tag_ids = implode(",",$arr);
		$post_date = date("Y-m-d");
		$post_timestamp =  strtotime(date("Y-m-d"));
		$year = substr($post_date,0,4);
		$month = substr($post_date,5,2);



		$sql = "INSERT INTO `tbl_post`(`post_title`, `post_description`, `post_image`, `cat_id`, `tag_id`, `post_date`, `year`,`month`, `post_timestamp`) VALUES ('$post_title','$post_description','$file_name','$cat_id','$tag_ids','$post_date','$year','$month','$post_timestamp' )";
		 mysqli_query($conn,$sql);




		$success_message = "Post Inserted successfully";

	}
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
}


?>








	<?php include 'header.php'; ?>			
				<h2>Add New Post</h2>

				<?php
					if (isset($error_message)) {echo $error_message; }
					if (isset($success_message)) {echo $success_message; }
				?>




				<form action="" method="POST" enctype="multipart/form-data">
					<table class="tbl1">
						<tr>
							<td>Title</td>
						</tr>
						<tr>
							<td><input class="long" type="text" name="post_title"></td>
						</tr>
						<tr>
							<td>Description</td>
						</tr>
						<tr>
							<td>
								<textarea class="ckeditor" rows="10" cols="30" name="post_description"></textarea>
							</td>
						</tr>
						<tr>
							<td>Featured Image</td>
						</tr>
						<tr>
							<td>
								<input type="file" name="post_image">
							</td>
						</tr>
						<tr>
							<td>Select a Category</td>
						</tr>
						<tr>
							<td>
								<select name="cat_id">
									<option value="">Select Category</option>
			 <?php
		 			 $sql = "SELECT * FROM tbl_category ORDER BY cat_name ASC ";
		      $result = mysqli_query($conn,$sql);
		          
		       	while($row = mysqli_fetch_assoc($result)) { 
		             
		         ?>
						<option value="<?php echo $row['cat_id']?>"><?php echo $row['cat_name']?></option>
								
				<?php

				}

				?>
					</select>
						</td>
					</tr>
					<tr>
						<td>Select a Tag</td>
					</tr>
					<tr>
						<td>

						<?php
			 			 $sql = "SELECT * FROM tbl_tag ORDER BY tag_name ASC ";
			      		$result = mysqli_query($conn,$sql);
			             
			       		while($row = mysqli_fetch_assoc($result)) { 
			             
			         		?>
							<input class="long" type="checkbox" name="tag_id[]" value="<?php echo $row['tag_id']?>">&nbsp;<?php echo $row['tag_name']?> <br>	
							<?php

							}

							?>
							</td>
							
						</tr>
						<tr>
							<td><input type="submit" name="form1" value="SAVE"></td>
						</tr>
					</table>
				</form> 
				
	<?php include 'footer.php'; ?>	