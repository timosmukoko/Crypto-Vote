<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user-1.js">
</script>

</head>
<body id="top">


<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">ONLINE VOTING</a></h1>
    </div>

	<nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="index.php">Home</a></li>
		<li class="active"><a href="http://localhost/votingPoll3/index.php">Welcome Page</a></li>
      </ul>
    </nav>
  
  </header>
</div>




<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Online <a href="#">Voting</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        

      	<div >
		<h1>Invalid Credentials Provided </h1>

		</div>

		<div>


<?php
//session_start();
ini_set ("display_errors", "1");
error_reporting(E_ALL);

ob_start();
session_start();
require('connection.php');

$tbl_name="tbadministrators"; // Table name


$username=$_POST['username'];
$mypassword=$_POST['mypassword'];
$encrypted_mypassword=md5($mypassword); 

$mysqli = new mysqli("localhost", "root", "", "poll3");

$username = stripslashes($username);
$mypassword = stripslashes($mypassword);
$username = $mysqli->escape_string($_POST['username']);
$mypassword = $mysqli->escape_string($_POST['mypassword']);

$sql="SELECT * FROM $tbl_name WHERE email='$username' and password='$encrypted_mypassword'" or die(mysql_error());
$result= $mysqli->query($sql);


$count=mysqli_num_rows($result);


if($count==1){
    // $user = $result->fetch_assoc();
    // $_SESSION['admin_id'] = $user['admin_id'];
    
                if(isset($_POST['remember']))
                {
                    setcookie('$email',$_POST['username'], time()+30*24*60*60); // 30 days
                    setcookie('$pass', $_POST['mypassword'],time()+30*24*60*60); // 30 days
                    $_SESSION['curname']=$username;
                    $_SESSION['curpass']=$mypassword;

                    $user = $result->fetch_assoc();
     				$_SESSION['admin_id'] = $user['admin_id'];

                    header("Location:admin.php");
                    exit;
                }
                else
                {
                    $log1=11;
                    $_SESSION['log1'] = $log1;
                    $_SESSION['curname']=$username;
                    $_SESSION['curpass']=$mypassword;

                    $user = $result->fetch_assoc();
     				$_SESSION['admin_id'] = $user['admin_id'];

                    header("Location:authority-manage.php");
                    exit;
                }
            

}
else {
    echo " <blockquote><h3>Wrong Username or Password<br>Return to <a href=\"index.php\">login</a> </h3></blockquote>";
}

ob_end_flush();

?> 
		</div>

      
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>

<?php include 'footer.php'; ?>