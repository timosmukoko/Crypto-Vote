<?php
    session_start();
    require('connection.php');
 $mysqli = new mysqli("localhost", "root", "", "poll3");
	//If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['member_id'])){
      header("location:access-denied.php");
    } 
?>


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
        <li><a href="voter.php">Home</a></li>
        <li class="active"><a class="drop" href="#">Voter Pages</a>
          <ul>
            <!--li class="active"><a href="vote.php">Vote</a></li-->
            <li><a href="manage-profile.php">View profile</a></li>
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
    <center>
	<h2 class="font-x3 uppercase btmspace-70 underlined">  <a href="#">Before starting Vote you need a key</a></h2>
	</center>
    <ul class="nospace group">
      <li class="" style="margin-right: 300px">
            <table border="0" width="50px" align="center" style="margin-left: 100px;margin-top: 50px">
             <form action="reg-verification.php" method="POST">
              <h1>Please Verify Yourself!</h1>
              <p>Enter your email and Press the Start button to request a key.</p>
              <tr>
			  <td style="color:#000000"; width="78"><input name="email" type="email" id="email"></td>
			  </tr>
			  <tr>			 
			  <td style="color:#000000";><input type="submit" name="start" value="Start"></td>
			   </tr>
            </form>
            </table>
    <?php
	$min = 1000;
	$max = 9000;
	 
	  if( isset($_POST['start']) ) {
		   $myMail = $_POST['email'];
		   $pin = mt_rand($min, $max);
           $myId = addslashes( $_GET[id]);
			
		   if(!empty($_POST['email'])){
			  
				// $voterid = $_SESSION['member_id'];
				// $voterid = 'true';
			    $result = $mysqli->query("SELECT * FROM tbmembers WHERE email='$myMail'");
				$user = mysqli_fetch_assoc($result);
			   //$_SESSION['member_id'] = $user['member_id'];
				
				if(mysqli_num_rows($result) == 1 && $_SESSION['member_id'] == $user['member_id'])
				{
					$sql = $mysqli->query( "UPDATE tbMembers SET voter_pin ='$pin' WHERE member_id = '$_SESSION[member_id]'" )
					or die( mysqli_error() );
					header( "location:new-pin.php");
			   
			    }else{
					echo '<script>alert("Wrong email address...");</script>';
					die();
				}				
      		}else{
				echo '<script>alert("Enter your email address...");</script>';
				die();
			}
	  }
	
       ?>	   
      
      </li>
      <li class="one_half">

      </li>

    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>