
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
   



	<nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="checklogin.php">Home</a></li>
        
        <li><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="registeracc.php">Registration</a></li>
           
          </ul>
        </li>
        
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
			ini_set ("display_errors", "1");
			error_reporting(E_ALL);
			ob_start();

			session_start();
			require_once('connection.php');
			$mysqli = new mysqli("localhost", "root", "", "poll3");
			// Defining your login details into variables
			$myusername=$_POST['myusername'];
			$mypassword=$_POST['mypassword'];
			$myvoterid=$_POST['myvoterid'];

			$encrypted_mypassword=sha1($mypassword); // SHA1 Hash for security
			// MySQL injection protections
			$myusername = stripslashes($myusername);
			$mypassword = stripslashes($mypassword);
			$myvoterid=stripslashes($myvoterid);
			
			$myusername = $mysqli->escape_string($_POST['myusername']);
			$mypassword = $mysqli->escape_string($_POST['mypassword']);
			$myvoterid = $mysqli->escape_string($_POST['myvoterid']); 
			$myvoterppsn = $mysqli->escape_string($_POST['myvoterppsn']); 
			
			$sql1="SELECT * FROM tbmembers WHERE voter_id='$myusername' and password='$encrypted_mypassword' and voter_status = '-1'";
			$result1= $mysqli->query($sql1) or die(mysqli_error());

		
			// Checking table row
			$count1=mysqli_num_rows($result1);
			
			
			if($count1 > 0)
			{
				echo "Your document has been denied. Please contact the Election Commission for further queries and reapplication.";
			}
			else
			{
				//Error: documents waiting for approval
				$sql2="SELECT * FROM tbmembers WHERE voter_id='$myusername' and password='$encrypted_mypassword' and voter_status='0'";
				$result2= $mysqli->query($sql2) or die(mysqli_error());
				$count2=mysqli_num_rows($result2);
				if($count2 > 0)
				{
					echo "Sorry, you can't log in. Your documents are yet to be approved.";
					die();
				}
				
				$sql="SELECT * FROM tbmembers WHERE voter_id='$myusername' and password='$encrypted_mypassword' and voter_status = '1'" or die(mysqli_error());
				$result= $mysqli->query($sql) or die(mysqli_error());

				// Checking table row
				$count=mysqli_num_rows($result);
				// If username and password is a match, the count will be 1

				if($count==1){
					// If everything checks out, you will now be forwarded to voter.php
					$user = mysqli_fetch_assoc($result);
					$_SESSION['member_id'] = $user['member_id'];
					//$_SESSION['member_id'] = $user['voter_ppsn'];

					header("location:voter.php");
				}
				//If the username or password is wrong, you will receive this message below.
				else {
					echo "Wrong Username or Password.<br><br>Return to <a href=\"login.php\">Login</a>";
				}
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