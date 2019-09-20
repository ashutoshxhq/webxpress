<?php
session_start();

$file="../dbconnect.php";
if (file_exists($file))
{
header("Location: ../login.php");
}


if(isset($_POST['btn-signup'])) {
 
 $name = $_POST['n'];
 $email = $_POST['e'];
 $pass = $_POST['p'];
 $web = $_POST['web'];
 $dname = $_POST['d'];
 $dserver = $_POST['ds'];
 $duser = $_POST['du'];
 $duserpass = $_POST['dup'];
 $status="master";
  
 $txt='<?php

  $DBhost = "'.$dserver.'";
  $DBuser = "'.$duser.'";
  $DBpass = "'.$duserpass.'";
  $DBname = "'.$dname.'";
  
  $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);
     }
     
?>
';
$myfile = fopen("../dbconnect.php", "w") or die("Unable to open file!");
fwrite($myfile,$txt);
fclose($myfile);

include_once '../dbconnect.php';
 
 
 $DBcon->query("CREATE TABLE `comment` (
  comment_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  topic varchar(500) NOT NULL,
  data longtext NOT NULL,
  email varchar(500) NOT NULL,
  name varchar(500) NOT NULL,
  post varchar(500) NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

 $DBcon->query("CREATE TABLE `page` (
  page_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  author varchar(500) NOT NULL,
  topic varchar(500) NOT NULL,
  data longtext NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

 $DBcon->query("CREATE TABLE post (
  post_id int(200) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  author varchar(200) NOT NULL,
  topic varchar(550) NOT NULL,
  data longtext NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

 $DBcon->query("CREATE TABLE sidebar (
  sidebar_id int(200) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  topic varchar(500) NOT NULL,
  data longtext NOT NULL,
  time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

 $DBcon->query("CREATE TABLE users (
  user_id int(150) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  email varchar(80) NOT NULL,
  password mediumtext NOT NULL,
  facebook varchar(80) NULL,
  twitter varchar(80) NULL,
  about longtext NULL,
  type varchar(50) NOT NULL,
  website varchar(500) NOT NULL,
  tagline varchar(500) NULL,
  location varchar(500) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1");
 
 
 $uname = $DBcon->real_escape_string($name);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($pass);
 
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); 
 $check_email = $DBcon->query("SELECT email FROM users WHERE email='$email'");
 $count=$check_email->num_rows;
 
 if ($count==0) {
  
  $query = "INSERT INTO users(name,email,password,type,website) VALUES('$uname','$email','$hashed_password','$status','$web')";

  if ($DBcon->query($query)) {
  
  header("Location: ../login.php");
  
  }else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering ! " . $query ."<br>" . $DBcon->error."
     </div>";
  }
  
 } else {
  
  
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
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
  <title>webxpress | Registration Page</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/font/css/font-awesome.css">
  <link rel="stylesheet" href="../bootstrap/font/css/font-awesome.min.css">
  <link rel="stylesheet" href="../https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/webxpress.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Install </b> webxpress</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>
    <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>

    <form role="form" method="post">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Your Name" name="n" />
                                        </div>
                                         <div class="form-group input-group">
                                             <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Your Email" name="e" />
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Enter Password" name="p" />
                                        </div>
										 <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Database User" name="du" />
                                        </div>
                                    <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Database Server" name="ds" />
                                        </div>
										<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Database User Password" name="dup" />
                                        </div>
                                     
                                    <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Database Name" name="d" />
                                        </div>
                                    <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Website" name="web" />
                                        </div>
                                     
                                     <button name="btn-signup" class="btn btn-success ">Register Me</button>
                                    <hr />
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
