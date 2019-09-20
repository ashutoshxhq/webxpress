<?php
session_start();
$file="dbconnect.php";
if (!file_exists($file))
{
header("Location: register/");	
}

require_once 'dbconnect.php';

if (isset($_SESSION['user'])!="") {
 header("Location: index.php");
 exit;
}

if (isset($_POST['login'])) {
 
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['pass']);
 
 $email = $DBcon->real_escape_string($email);
 $password = $DBcon->real_escape_string($password);
 
 $query = $DBcon->query("SELECT * FROM users WHERE email='$email'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows;
 
 if($row['type']=='master' or $row['type']=='admin' ){
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['user'] = $row['user_id'];
  header("Location: index.php");
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
 
}
else{
 $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; You are not authorised to enter !
    </div>";
} 
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Webkodes| Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/webxpress.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>WEB</b>XPRESS</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
    <form method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <input type="submit" name="login" class="btn btn-primary btn-block btn-flat" value="Sign In" >
        </div>
      </div>
    </form>

    </div>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' 
    });
  });
</script>
</body>
</html>
