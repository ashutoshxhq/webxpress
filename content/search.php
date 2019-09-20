<?php
if(isset($_POST['submit'])) {
 $q = $_POST['search'];
 }
else{
header("Location: index.php");
}

include_once '../admin/dbconnect.php';
$master="master";
$query = $DBcon->query("SELECT * FROM users WHERE type='$master'");
$userRow=$query->fetch_array();
$about = $userRow['about'];    
$website = $userRow['website'];
$fb = $userRow['facebook'];
$tw = $userRow['twitter'];
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!--
---- Clean html template by http://WpFreeware.com
---- This is the main file (index.html).
---- You are allowed to change anything you like. Find out more Awesome Templates @ wpfreeware.com
---- Read License-readme.txt file to learn more.
-->	

	<head>
		<title><?php echo $website; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Oswald Font -->
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
		<!-- home slider-->
		<link href="css/pgwslider.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="style.css" rel="stylesheet" media="screen">	
		<link href="responsive.css" rel="stylesheet" media="screen">		
	</head>

	<body>
	
		<section id="header_area">
			<div class="wrapper header">
				<div class="clearfix header_top">
					<div class="clearfix logo floatleft">
						<a href=""><h1><span><?php echo $website; ?></span></h1></a>
					</div>
					<div class="clearfix search floatright">
						<form action="search.php" method="post">
							<input type="text" name="search" placeholder="Search"/>
							<input type="submit"  name="submit" />
						</form>
					</div>
				</div>
				<div class="header_bottom">
					<nav>
						<ul id="nav">
							<li><a href="index.php">Home</a></li>
            <?php

$sql = "SELECT * FROM page";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {
     echo '<li><a href="page.php?id='.$row["page_id"].'">'.$row["topic"].'</a></li>';
    }

} 
?>
						</ul>
					</nav>
				</div>
			</div>
		</section>
		
		<section id="content_area">
			<div class="clearfix wrapper main_content_area">
			
				<div class="clearfix main_content floatleft">
				
					<div class="clearfix content">
						<div class="content_title"><h2>Latest Blog Post</h2></div>
						
						 <?php

$sql = "SELECT * FROM post WHERE data LIKE '%$q%' ORDER By post_id DESC";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {
     
$data=strip_tags($row["data"]);
$topic=$row["topic"];
$time=$row["time"];
$id=$row["post_id"];
$author=$row["author"];

echo '<div class="clearfix single_content">
							<div class="clearfix post_date floatleft">
								<h3>'.$id.'</h3>
								<p>POST</p>
							</div>
							<div class="clearfix post_detail">
								<h2><a href="post.php?id='.$id.'">'.$topic.' </a>
								</h2>
								<div class="clearfix post-meta">
									<p><span>Admin</span> <span>Published Date: '.$time.'</span> <span>'.$author.'</span> 										</p>
								</div>
								<div class="clearfix post_excerpt">
									<img src="../media/post_img/'.$topic.'.jpg" alt=""/>
									<p>'.$data.'</p>						</div>
								<a href="post.php?id='.$id.'">Continue Reading</a>
							</div>
						</div>';
    }

} 
?>

					
					</div>
					
				</div>
				<div class="clearfix sidebar_container floatright">
				
					<div class="clearfix newsletter">
						<form action="newsletters.php" method="post">
							<h2>Signup for newsletter</h2>
							<input type="text" placeholder="Name" name="name" id="mce-TEXT"/>
							<input type="email" placeholder="Email" name="email" id="mce-EMAIL"/>
							<input type="submit" value="Submit" name="submit" id="mc-embedded-subscribe"/>
						</form>
					</div>
					<div class="clearfix sidebar">
						<div class="clearfix single_sidebar">
							<div class="popular_post">
								<div class="sidebar_title"><h2>Latest Post</h2></div>
								<ul>
									  <?php

$sql = "SELECT * FROM post ORDER By post_id DESC LIMIT 0,10";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {

$topic=$row["topic"];
$id=$row["post_id"];


echo '<li><a href="post.php?id='.$id.'">'.$topic.' </a></li>';

    }

} 
?>

								</ul>
							</div>
							</div>
						<?php

$sql = "SELECT * FROM sidebar ORDER By sidebar_id DESC LIMIT 0,10";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {

$topic=$row["topic"];
$data=$row["data"];


echo '<div class="clearfix newsletter">
						<form>
							<h2>'.$topic.'</h2>
							<p> '.$data.'</p>
						</form>
					</div>';

    }

} 
?>
					</div>
				</div>
			</div>
		</section>
		
		<section id="footer_bottom_area">
			<div class="clearfix wrapper footer_bottom">
				<div class="clearfix copyright floatleft">
					<p> Copyright &copy; All rights reserved by <span><?php echo $website; ?></span></p>
				</div>
				<div class="clearfix social floatright">
					<ul>
						<li><a class="tooltip" title="Facebook" target="_blank" href="http://<?php echo $fb; ?>"><i class="fa fa-facebook-square"></i></a></li>
						<li><a class="tooltip" title="Twitter" target="_blank" href="http://<?php echo $tw; ?>"><i class="fa fa-twitter-square"></i></a></li>
						</ul>
				</div>
			</div>
		</section>
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>	
		<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.tooltip').tooltipster();
			});
		</script>
		 <script type="text/javascript" src="js/selectnav.min.js"></script>
		<script type="text/javascript">
			selectnav('nav', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
		</script>		
		<script src="js/pgwslider.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.pgwSlider').pgwSlider({
					
					intervalDuration: 5000
				
				});
			});
		</script>
		<script type="text/javascript" src="js/placeholder_support_IE.js"></script>
		
<!--
---- Clean html template by http://WpFreeware.com
---- This is the main file (index.html).
---- You are allowed to change anything you like. Find out more Awesome Templates @ wpfreeware.com
---- Read License-readme.txt file to learn more.
-->	
		
	</body>
</html>
