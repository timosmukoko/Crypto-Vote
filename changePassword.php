
<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">ONLINE VOTING</a></h1>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li ><a href="voter.php">Home</a></li>
        <li class="active"><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li ><a href="vote.php">Vote</a></li>
            <li class="active"><a href="manage-profile.php">View profile</a></li>
			<li><a href="viewcandidates.php">View Candidates</a></li>
			<li><a href="viewparties.php">View Parties</a></li>
			<li><a href="electionResults.php">View Election Results</a></li>
          </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Change <a href="#">Password</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>


<div  >
  <?php
  
	ini_set ("display_errors", "1");
	error_reporting(E_ALL);
	ob_start();

    session_start();
  	require('connection.php');
    $mysqli = new mysqli("localhost", "root", "", "poll3");
	if(empty($_SESSION['member_id'])){
	  header("location:access-denied.php");
    } 
  	//Process
  	if (isset($_POST['submit']))
  	{
  		$password = $_POST['password']; 
  		$newPassword = $_POST['newPassword'];
		$ConfirmPassword = $_POST['ConfirmPassword'];		
		
		if($newPassword != $ConfirmPassword)
		{
			echo "New Password and Confirm New Password doesn't match";
			die();
		}
		if($newPassword == "")
		{
			echo "New Password not filled";
			die();
		}
		if($ConfirmPassword == "")
		{
			echo "Confirm Password not filled";
			die();
		}
  		
  		$newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash


      $sql = "SELECT * from tbmembers WHERE member_id='" . $_SESSION['member_id'] . "'";
	  $result = $mysqli->query($sql);
	  $row=mysqli_fetch_array($result);
	  
	  $encrypted_mypassword=sha1($password); //SHA1 Hash for security
	  if($encrypted_mypassword == $row["password"]) {
		$newpass = md5($newPassword);	
		$result = $mysqli->query("UPDATE tbmembers set password='" . $newpass . "' WHERE member_id='" . $_SESSION['member_id'] . "'");
		echo "Password Changed";
		}
	  else
	  {
		  echo "Current Password is not correct";
		  die();
	  }
      
      $sql = "INSERT INTO tbMembers(first_name, last_name, email, voter_id, password) VALUES ('$myFirstName','$myLastName', '$myEmail','$myVoterid', '$newpass')";
		$result= $mysqli->query($sql) or die(mysqli_error());
		die("You have registered for an account.Please wait for an admin to approve it. <a href='registeracc.php'>Register</a> or <a href='login.php'>Login</a>");
	
	  
  	}
  	echo "<center><h3>Fill in the following information to change password:</h3></center>";
  ?>
</div> 
		<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" action="changePassword.php" onSubmit="return validatePassword(this)">
<td>
<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >

	<tr>
	<td style="color:#000000"; >Old Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="password" type="password" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; >New Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="newPassword" type="password" ></td>
	</tr>
	
	<tr>
	<td style="color:#000000"; >Confirm New Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="ConfirmPassword" type="password" ></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td style="color:#000000";><input type="submit" name="submit" value="Change Password"></td>
	</tr>

</table>
</td>
</form>
</tr>
</table>


        </blockquote>
      
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>