<?php
session_start();
if (!isset($_SESSION['login'])) {
header("location: login.php");
}
include '../config.php'; 
?>


<?php 

if (isset($_REQUEST['id'])) {

	try{

		$id = $_REQUEST['id'];		
		$sql = "UPDATE `tbl_comment` SET `active`= 1 WHERE `c_id`= $id ";
  		 mysqli_query($conn,$sql);
  		 $success_message = "Comment is  Approve. Thank You.";

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
			<h2>All Un-approve Comment</h2>

			<?php
				if (isset($error_message)) {echo $error_message; }
				if (isset($success_message)) {echo $success_message; }
			?>
		
				<table class="tbl2" width="100%">
					<tr>
						<th width="">Serial</th>
						<th width="">Name</th>
						<th width="">Email</th>
						<th width="">Url</th>
						<th width="">Message</th>
						<th width="">Post ID</th>
						<th width="">Action</th>
					</tr>
			<?php
 			 $sql = "SELECT * FROM `tbl_comment` WHERE `active`=0 ORDER BY `c_id` DESC";
      			$result = mysqli_query($conn,$sql);
             	 $i = 0;
         			while($row = mysqli_fetch_assoc($result)) { 
             	 $i++;
         	?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row['c_name'];?></td>
						<td><?php echo $row['c_email']?></td>
						<td><?php echo $row['c_url']?></td>
						<td><?php echo $row['c_message']?></td>
			<td>
			<a class="fancybox" href="#inline1<?php echo $i ?>" ><?php echo $row['post_id']?></a>
			<div id="inline1<?php echo $i ?>" style="width:700px;overflow:auto;display: none;">
			<h3 style="border-bottom: 1px solid #808080;">View Post Deteles</h3>
			<p>
				<?php
				 $post_id1 = $row['post_id'];
 			 	$sql1 = "SELECT * FROM `tbl_post` WHERE post_id=$post_id1 ";
      			$result1 = mysqli_query($conn,$sql1);
             	 $i = 0;
         			while($row1 = mysqli_fetch_assoc($result1)) { 
             	 $i++;

         	?>

         	<table>
					<tr>
						<td><b>Title</b></td>
					</tr>
					<tr>
						<td><?php echo $row1['post_title']?></td>
					</tr>
					<tr>
						<td><b>Description</b></td>
					</tr>
					<tr>
						<td><?php echo $row1['post_description']?></td>
					</tr>
					<tr>
						<td><b>Featured Image</b></td>
					</tr>
					<tr>
						<td><img src="../uploads/<?php echo $row1['post_image']?>" alt=""></td>
					</tr>
					<tr>
						<td><b>Category</b></td>
					</tr>
					<tr>
						<td>
							<?php
							 $sql2 = "SELECT * FROM tbl_category WHERE cat_id=$row1[cat_id]";
				      		$result2 = mysqli_query($conn,$sql2);				         	
				     		while($row2 = mysqli_fetch_assoc($result2)) { 
				         	 	echo $row2['cat_name'];
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

								$arr = explode(',' ,$row1['tag_id']);
								$count_arr = count(explode(',' ,$row1['tag_id']));
									$k = 0;
								for ($i=0; $i <$count_arr ; $i++) { 

										$sql2 = "SELECT * FROM tbl_tag WHERE tag_id=$arr[$i]";
							      		$result2 = mysqli_query($conn,$sql2);
							         	
							     		while($row2 = mysqli_fetch_assoc($result2)) { 
							       
							         	 	 $arr2[$k] = $row2['tag_name'] ;
					         				}
										$k++;
								}

								$tag_names = implode(',' ,$arr2);
								echo $tag_names;
							?>
						</td>
					</tr>
				</table>

         	<?php
         		}
         	?>
				
				
			</p>

		</div>
					

								
			</td>

						<td><a href="comment-approve.php?id=<?php echo $row['c_id']; ?>">Approve</a></td>
					</tr>
			<?php

				}
			?>	
			</table>



			<h2>All Approve Comment</h2>

			<table class="tbl2" width="100%">
					<tr>
						<th width="">Serial</th>
						<th width="">Name</th>
						<th width="">Email</th>
						<th width="">Url</th>
						<th width="">Message</th>
						<th width="">Post ID</th>
						
					</tr>
			<?php
 			 $sql = "SELECT * FROM `tbl_comment` WHERE `active`=1 ORDER BY `c_id` DESC";
      			$result = mysqli_query($conn,$sql);
             	 $i = 0;
         			while($row = mysqli_fetch_assoc($result)) { 
             	 $i++;
         	?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row['c_name'];?></td>
						<td><?php echo $row['c_email']?></td>
						<td><?php echo $row['c_url']?></td>
						<td><?php echo $row['c_message']?></td>
						
						<td>
			<a class="fancybox" href="#inline1<?php echo $i ?>" ><?php echo $row['post_id']?></a>
			<div id="inline1<?php echo $i ?>" style="width:700px;overflow:auto;display: none;">
			<h3 style="border-bottom: 1px solid #808080;">View Post Deteles</h3>
			<p>
				<?php
				 $post_id1 = $row['post_id'];
 			 	$sql1 = "SELECT * FROM `tbl_post` WHERE post_id=$post_id1 ";
      			$result1 = mysqli_query($conn,$sql1);
             	 $i = 0;
         			while($row1 = mysqli_fetch_assoc($result1)) { 
             	 $i++;

         	?>

         	<table>
					<tr>
						<td><b>Title</b></td>
					</tr>
					<tr>
						<td><?php echo $row1['post_title']?></td>
					</tr>
					<tr>
						<td><b>Description</b></td>
					</tr>
					<tr>
						<td><?php echo $row1['post_description']?></td>
					</tr>
					<tr>
						<td><b>Featured Image</b></td>
					</tr>
					<tr>
						<td><img src="../uploads/<?php echo $row1['post_image']?>" alt=""></td>
					</tr>
					<tr>
						<td><b>Category</b></td>
					</tr>
					<tr>
						<td>
							<?php
							 $sql2 = "SELECT * FROM tbl_category WHERE cat_id=$row1[cat_id]";
				      		$result2 = mysqli_query($conn,$sql2);				         	
				     		while($row2 = mysqli_fetch_assoc($result2)) { 
				         	 	echo $row2['cat_name'];
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

								$arr = explode(',' ,$row1['tag_id']);
								$count_arr = count(explode(',' ,$row1['tag_id']));
									$k = 0;
								for ($i=0; $i <$count_arr ; $i++) { 

										$sql2 = "SELECT * FROM tbl_tag WHERE tag_id=$arr[$i]";
							      		$result2 = mysqli_query($conn,$sql2);
							         	
							     		while($row2 = mysqli_fetch_assoc($result2)) { 
							       
							         	 	 $arr2[$k] = $row2['tag_name'] ;
					         				}
										$k++;
								}

								$tag_names = implode(',' ,$arr2);
								echo $tag_names;
							?>
						</td>
					</tr>
				</table>

         	<?php
         		}
         	?>
				
				
			</p>

		</div>
					

								
			</td>



					</tr>
			<?php

				}
			?>	
			</table>

			
			
<?php include 'footer.php'; ?>	