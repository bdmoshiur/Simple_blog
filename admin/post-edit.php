<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("location: login.php");
}
include '../config.php'; 
?>


<?php
if (!isset($_REQUEST['id'])) {
	header("location: post-view.php"); 
}else{

$id = $_REQUEST['id'];

}

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


		

		$post_title1 = $_POST['post_title'];
		$post_description1 = $_POST['post_description'];
		$cat_id1 = $_POST['cat_id'];
		$tag_id1 = $_POST['tag_id'];
			$i = 0;
		if (is_array($tag_id1)) {
			foreach ($tag_id1 as $key => $value) {
				$arr[$i] = $value;
				$i++;
			}
		}
		$tag_ids1 = implode(",",$arr);



		if (empty($_FILES['post_image']['name'])) {

			$sql = "UPDATE `tbl_post` SET `post_title`= '$post_title1',`post_description`= '$post_description1',`cat_id`= '$cat_id1',`tag_id`= '$tag_ids1' WHERE `post_id` = '$id' ";
				mysqli_query($conn,$sql);

			
		}else{


				$file_name = $id.$_FILES['post_image']['name'];
				echo $file_name;
				$extention = pathinfo($_FILES['post_image']['name'], PATHINFO_EXTENSION);
				$extention1 = $file_name. ".".$extention;
				$destination ="../uploads/" . $file_name;

				$filename = $_FILES['post_image']['tmp_name'];

				if(($extention1!='.png')&&($extention1!='.jpg')&&($extention1!='.jpeg')&&($extention1!='.gif'))
				throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");



	 			 $sql = "SELECT * FROM tbl_post WHERE post_id = $id ";
	      		$result = mysqli_query($conn,$sql);
	         	while($row = mysqli_fetch_assoc($result)) { 

	 				$real_path = "../uploads/".$row['post_image'];

	 				unlink($real_path);
				}

	 	move_uploaded_file($filename, $destination);


	 	$sql = "UPDATE `tbl_post` SET `post_title`= '$post_title1',`post_description`= '$post_description1',`post_image`= '$extention1',`cat_id`= '$cat_id1',`tag_id`= '$tag_ids1 ' WHERE `post_id` = '$id' ";
				mysqli_query($conn,$sql);



		}





		$success_message = "Post updated successfully";

	}
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
}

?>







<?php
	$sql = "SELECT * FROM tbl_post WHERE post_id = $id ";
      $result = mysqli_query($conn,$sql);
       while($row = mysqli_fetch_assoc($result)) { 
            
	$post_title = $row['post_title'];
	$post_description = $row['post_description'];
	$post_image = $row['post_image'];
	$cat_id = $row['cat_id'];
	$tag_id = $row['tag_id'];

	}
?>

	<?php include 'header.php'; ?>			
				<h2>Edit Post</h2>	

				<?php
					if (isset($error_message)) {echo $error_message; }
					if (isset($success_message)) {echo $success_message; }
				?>


				<form action="post-edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
					<!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
					<table class="tbl1">
						<tr>
							<td>Title</td>
						</tr>
						<tr>
							<td><input class="long" type="text" name="post_title" value="<?php echo $post_title ?>"></td>
						</tr>
						<tr>
							<td>Description</td>
						</tr>
						<tr>
							<td>
								<textarea class="ckeditor" rows="10" cols="30" name="post_description"><?php echo $post_description ?></textarea>
							</td>
						</tr>
						<tr>
							<td> Previous Featured Image preview</td>
						</tr>
						<tr>
							<td>
								<img src="../uploads/<?php echo $post_image ?>" alt="" >
							</td>
						</tr>
						<tr>
							<td> New Featured Image</td>
						</tr>
						<tr>
							<td>
								<input type="file" name="img">
							</td>
						</tr>
						<tr>
							<td>Select a Category</td>
						</tr>
						<tr>
							<td>
								<select name="cat_id">
								<option value="">Select New Category</option>

						<?php

		 			 $sql = "SELECT * FROM tbl_category ORDER BY cat_name ASC";
		      		$result = mysqli_query($conn,$sql);
		         	while($row = mysqli_fetch_assoc($result)) { 

					    if ($row['cat_id'] == $cat_id) {
					         			
				?><option value="<?php echo $row['cat_id']?>" selected><?php echo $row['cat_name']?></option><?php
					      }else{

					      ?><option value="<?php echo $row['cat_id']?>"><?php echo $row['cat_name']?></option><?php
					         	}
					         
					         		

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

					 //$row['tag_id']
			       	//$tag_id

			       			$arr2 = explode(',',$tag_id);
			       			$count_arr2 = count(explode(',',$tag_id));
			       			$is_there = 0;
			       			for ($j=0; $j <$count_arr2 ; $j++) { 
			       				if ($arr2[$j] == $row['tag_id']) {

			       					$is_there = 1;
			       					break;
			       				}
			       			}

			       			if ($is_there == 1) {
			       				?><input class="long" type="checkbox" name="tag_id[]" value="<?php echo $row['tag_id']?>" checked>&nbsp;<?php echo $row['tag_name']?> <br>	<?php

			       				
			       			}else{

			       				 ?><input class="long" type="checkbox" name="tag_id[]" value="<?php echo $row['tag_id']?>">&nbsp;<?php echo $row['tag_name']?> <br>	<?php
			       			}


							}

							?>
							</td>
							
						</tr>
						<tr>
							<td><input type="submit" name="form1" value="UPDATE"></td>
						</tr>
					</table>
				</form> 
				
	<?php include 'footer.php'; ?>	