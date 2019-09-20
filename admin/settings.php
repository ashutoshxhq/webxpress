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
        <li class="active"><a href="settings.php"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
       
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Settings
        <small>Change everything here...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>

    <section class="content">

      
      <?php
											  
												if(isset($_POST['profile']))
												{
												 
												 $name = $_POST['name'];
												 $email = $_POST['email'];
												 $website = $_POST['website'];
												 $tline = $_POST['tagline'];
												 $about = $_POST['about'];
												 $location = $_POST['location'];
												 $facebook = $_POST['facebook'];
												 $twitter = $_POST['twitter'];
												 $query= "UPDATE users SET name='$name' ,email='$email', about='$about',website='$website', tagline='$tline', location='$location', facebook='$facebook', twitter='$twitter' WHERE user_id=".$_SESSION['user'];
												  if ($DBcon->query($query)) 
												 {
												echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
               Success! Data successfully updated to the server. Please refresh the page to see the changes.
              </div>';

												}
												 else
												 {
											echo	'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
               Sorry! we could not update your information
              </div>';

												}
												}
											  ?>
  
  
  
      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="dist/img/avatar5.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $userRow['name']; ?></h3>

              <p class="text-muted text-center"><?php echo $userRow['email']; ?></p>
			</div>
    		<div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Website</strong>

              <p class="text-muted">
               <?php echo $userRow['website']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"> <?php echo $userRow['location']; ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Tagline</strong>

              <p>
               <?php echo $userRow['tagline']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>

              <p><?php echo $userRow['about']; ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="nav-tabs-custom" style="padding-right:15px;">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Update Info</a></li>
            </ul>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" method="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="name" id="inputName" value="<?php echo $userRow['name']; ?>" placeholder="Name" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?php echo $userRow['email']; ?>" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Website</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="website" id="inputName" value="<?php echo $userRow['website']; ?>" placeholder="Website" type="text">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tagline</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="tagline" id="inputName" value="<?php echo $userRow['tagline']; ?>" placeholder="Tagline" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">About</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" name="about" id="inputExperience" placeholder="About"><?php echo $userRow['about']; ?></textarea>
                    </div>
                  </div>
				 
				  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Location</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="location" id="inputSkills" value="<?php echo $userRow['location']; ?>" placeholder="Location" type="text">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Facebook</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="facebook" id="inputName" value="<?php echo $userRow['facebook']; ?>" placeholder="Facebook URL" type="text">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Twitter</label>

                    <div class="col-sm-10">
                      <input class="form-control" name="twitter" id="inputName" value="<?php echo $userRow['twitter']; ?>" placeholder="Twitter Url" type="text">
                    </div>
                  </div>
				 
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="profile" class="btn btn-danger">Submit</button><br><br>
                    </div>					
                  </div>
                </form>
              </div>
            </div>
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
<script src="dist/js/app.min.js"></script>
</body>
</html>
