<?php include "config.php"; ?>
<?php 
	if (!isset($_REQUEST['id'])) {
		header("location index.php");
	}
	$id = $_REQUEST['id'];
 ?>



<?php

if (isset($_POST['form1'])) {

	try{

		if (empty($_POST['c_message'])) {
			throw new Exception("Message can not be empty.");
		}
		if (empty($_POST['c_name'])) {
			throw new Exception("Name can not be empty.");
		}
		if (empty($_POST['c_email'])) {
			throw new Exception("Email can not be empty.");
		}

		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['c_email']))) {
			throw new Exception("Please enter a valid email address.");
		}

		$c_message = $_POST['c_message'];
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_url = $_POST['c_url'];
		$c_date = date('Y-m-d');
		$active = 0;

		$sql = "INSERT INTO `tbl_comment`(`c_name`, `c_email`, `c_url`, `c_message`, `c_date`, `post_id`, `active`) VALUES ('$c_name','$c_email','$c_url','$c_message','$c_date','$id','$active')";
	 mysqli_query($conn,$sql);



		$success_message = "Your comment has been sent.";



		


	}
	catch(Exception $e){
		$error_message = $e->getMessage();
	}
}

?>



<?php include 'header.php';?>
<?php include 'config.php';?>

			<?php
			$sql = "SELECT * FROM `tbl_post`WHERE post_id ='$id' ";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result)) { 
			?>

			<div class="post">
	<h2><?php echo $row['post_title']; ?></h2>
	<div>
					<span class="date">
							<?php 
								$post_date = $row['post_date']; 
								$day = substr($post_date, 8,2);
								$month = substr($post_date, 5,2);
								$year = substr($post_date, 0,4);


					
								if ($month == '01') { $month = "Jan";}
								if ($month == '02') { $month = "Feb";}
								if ($month == '03') { $month = "Mar";}
								if ($month == '04') { $month = "Apr";}
								if ($month == '05') { $month = "May";}
								if ($month == '06') { $month = "Jun";}
								if ($month == '07') { $month = "Jul";}
								if ($month == '08') { $month = "Aug";}
								if ($month == '09') { $month = "Sep";}
								if ($month == '10') { $month = "Oct";}
								if ($month == '11') { $month = "Nov";}
								if ($month == '12') { $month = "Dec";}

								echo $year.' '.$month. ' '.$day;

							?>
					</span>
					<span class="categories">
						in: &nbsp;

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



					</span>
				</div>
	<div class="description">
		<p>
			<a class="fancybox-effects-a" href="uploads/<?php echo $row['post_image']; ?>" title=""><img src="uploads/<?php echo $row['post_image']; ?>" alt="" width="200" /></a>
			<div style="clear:both;"></div>
			<?php echo $row['post_description']; ?>
		 </p>
	</div>
</div>




			<?php

				}
			?>










<div id="comments">
	<img src="images/title3.gif" alt="" width="216" height="39" /><br />		


		<?php
 			 $sql = "SELECT * FROM tbl_comment WHERE active = 1 AND post_id = $id ";
     		 $result = mysqli_query($conn,$sql);
         	while($row = mysqli_fetch_assoc($result)) { 
             	
         	?>

	<div class="comment">
		<div class="avatar">

				<?php

					$gravatarMd5 =  md5($row['c_email']);

						// $gravatarMd5 = "";
				?>

			<img src="http://www.gravatar.com/avatar/<?php echo $gravatarMd5; ?>" alt="" width="80" height="80" /><br />

			



			<span><?php

				if (empty($row['c_url'])) {
					echo $row['c_name']; 
				}else{
					echo "<a href='". $row['c_url']. " '>";
					echo $row['c_name']; 
					 echo "</a>";
				}
			


			 ?></span><br />
				<?php
					$year = substr($row['c_date'],0,4);
					$month = substr($row['c_date'],5,2);
					$day = substr($row['c_date'],8,2);

								if ($month == '01') { $month_full = "Jan";}
								if ($month == '02') { $month_full = "Feb";}
								if ($month == '03') { $month_full = "Mar";}
								if ($month == '04') { $month_full = "Apr";}
								if ($month == '05') { $month_full = "May";}
								if ($month == '06') { $month_full = "Jun";}
								if ($month == '07') { $month_full = "Jul";}
								if ($month == '08') { $month_full = "Aug";}
								if ($month == '09') { $month_full = "Sep";}
								if ($month == '10') { $month_full = "Oct";}
								if ($month == '11') { $month_full = "Nov";}
								if ($month == '12') { $month_full = "Dec";}


								echo $day." ".$month_full. " ,".$year;




				?>
		</div>
		<p><?php echo $row['c_message'];?></p>
	</div>
	<?php

   }

	?>



	
	<div id="add">
		<img src="images/title4.gif" alt="" width="216" height="47" class="title" /><br />
			<?php
					if (isset($error_message)) {echo $error_message; }
					if (isset($success_message)) {echo $success_message; }
				?>
		<div class="avatar">
			<img src="images/avatar2.gif" alt="" width="80" height="80" /><br />
			<span>Name User</span><br />
			April 12th
		</div>
		<div class="form">
			<form action="" method="POST">
				<textarea name="c_message" placeholder="Your message here..."></textarea><br />
				<input type="text" name="c_name" value="" placeholder="name" /><br />
				<input type="text" name="c_email" placeholder="E-mail" /><br />
				<input type="text" name="c_url" placeholder="URL (Optional)" /><br />
				<input type="submit" name="form1" value="Add Comment" alt="" style="width: 80px; height: 30px">
				<!-- <input type="image" src="images/button.gif" alt="" width="94" height="27" name="form1"> -->

			</form>
		</div>
	</div>
</div>



<?php include 'footer.php';?>



