<?php
session_start();
$file="dbconnect.php";
if (!file_exists($file))
{
header("Location: register/");	
}

include_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
 header("Location: login.php");
}

$query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=$query->fetch_array();

if(isset($_POST['publish'])) {
 
 $topic = strip_tags($_POST['topic']);
 $data = $_POST['data'];
 $query = "INSERT INTO sidebar(topic,data) VALUES('$topic','$data')";

  if ($DBcon->query($query)) {
 
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Your Sidebar was successfully created !
     </div>";
  
}
  
  else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while Sending data !
    Error: " . $query ."<br>" . $DBcon->error."
     </div>";
  }
 
 }
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
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       
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
        
        <li class="treeview">
          <a href="#"><i class="fa fa-folder"></i> <span>Media</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="addmedia.php"><i class="fa fa-circle"></i></i> Add Media</a></li>
            <li><a href="media.php"><i class="fa fa-circle"></i></i> Manage Media</a></li>
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
        Welcome to Dashboard
        <small>Change everything here...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
<?php 
							  if(isset($_POST['del']))
								{	
								$id = $_POST['id'];
								$sql = "DELETE FROM sidebar WHERE sidebar_id='$id'";

if ($DBcon->query($sql) === TRUE) {
   echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Your Sidebar Has been Successfully Deleated.
              </div>';
} else {
    echo "Error deleting record: " . $DBcon->error;
}
								}
								
							  ?>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Comments</span>
              <span class="info-box-number"><?php $query = $DBcon->query("SELECT * FROM comment");

						 $num=$query->num_rows;
						 echo $num;?><small></small></span>
            </div>
           </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Current Pages</span>
              <span class="info-box-number"><?php $query = $DBcon->query("SELECT * FROM page");

						 $num=$query->num_rows;
						 echo $num;?></span>
            </div>
          </div>
        </div>
    
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Posts Published</span>
              <span class="info-box-number"><?php $query = $DBcon->query("SELECT * FROM post");

						 $num=$query->num_rows;
						 echo $num;?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Members</span>
              <span class="info-box-number"><?php $query = $DBcon->query("SELECT * FROM users");

						 $num=$query->num_rows;
						 echo $num;?></span>
            </div>
          </div>
       </div>
        
        
      </div>
 <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Webkodes
                <small>Advanced website builder</small>
              </h3>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body pad">
            
            
            <h1>Welcome to Webkodes</h1>
            <br>
            <div style="display:inline;padding-left:50px;">
            <div style="float:left;margin-left:5%;">
            <h3>Make Your profile</h3>
            <button type="button" class="btn btn-block btn-primary btn-lg">Make Profile</button>
            <small>Change your profile data now.</small>
            </div>
            <div style="float:left;margin-left:5%;">
            <h3>Some Quick Links</h3>
            <a class="btn btn-app" href='createpage.php'>
                <i class="fa fa-files-o"></i>Create Page
              </a>
              <a class="btn btn-app" href='createpost.php'>
                <i class="fa fa-file-text-o"></i>Create Post
              </a>
              <a class="btn btn-app" href='adduser.php'>
                <i class="fa fa-user"></i>Add User
              </a><br>
              <a class="btn btn-app" href='uploadtemplate.php'>
                <i class="fa fa-laptop"></i>Add Template
              </a>
              <a class="btn btn-app" href='comments.php'>
                <i class="fa fa-envelope"></i>Comments
              </a>
              <a class="btn btn-app" href='addmedia.php'>
                <i class="fa fa-folder"></i>Add Media
              </a>
              </div>
            <div style="float:left;margin-left:5%;">
            <h3>Some Other Links</h3>
            <a class="btn btn-app" href='preview.php'>
                <i class="fa fa-desktop"></i>Preview
              </a>
              <a class="btn btn-app" href='settings.php'>
                <i class="fa fa-gears"></i></i>Settings
              </a>
              <a class="btn btn-app" href='mailusers.php'>
                <i class="fa fa-user"></i>Mail User
              </a><br>
            <a class="btn btn-app" href='pages.php'>
                <i class="fa fa-files-o"></i>Pages
              </a>
              <a class="btn btn-app" href='posts.php'>
                <i class="fa fa-file-text-o"></i>Posts
              </a>
              <a class="btn btn-app" href='users.php'>
                <i class="fa fa-user"></i>User
              </a>
            </div>
            
            </div>
            
            
			</form>
            </div>
          </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Latest Comments On Your Site</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Subject</th>
                  <th>Comment</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Post</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
               						   <?php

$sql = "SELECT * FROM comment ORDER By comment_id DESC LIMIT 0,5";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {
      echo '<tr>
                                 <td>'.$row["topic"].'</td>
                                 <td>'.$row["data"].'</td>
                                 <td>'.$row["name"].'</td>
                                 <td>'.$row["email"].'</td>
                                 <td>'.$row["post"].'</td>
                                 <td>'.$row["time"].'</td>
                                 <td><div class="btn-group"><form method="post" action="comments.php"> <input type="hidden" name="id" value="'.$row["comment_id"].'"><button class="btn btn-danger" name="del" >Delete</button></form></div></td>
                              </tr>  ';
    }

} 
?>
              </tbody></table>
</div>
            </div>
            
      <div class="row">
                  <div class="col-md-6">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Users</h3>
            </div>
            <form method="post" action="adduser.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">User's Name</label>
                  <input class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter name" type="text">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email" type="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" name="pass" placeholder="Password" type="password">
                </div>
                <div class="checkbox">
                  <label>
                     <input name="status" value="admin" type="radio"> Admin
                  </label>
				    <b>or </b> 
				   <label>
                     <input name="status" value="user" type="radio"> User
                  </label>
                </div>
				
              </div>
      
              <div class="box-footer">
                <button type="submit" name="btn-user" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		  </div>
		  
		  
		  <div class="col-md-6">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a SideBox</h3>
            </div>
            <form method="post">
              <div class="box-body">
              <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Topic</label>
                  <input class="form-control" id="exampleInputEmail1" name="topic" placeholder="Enter Topic" type="text">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Html or Text</label>
                  <textarea  name="data" class="form-control" style="height:140px;" placeholder="Your code or text to be put here"></textarea>
                </div>
                      </div>
      
              <div class="box-footer">
                <button type="submit" name="publish" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		  </div>

      </div>
     
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sidebars On Your Site</h3>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>Topic</th>
                  <th>Data</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
               						   <?php

$sql = "SELECT * FROM sidebar ORDER By sidebar_id DESC ";
$result = $DBcon->query($sql);

if ($result->num_rows >0) {
    while($row = $result->fetch_assoc())  {
      echo '<tr>
                                 <td>'.$row["topic"].'</td>
                                 <td>'.strip_tags($row["data"]).'</td>
                                 <td>'.$row["time"].'</td>
                                 <td><div class="btn-group"><form method="post"> <input type="hidden" name="id" value="'.$row["sidebar_id"].'"><button class="btn btn-danger" name="del" >Delete</button></form></div></td>
                              </tr>  ';
    }

} 
?>
              </tbody></table>
</div>
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
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
</body>
</html>
