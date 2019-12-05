
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
		<li><a href="registeracc.php">Register voters</a>
		<li><a href="candidateregister.php">Register Candidates</a> 
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
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Candidate <a href="#">Registration</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>


<div  >
  <?php
  	require('connection.php');
    $mysqli = new mysqli("localhost", "root", "", "poll3");
	$min = 100;
	$max = 900;
  	//Process
  	if (isset($_POST['submit']))
  	{

  		$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
  		$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
  		$myEmail = $_POST['email'];
  		$myPassword = $_POST['password'];
  		$myVoterid = $_POST['voter_id'];
		//$myParty = $_POST['party_name'];
		$pin = mt_rand($min, $max);
		
  		$newpass = sha1($myPassword); //This will make your password encrypted into SHA-1, a high security hash


      $sql="SELECT * FROM tbmembers WHERE voter_id='$myVoterid'" or die(mysqli_error());;
      $result= $mysqli->query($sql) or die(mysqli_error());

      // Checking table row
      $count=mysqli_num_rows($result);
      // If username and password is a match, the count will be 1

      if($count>0){
        die( "This Voter ID Number is linked to some other account.<br><br>Try again <a href=\"candidateregister.php\">Register</a>" );
      }
	    //$filename  = basename($_FILES['image']['name']);
		//$extension = pathinfo($filename, PATHINFO_EXTENSION);
		//$new       = SHA1($filename).'.'.$extension;
		//$insertname = "uploads/".time()."-{$new}";
		//move_uploaded_file($_FILES['image']['tmp_name'], $insertname);
		else
		{
		$isCandidate = 1;
  		$sql="INSERT INTO tbmembers(first_name, last_name, email, voter_id, password, is_candidate, pin_number) VALUES ('$myFirstName','$myLastName', '$myEmail','$myVoterid', '$newpass', '$isCandidate', '$pin')";
		$result = $mysqli->query($sql)  or die(mysqli_error());
		die( "You have registered a Candidate for an account. Election Authority will approve it." );
		//$result = $mysqli->query("UPDATE `tbmembers` SET `is_candidate` = '1' WHERE `tbmembers`.`voter_id` = '$myVoterid'");
		
		$result = $mysqli->query( "SELECT member_id from tbMembers where voter_id='$myVoterid' and is_candidate='1'" );
        $count=mysqli_num_rows($result);
      
	    //$curr_member_id = 1;	
		//if($count == 1){
        //  $user = mysqli_fetch_assoc($result);
		//  $curr_member_id = $user['member_id'];
	   // }
		
	    //$result = $mysqli->query( "SELECT party_id from party where party_name='$myParty'" );
        //$count=mysqli_num_rows($result);
      
	    //$curr_party_id = 1;
		//if($count == 1){
        // $user = mysqli_fetch_assoc($result);
		//  $curr_party_id = $user['party_id'];
	   //}
	   
	  // $result = $mysqli->query( "INSERT INTO tbcandidates(member_id, party_id, file_name) VALUES ('$curr_member_id','$curr_party_id','$insertname')" );   
		//or die( mysqli_error() );
		
		}
	}
  	echo "<center><h3>Register an account by filling in the needed information below:</h3></center>";
  ?>
</div> 
		<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" enctype="multipart/form-data" action="candidateregister.php" onSubmit="return registerValidate(this)">
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
		<td style="color:#000000"; width="40%">Party Name</td>
		<td style="color:#000000"; width="6">:</td>
		<td style="color:#000000"; >
			<select name="party_name" style="width: 94%">
				<?php
					$result = $mysqli->query("SELECT * FROM party WHERE 1");
					while ($row = mysqli_fetch_array($result)){
						echo "<option value='".$row['party_id']."'>".$row['party_name']."</option>";
					}
				?>
			</select>
		</td>
	</tr>


	
	<tr>
	<td style="color:#000000"; width="120" >Candidate ID</td>
	<td style="color:#000000"; width="6">:</td>
	<td style="color:#000000"; width="294"><input name="voter_id" type="text" ></td>
	</tr>

	<tr>
		<td style="color:#000000"; >Candidate ID Image</td>
		<td style="color:#000000"; >:</td>
		<td style="color:#000000"; ><input type="file" name="image"></td>
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