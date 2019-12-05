
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
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="authority-manage.php">Home</a></li>
		<li><a href="registeracc.php">Register voter/Candidate</a>
                <li><a href="manage-members.php">Manage Members</a>    
		
        <!-- <li><a href="http://localhost/online_voting/index.php">Voter Panel</a></li> -->
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
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Voter & Candidate <a href="#">Registration</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>


<div  >
  <?php
  	require('connection.php');
    $mysqli = new mysqli("localhost", "root", "", "poll3");
	$min = 1000;
	//The max / largest number.
	$max = 9000;
 
  	//Process
  	if (isset($_POST['submit']))
  	{

  		$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
  		$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
  		$myEmail = $_POST['email'];
  		$myPassword = $_POST['password'];
  		$myVoterid = $_POST['voter_id'];
		$isCandidate = $_POST['is_candidate'];
  		$newpass = sha1($myPassword); //This will make your password encrypted into SHA1, a high security hash
		//Generate a random number using the rand function.
		$pin = mt_rand($min, $max);

      $sql="SELECT * FROM tbmembers WHERE voter_id='$myVoterid'" or die(mysqli_error());
      $result= $mysqli->query($sql) or die(mysqli_error());

      // Checking table row
      $count=mysqli_num_rows($result);
      // If username and password is a match, the count will be 1

      if($count>0){
        die( "This Voter ID Number is linked to some other account.<br><br>Try again <a href=\"registeracc.php\">Register</a>" );
      }
	  else if($_POST['is_candidate'] = 1)
	  {
		$sql = "INSERT INTO tbmembers(first_name, last_name, email, voter_id, password, voter_pin, is_candidate) VALUES ('$myFirstName','$myLastName', '$myEmail','$myVoterid', '$newpass', '$pin', $isCandidate)";
		$result= $mysqli->query($sql) or die(mysqli_error());
		die("You have registered members for an account. Election Authority will approve it.");
	  }	  
	  else
	  {
		$sql = "INSERT INTO tbmembers(first_name, last_name, email, voter_id, password, voter_pin) VALUES ('$myFirstName','$myLastName', '$myEmail','$myVoterid', '$newpass', '$pin')";
		$result= $mysqli->query($sql) or die(mysqli_error());
		die("You have registered voter for an account. Election Authority will approve it.");
	  }
  	}
  	echo "<center><h3>Register an account by filling in the needed information below:</h3></center>";
  ?>
</div> 
		<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" action="registeracc.php" onSubmit="return registerValidate(this)">
<td>
<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
	<td style="color:#000000"; width="120" >First Name</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="firstname" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="120" >Last Name</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="lastname" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="150" >Email</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="email" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; width="120" >Voter ID Number</td>
	<td style="color:#000000"; width="6">:</td>
	<!--td style="color:#000000"; width="294"><input name="voter_id" type="text" ></td-->
	<td style="color:#000000"; width="294"><input name="voter_id" type="text" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; >Is Candidate ?</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><select name="is_candidate">
		<option value="0">0</option>
		<option value="1">1</option>
		
	</select></td>
	</tr>
	
	<tr>
	<td style="color:#000000"; >Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="password" type="password" ></td>
	</tr>

	<tr>
	<td style="color:#000000"; >Confirm Password</td>
	<td style="color:#000000"; >:</td>
	<td style="color:#000000"; ><input name="ConfirmPassword" type="password" ></td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td style="color:#000000";><input type="submit" name="submit" value="Register Account"></td>
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