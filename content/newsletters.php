<?php
session_start();

include_once '../admin/dbconnect.php';

if(isset($_POST['submit'])) {
 
 $name = strip_tags($_POST['name']);
 $email = strip_tags($_POST['email']);
 $query = "INSERT INTO users(name,email) VALUES('$name','$email')";

  if ($DBcon->query($query)) {
 $_SESSION['error'] = "<font color='green'>You have been added for newsletters.</font>";
  header("Location: index.php");
}
else{
$_SESSION['error'] = "<font color='red'>Email might be already registered.</font>";
  header("Location: index.php");
}
}
?>
