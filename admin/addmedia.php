<?php
session_start();
include_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
 header("Location: login.php");
}

$query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=$query->fetch_array();

  if(isset($_FILES['fileToUpload']))
								  {
										
										$target_dir = "../media/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
       $msg= '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
              Data Successfully uploaded<br> Use it from this address: '.$target_file.'</div>';
    } else {
        $msg= "Sorry, there was an error uploading your file.";
   
}
										
								   }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>webxpress | Hi' <?php echo $userRow['name']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="bootstrap/font/css/font-awesome.css">
  <link rel="stylesheet" href="bootstrap/font/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/webxpress.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
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
            <li class="active"><a href="addmedia.php"><i class="fa fa-circle"></i></i> Add Media</a></li>
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
        Upload Media
        <small>Upload your media here...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Upload Media</li>
      </ol>
    </section>

   <section class="content">

      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Upload Media
                <small>Upload your media here...</small>
              </h3>
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body pad">
             If you are creating a post which uses a file to download you can upload it here and use it in any post you like. After you upload we provide you a link which you can use to 
             give your readers downloadables.
			</form>
            </div>
          </div>

		  
		  <div class="row">
		  <div class="col-md-6">
		  <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Upload New File</h3>
            </div>
             <form enctype="multipart/form-data" method="post" >
              <div class="box-body"><?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
                <div class="form-group">
                 <input id="uploadFile" placeholder="Choose File" disabled="disabled" />
				<div class="fileUpload btn btn-primary">
					<span>Upload</span>
					<input id="fileToUpload" name="fileToUpload" type="file" class="upload" />
				</div>
                  <p class="help-block">You can upload any type of file except php,html or any other web programing file.  </p>
                </div>
              </div>
           
              <div class="box-footer">
                <button type="submit" name="fileToUpload" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
		  
		  </div>
		  </div>

		  

    </section>
   </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Version 1.0.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://webxpress.com">webxpress</a>.</strong> All rights reserved.
  </footer>
</div>
  
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script>
document.getElementById("fileToUpload").onchange = function () {
    document.getElementById("uploadFile").value = this.value;
};
</script>
</body>
</html>
