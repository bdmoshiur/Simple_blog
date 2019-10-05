<?php include 'config.php'; ?>

</div>
<div id="sidebar">
   <div id="search">
	<input type="text" value="Search"> <a href="#"><img src="images/go.gif" alt="" width="26" height="26" /></a>																										
	</div>
	<div class="list">
		<img src="images/title1.gif" alt="" width="186" height="36" />
		<ul>
			<?php
			$sql = "SELECT * FROM `tbl_category`ORDER BY cat_name ASC";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result)) { 
				?>
				<li><a href="category.php?id=<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></a></li>
			<?php

				}
			?>
			
		</ul>
		<img src="images/title2.gif" alt="" width="180" height="34" />



		<?php
			$sql = "SELECT DISTINCT(post_date) FROM `tbl_post`ORDER BY post_date DESC";
			$result = mysqli_query($conn,$sql);
				$j = 0;
			while($row = mysqli_fetch_assoc($result)) { 
				
						
							$yearMonth = substr($row['post_date'], 0,7);
							$arr_date[$j] = $yearMonth;
							$j++;
	
				}

				$result = array_unique($arr_date); 
				$final_val = implode(",",$result );
				 $final_Arr_date = explode(",", $final_val);

				 	$final_Arr_count = count($final_Arr_date);

				 	
			?>


		<ul>
			<?php

				for ($j=0; $j <$final_Arr_count ; $j++) { 
				 		 $final_Arr_date[$j];
				 		$year = substr($final_Arr_date[$j], 0,4);
				 		$month = substr($final_Arr_date[$j], 5,2);

				 				if ($month == '01') { $month_full = "January";}
								if ($month == '02') { $month_full = "February";}
								if ($month == '03') { $month_full = "March";}
								if ($month == '04') { $month_full = "April";}
								if ($month == '05') { $month_full = "May";}
								if ($month == '06') { $month_full = "June";}
								if ($month == '07') { $month_full = "July";}
								if ($month == '08') { $month_full = "August";}
								if ($month == '09') { $month_full = "September";}
								if ($month == '10') { $month_full = "October";}
								if ($month == '11') { $month_full = "November";}
								if ($month == '12') { $month_full = "Decmber";}

					?>

							<li><a href="archive.php?date=<?php echo $final_Arr_date[$j]; ?>"><?php echo $month_full. ' '.$year; ?></a></li>

	
							<?php
								 }
				 
							?>
			
		</ul>

	</div>
</div>
</div>
<div id="footer">
<p>
		<?php 
			
			$sql = "SELECT * FROM `tbl_footer` WHERE `id`= 1 ";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result)) { 
				$description = $row['description'];
				echo $description;
			}
		?>
</p>				
</div>
</body>
</html>
