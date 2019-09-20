<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
 header("Location: login.php");
}

$query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=$query->fetch_array();


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Webkodes | Hi' <?php echo $userRow['name']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/font/css/font-awesome.css">
  <link rel="stylesheet" href="bootstrap/font/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/webxpress.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="index.php" class="logo">
      <span class="logo-mini"><b>W</b>X</span>
      <span class="logo-lg"><b>WEB</b>XPRESS</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $userRow['email']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $userRow['name']; ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="settings.php" class="btn btn-default btn-flat">Settings</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" name="logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        <ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $userRow['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

     
      <ul class="sidebar-menu">
        <li class="header">Navigation Menu</li>
        <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       
       <li class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="createpost.php"><i class="fa fa-circle"></i></i> Create Post</a></li>
            <li><a href="posts.php"><i class="fa fa-circle"></i></i> Manage Post</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-files-o"></i> <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="createpage.php"><i class="fa fa-circle"></i></i> Create Page</a></li>
            <li><a href="pages.php"><i class="fa fa-circle"></i></i> Manage Pages</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="adduser.php"><i class="fa fa-circle"></i></i> Add User</a></li>
            <li><a href="users.php"><i class="fa fa-circle"></i></i> Manage Users</a></li>
            <li><a href="mailusers.php"><i class="fa fa-circle"></i></i> Mail Users</a></li>
          </ul>
        </li>
       
        <li class="active" class="treeview">
          <a href="#"><i class="fa fa-folder"></i> <span>Media</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addmedia.php"><i class="fa fa-circle"></i></i> Add Media</a></li>
            <li class="active"><a href="media.php"><i class="fa fa-circle"></i></i> Manage Media</a></li>
          </ul>
        </li>
        
        <li><a href="comments.php"><i class="fa fa-envelope"></i> <span>Comments</span></a></li>
         <li><a href="templates.php"><i class="fa fa-desktop"></i> <span>Templates</span></a></li>
       <li><a href="preview.php"><i class="fa fa-desktop"></i> <span>Preview</span></a></li>
        <li><a href="settings.php"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
       
      </ul>
    </section>
    </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Mange Media
        <small>Manage your media here...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mange Media</li>
      </ol>
    </section>

    <section class="content">

      <?php 
							  if(isset($_POST['del']))
								{	
								$id = $_POST['id'];
								
								unlink($id);
   echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Your Media Has been Successfully Deleated.
              </div>';		
              
              
              }
								
							  ?>
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Media On Your Site</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>File Name with link</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
               						   <?php

$files = glob("../media/uploads/*.*");
for ($i=0; $i<count($files); $i++)
{
$num = $files[$i];
	
 echo '<tr>
                                 <td>'.$num.'</td>
                                 <td>Media Upload</td>
                                 <td><div class="btn-group"><form method="post"> <input type="hidden" name="id" value="'.$num.'"><button class="btn btn-danger" name="del" >Delete</button></form></div></td>
                              </tr>  ';	
}
      
?>
<?php

$files = glob("../media/page_img/*.*");
for ($i=0; $i<count($files); $i++)
{
$num = $files[$i];
	
 echo '<tr>
                                 <td>'.$num.'</td>
                                 <td>Image on page</td>
                                 <td><div class="btn-group"><form method="post"> <input type="hidden" name="id" value="'.$num.'"><button class="btn btn-danger" name="del" >Delete</button></form></div></td>
                              </tr>  ';	
}
      
?>
<?php

$files = glob("../media/post_img/*.*");
for ($i=0; $i<count($files); $i++)
{
$num = $files[$i];
	
 echo '<tr>
                                 <td>'.$num.'</td>
                                 <td>Image on post</td>
                                 <td><div class="btn-group"><form method="post"> <input type="hidden" name="id" value="'.$num.'"><button class="btn btn-danger" name="del" >Delete</button></form></div></td>
                              </tr>  ';	
}
      
?>
              </tbody></table>
            </div>
        
     
      
      

    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Version 1.0.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://webkodes.com">Webkodes</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
</body>
</html>
