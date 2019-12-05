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
<title>CRYPTO-VOTES</title>
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
      <h1><a href="index.php">CRYPTO-VOTES</a></h1>
    </div>
   



	<nav id="mainav" class="fl_right">
      <ul class="clear">
        <li ><a href="voter.php">Home</a></li>
        <li class="active"><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li ><a href="reg-verification.php">Vote</a></li>
            <li class="active"><a href="manage-profile.php">View profile</a></li>
			<li><a href="viewcandidates.php">View Candidates</a></li>
			<li><a href="viewparties.php">View Parties</a></li>
			<li><a href="electionResults.php">View Election Results</a></li>
          </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  


  </header>
</div>




<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <h2 class="font-x3 uppercase btmspace-80 underlined"> CRYPTO -<a href="#">VOTES</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        

      	<div >
		<h1>Invalid Key provided </h1>

		</div>

		<div>

		<?php
//			ini_set ("display_errors", "1");
//			error_reporting(E_ALL);
//			ob_start();
//                        
                        
                        ////////////////////////
$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';

function decryptthis($data, $key) {
    
    $encryption_key = base64_decode($key);
    list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

 if( isset($_POST['submitKey']) ) {
        $keypin = $_POST['keypin'];   
        //$myId = addslashes( $_GET[id]);
        $decrypted=decryptthis($keypin, $key);
				  
        $result = $mysqli->query("SELECT * FROM tbmembers WHERE voter_pin='$decrypted'");
        $user = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) == 1 && $_SESSION['member_id'] == $user['member_id'])
        {
           header( "location:vote.php");
        }
        else
            {
               echo '<script>alert("Wrong key...");</script>';
               die();
            }					
 } 
	

//$encrypted=encryptthis($myPin, $key);
//$decrypted=decryptthis($encrypted, $key);
////////////////////////////////////

//			session_start();
//			require_once('connection.php');
//			$mysqli = new mysqli("localhost", "root", "", "poll3");
//			// Defining your key details into variables
//			$keypin=$_POST['keypin'];			
//
//			//$encrypted_mypassword=sha1($mypassword); // SHA1 Hash for security
//                        $decrypted=decryptthis($keypin, $key);
//                        $getdata = $decrypted;
//			// MySQL injection protections
////			$keypin = stripslashes($keypin);
////			
////			
////			$keypin = $mysqli->escape_string($_POST['$keypin']);
//			echo ' this key to Start voting: '.$getdata;
//			
//			$sql1="SELECT * FROM tbmembers WHERE voter_pin='$getdata'";
//			$result1= $mysqli->query($sql1) or die(mysqli_error());
//
//		
//			// Checking table row
//			$count1=mysqli_num_rows($result1);
//                        
//			// If key is a match, the count will be 1
//				if($count==1){
//					// If everything checks out, you will now be forwarded to voter.php
//					$user = mysqli_fetch_assoc($result);
//					$_SESSION['member_id'] = $user['member_id'];
//					//$_SESSION['member_id'] = $user['voter_ppsn'];
//					header("location:vote.php");
//				}
//				//If the key is wrong, you will receive this message below.
//				else {
//					echo "Wrong Key...";
//				}		
//			ob_end_flush();
		?> 

		</div>


      
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>

<?php include 'footer.php'; ?>