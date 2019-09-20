<?php
include_once '../admin/dbconnect.php';
$master="master";
$query = $DBcon->query("SELECT * FROM users WHERE type='$master'");
$userRow=$query->fetch_array();
$about = $userRow['about'];    
$website = $userRow['website'];
$name = $userRow['name'];

$id = $_GET['id'];
if(!isset($id))
{
 header("Location: index.php");
}
$querry = $DBcon->query("SELECT * FROM page WHERE page_id='$id'");
$post=$querry->fetch_array();
$topic=$post['topic'];
$data=$post['data'];
$time=$post['time'];
$author=$post['author'];

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
						<div class="content_title"><h2><?php echo $topic; ?></h2></div>
						<div class="single_work_page clearfix">
							<div class="work_single_page_feature"><img style="width:100%;" src="../media/page_img/<?php echo $topic; ?>.jpg"/></div>
							<div class="work_meta clearfix">
								<p class="floatleft"> Published on: <span><?php echo $time; ?></span>Author:  <span> <?php echo $author; ?></span></p>
								<a class="floatright" href="../media/page_img/<?php echo $topic; ?>.jpg" target="_blank">Preview</a>
							</div>
							<div class="single_work_page_content">
								<p><?php echo $data; ?></p>
								
							</div>
							
						</div>
							
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
		
<!--

This Template is designed by WpFreeware.com Team, You are allowed to change anything you like.
Find out More Awesome template at http://www.WpFreeware.com.

-->	

	</body>
</html>
