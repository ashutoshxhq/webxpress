<?php
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
 header("Location: login.php");
}

$query = $DBcon->query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=$query->fetch_array();

if(isset($_POST['publish'])) {
 
 $topic = strip_tags($_POST['topic']);
 $data = $_POST['data'];
 $author = $userRow['name']; 
 $query = "INSERT INTO post(topic,data,author) VALUES('$topic','$data','$author')";

  if ($DBcon->query($query)) {
  
  $errors= array();
  $file_name = $_FILES['upload']['name'];
 $file_size =$_FILES['upload']['size'];
  $file_tmp =$_FILES['upload']['tmp_name'];
  $file_type=$_FILES['upload']['type'];
$file_ext=strtolower(end(explode('.',$_FILES['upload']['name'])));
 
											  $expensions= array("gif","jpeg","jpg","png","tif");
											  
											  if(in_array($file_ext,$expensions)=== false){
												 $errors[]="extension not allowed";
											  }
											  
											  if($file_size > 10097152){
												 $errors[]='File size must be less than 10 MB';
											  }
											  
											  if(empty($errors)==true){
												move_uploaded_file($file_tmp,"../media/post_img/".$topic.".jpg");
                                        
											  }
    
  
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Your data is successfully posted !
     </div>";
  
  
  
  
}
  
  else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while posting data !
    Error: " . $query ."<br>" . $DBcon->error."
     </div>";
  }
  
 $DBcon->close();
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/webxpress.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
       
       <li class="active" class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="createpost.php"><i class="fa fa-circle"></i></i> Create Post</a></li>
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
       Create Your Post 
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Post</li>
      </ol>
    </section>

    <section class="content">

      
      <div class="row">
      
      <div class="col-md-9" style="margin-left:12%;">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Post</h3>
            </div>
            <form method="post" enctype="multipart/form-data">
          
            <div class="box-body"><?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
              <div class="form-group">
                <input class="form-control" name="topic" placeholder="Topic of post:">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" name="data" class="form-control" style="height: 300px">
                      
                    </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Header Image
                  <input type="file" name="upload" id="myFile">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" name="publish" class="btn btn-primary"><i class="fa fa-file-text-o"></i> Publish</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div>
          </div>
        </form>
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
<script>
  $(function () {
    $("#compose-textarea").wysihtml5();
  });
</script>
</body>
</html>
