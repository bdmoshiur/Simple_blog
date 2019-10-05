<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard-Sample Blog With PHP</title>
	<link rel="stylesheet" href="../style-admin.css">
	
	<script type="text/javascript">
		function confirmDelete() {
			return confirm("Do you sure want to delete this data?");
		}
	</script>
	<!-- Fancybox jQuery -->
	<script type="text/javascript" src="../fancybox/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="../fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="../fancybox/main.js"></script>
	<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox.css" />
	<!-- //Fancybox jQuery -->
	<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>

	

</head>
<body>
	<div id="wrapper">
		<div id="header">
			<h1>Admin Panel Dashboard</h1>
		</div>
		<div id="container">
			<div id="sidebar">
				<h2>Page Options</h2>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="change-footer-text.php">Change Footer text</a></li>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				<h2>Blog Options</h2>
				<ul>
					<li><a href="post-add.php">Add Post</a></li>
					<li><a href="post-view.php">View post</a></li>
					<li><a href="manage-category.php">Manage category</a></li>
					<li><a href="manage-tag.php">Manage Tags</a></li>
				</ul>
				<h2>Comment Section</h2>
				<ul>
					<li><a href="comment-approve.php">View Comments</a></li>
					
				</ul>
			</div>
			<div id="content">
