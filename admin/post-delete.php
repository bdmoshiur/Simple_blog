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



		 $sql = "SELECT * FROM tbl_post WHERE post_id = $id ";
  		$result = mysqli_query($conn,$sql);
     	while($row = mysqli_fetch_assoc($result)) { 

				$real_path = "../uploads/".$row['post_image'];

				unlink($real_path);
		}

$sql = "DELETE FROM `tbl_post` WHERE `post_id`='$id' ";
		    mysqli_query($conn,$sql);

		     header("location: post-view.php");


?>