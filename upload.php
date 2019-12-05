<?php
require('connection.php');
$mysqli = new mysqli("localhost", "root", "", "poll3");

if(isset($_POST['btn-upload']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 
 move_uploaded_file($file_loc,$folder.$file);
 $sql="INSERT INTO documents(file,type,size) VALUES('$file','$file_type','$file_size')";
 echo $sql;
 die();
 mysql_query($sql); 
}
?>