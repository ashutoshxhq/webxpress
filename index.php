<?php
$file="admin/dbconnect.php";
if (!file_exists($file))
{
header("Location: admin/register/");	
}

else
{
header('Location:content/');
}
?>
