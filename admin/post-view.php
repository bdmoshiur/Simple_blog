<?php
session_start();
if (!isset($_SESSION['login'])) {
header("location: login.php");
}
include '../config.php'; 
?>


<?php include 'header.php'; ?>		

<h2>View All Post</h2>


<table class="tbl2" width="100%">
	<tr>
		<th width="5%">Serial</th>
		<th width="65%">Title</th>
		<th width="25%">Action</th>
	</tr>

<?php
 $sql = "SELECT * FROM `tbl_post`  ORDER BY post_id DESC ";
	$result = mysqli_query($conn,$sql);
	 $i = 0;
		while($row = mysqli_fetch_assoc($result)) { 
	 $i++;
?>

	<tr>
		<td><?php echo $i ?></td>
		<td><?php echo $row['post_title']?></td>
		<td>
		<a class="fancybox" href="#inline1<?php echo $i ?>" >View</a>
			<div id="inline1<?php echo $i ?>" style="width:700px;overflow:auto;display: none;">
				<h3 style="border-bottom: 1px solid #808080;">View All Data</h3>
				<p>
					<form action="" method="post">
					<table>
						<tr>
							<td><b>Title</b></td>
						</tr>
						<tr>
							<td><?php echo $row['post_title']?></td>
						</tr>
						<tr>
							<td><b>Description</b></td>
						</tr>
						<tr>
							<td><?php echo $row['post_description']?></td>
						</tr>
						<tr>
							<td><b>Featured Image</b></td>
						</tr>
						<tr>
							<td><img src="../uploads/<?php echo $row['post_image']?>" alt=""></td>
						</tr>
						<tr>
							<td><b>Category</b></td>
						</tr>
						<tr>
							<td>
								
								<?php

								 $sql1 = "SELECT * FROM tbl_category WHERE cat_id=$row[cat_id]";
					      		$result1 = mysqli_query($conn,$sql1);
					         	
					     		while($row1 = mysqli_fetch_assoc($result1)) { 
					         	
					         	 	echo $row1['cat_name'];
					         	}

								?>

							</td>
						</tr>
						<tr>
							<td><b>Tag</b></td>
						</tr>
						<tr>
							<td>
								<?php

									$arr = explode(',' ,$row['tag_id']);
									$count_arr = count(explode(',' ,$row['tag_id']));
										$k = 0;

									for ($i=0; $i <$count_arr ; $i++) { 

											$sql1 = "SELECT * FROM tbl_tag WHERE tag_id=$arr[$i]";
								      		$result1 = mysqli_query($conn,$sql1);
								         	
								     		while($row1 = mysqli_fetch_assoc($result1)) { 
								       
								         	 	 $arr1[$k] = $row1['tag_name'] ;
						         				}
											$k++;

									}

									$tag_names = implode(',' ,$arr1);
									echo $tag_names;

								?>
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="edit" value="UPDATE"></td>
						</tr>
					</table>
					</form>
				</p>
			</div>
		

			&nbsp;|&nbsp;
			<a href="post-edit.php?id=<?php echo $row['post_id']; ?>">Edit</a>
			&nbsp;|&nbsp;
			<a onclick="return confirmDelete();" href="post-delete.php?id=<?php echo $row['post_id']; ?>">Delete</a>
		</td>
	</tr>

<?php

}
?>
	
	
</table>


<?php include 'footer.php'; ?>	