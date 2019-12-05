<?php
    session_start();
    require('rsa.class');
    require('connection.php');
 $mysqli = new mysqli("localhost", "root", "", "poll3");
    //If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['member_id'])){
      header("location:access-denied.php");
    } 
    //retrive voter details from the tbmembers table
    $result= $mysqli->query("SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'")
    or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result)<1){
        $result = null;
    }
    $row = mysqli_fetch_array($result);
    if($row)
     {
         // get data from db
         $stdId = $row['member_id'];
         $firstName = $row['first_name'];
         $lastName = $row['last_name'];
         $email = $row['email'];
         $voter_id = $row['voter_id'];
         $voter_status = $row['voter_status'];
         $voter_pin = $row['voter_pin'];
         $is_candidate = $row['is_candidate'];
         $candi_status = $row['candi_status'];
         $infos = $row['infos'];
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
<style> 
    #keypin{
     width:700px;
    }</style>
</head>
<body id="top">
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.php">CRYPTO-VOTES</a></h1>
    </div>
    <!-- ################################################################################################ -->
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
	<h2 class="font-x3 uppercase btmspace-80 underlined"> MY <a href="#"> PIN & KEY</a></h2>
    </center>
	<ul class="nospace group">
        <center>
		<blockquote>
            <table border="0"  width="630" align="center">
            <CAPTION><h3>YOUR PIN & YOUR VOTE KEY</h3></CAPTION>
          
            <br>
            <tr><td></td><td></td></tr>
            <tr>
                <td style="color:#000000"; >Voter ID:</td>
                <td style="color:#000000"; ><?php echo $_SESSION['member_id']; ?></td>
            </tr>
			<tr>
                <td style="color:#000000"; >This your new generated pin.</td>
                <td style="color:#000000; width:600px;" ><?php echo $voter_pin; ?></td>
            </tr>
			 <td style="color:#000000"; ><hr></td>
			<br>     
          </table>
                 <form id="myForm" action="new-pin.php" method="POST">
                   <table>
                    <tr>
                        <td style="color:#000000"; >Paste/Type Pin here:</td>
                        
                    </tr>
                    <tr>
			<td style="color:#000000"; width="78"><input name="voter_pin" type="text"></td>
                    </tr>
                    <tr>			 
			<td style="color:#000000";><input type="submit" name="startCasting" value="Submit Pin and Get key"></td>
                    </tr>
                   </table>
                </form>
                </td>
            </tr>
             <hr>          
		
		
		<?php
                
 ////////////////////////////////////////////////////////////////
 $key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
 
// ENCRYPTION
//-	DEFINE our cipher define ('AES_256_CBC', 'aes-256-cbc');
//-     AES = Advanced Encryption Standard
//-	Generate a 256-bit encryption key.
//-	This should be stored somewhere in server side instead of recreating it each time.
//-	$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
//-	Generate an initialization vector
//-	This *MUST* be available for decryption as well
//-	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
//-	Create some data to encrypt $data = "Generated PIN will be used here";
//-	 Encrypt $data using aes-256-cbc cipher with the given encryption key and 
//-	Our initialization vector. The 0 gives us the default options, but can be changed to OPENSSL_RAW_DATA or OPENSSL_ZERO_PADDING
//-	$encrypted = openssl_encrypt($data, AES_256_CBC, $encryption_key, 0, $iv);
//-	If we lose the $iv variable, we can't decrypt this, so append it to the encrypted data with a separator that we know won't exist in base64-encoded data.

 
function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}
 

//DECRYPTION
//-	To decrypt, separate the encrypted data from the initialization vector ($iv)
//-	$parts = explode(':', $encrypted);  The explode() function breaks a string into an array
//-	$parts[0] = encrypted data
//-	$parts[1] = initialization vector
//-	$decrypted = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0 ,$parts[1]);

function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}


//class Encryptor
//{
//   private $secret;
//   private $cipherMethod;
//   private $separator;
//   private $ivLength;
// 
//   public function __construct(
//       string $secret = 'crypto-votes',
//       string $cipherMethod = 'AES-256-CBC',
//       ///string $cipherMethod = 'SHA-256-CBC',
//       string $separator = '::'
//   ) {
//       $this->secret = $secret;
//       $this->cipherMethod = $cipherMethod;
//       $this->separator = $separator;
//       $this->ivLength = openssl_cipher_iv_length($cipherMethod);
//   }
// 
//   public function encrypt($data)
//   {
//       $decodedKey = base64_decode($this->secret);
// 
//       $iv = base64_encode(openssl_random_pseudo_bytes($this->ivLength));
//       $iv = substr($iv, 0, $this->ivLength);
// 
//       $encryptedData = openssl_encrypt($data, $this->cipherMethod, $decodedKey, 0, $iv);
// 
//       return base64_encode($encryptedData.$this->separator.$iv);
//   }
// 
//   public function decrypt($data)
//   {
//       $decodedKey = base64_decode($this->secret);
// 
//       list($encryptedData, $iv) = explode($this->separator, base64_decode($data), 2);
// 
//       $iv = substr($iv, 0, $this->ivLength);
// 
//       return openssl_decrypt($encryptedData, $this->cipherMethod, $decodedKey, 0, $iv);
//   }
//}
         
           ////////////////////////////////////////////////////////
  


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
                     
	  if( isset($_POST['startCasting']) ) {
           $myPin = $_POST['voter_pin'];
           $myId = addslashes( $_GET[id]);
 
           $encrypted=encryptthis($myPin, $key);
           $decrypted=decryptthis($encrypted, $key);
           
//           echo '<h2>Original Data</h2>';
//           echo '<p>'.$myPin.'</p>';
//           echo '<h2>Encrypted Data</h2>';
//           echo '<pre>'.$encrypted.'</pre>';
//           echo '<h2>Decrypted Data</h2>';
//           echo '<p>'.$decrypted.'</p>';
//           echo '<script>alert("Copy this key to Start voting: '.$encrypted.'");</script>';
//           echo '<table>';
//           echo '<td style="color:#000000";>Enter your key here:</td>';
//           echo '<td style="color:#000000";><input type="text" id="keypin"></td>';
//           echo '</table>';
           
           if(!empty($_POST['voter_pin'])){
//			  
		 //$voterid = $_SESSION['member_id'];
                // $voterid = 'true';
            $result = $mysqli->query("SELECT * FROM tbmembers WHERE voter_pin='$myPin'");
            $user = mysqli_fetch_assoc($result);
            //$_SESSION['member_id'] = $user['member_id'];
             
            if(mysqli_num_rows($result) == 1 && $_SESSION['member_id'] == $user['member_id'])
            {
		echo '<script>alert("Prior Copy the key and press OK: '.$encrypted.'");</script>';
                $sql = $mysqli->query( "UPDATE tbvote SET voter_vote ='$encrypted' WHERE voter_id = '$_SESSION[member_id]'" )
		or die( mysqli_error() );
                echo '<form action="checkKey.php" method="POST">';
                echo '<table>';
                echo '<td style="color:#000000";>Paste your key here:</td>';
                echo '<td style="color:#000000";><input type="text" name="keypin" id="keypin"></td>';
                echo '<tr><td style="color:#000000";><input type="submit" name="submitKey" value="Submit your key"></td></tr>';
                echo '</table>';
                echo '</form>';
//                if(isset($_POST['submitKey']))
//                {
//                    $result = $mysqli->query("SELECT * FROM tbvote WHERE voter_vote='$decrypted'");
//                    $user = mysqli_fetch_assoc($result);
//                    if(mysqli_num_rows($result) == 1 && $_SESSION['member_id'] == $user['member_id'])
//                    {
//                        header( "location:vote.php");
//                    }
//                    else
//                    {
//                        echo '<script>alert("Wrong key...");</script>';
//                        die();
//                    }
//                }
            }
            else
                {
                    echo '<script>alert("Wrong pin number...");</script>';
                    die();
                 }				
            }
            else
                {
                    echo '<script>alert("Enter your pin number...");</script>';
                    die();
                }
          // header( "location:vote.php");

//                    $encrytor = new Encryptor();
//           // $pin = $_POST['voter_pin'];
// 			              
//            $encrpted1 = $encrytor->encrypt($myPin);
//                
////$encrpted2 = $encrytor->encrypt($string);
// 
//echo 'ENCRYPTED 1: '.$encrpted1.PHP_EOL;
////echo 'ENCRYPTED 2: '.$encrpted2.PHP_EOL;
// 
//$decrpted1 = $encrytor->decrypt($encrpted1);
////$decrpted2 = $encrytor->decrypt($encrpted2);
// echo "<br>";
//echo 'DECRYPTED 1: '.$decrpted1.PHP_EOL;
 ;
//echo 'DECRYPTED 2: '.$decrpted2.PHP_EOL;
////////////////////////////////////////////////
           
         //  echo $_POST['voter_pin']; 
           
//            if(!empty($_POST['voter_pin'])){
//			  
//		 //$voterid = $_SESSION['member_id'];
//                // $voterid = 'true';
//            $result = $mysqli->query("SELECT * FROM tbmembers WHERE voter_pin='$myPin'");
//            $user = mysqli_fetch_assoc($result);
//            //$_SESSION['member_id'] = $user['member_id'];
//             
//            if(mysqli_num_rows($result) == 1 && $_SESSION['member_id'] == $user['member_id'])
//            {
//		header( "location:new-pin.php");			   
//            }
//            else
//                {
//                    echo '<script>alert("Wrong pin number...");</script>';
//                    die();
//                 }				
//            }
//            else
//                {
//                    echo '<script>alert("Enter your pin number...");</script>';
//                    die();
//                }
	  }
       ?>
                   
        </blockquote>
		</center>
      
<!--        <blockquote>
            <table  border="0" width="620" align="center">
            <CAPTION><h3>UPDATE PROFILE</h3></CAPTION>
            <form action="manage-profile.php?id=" method="post" onsubmit="return updateProfile(this)">
            <table align="center">
            <tr><td  style="background-color:#0000ff"  >First Name:</td><td style="background-color:#0000ff"  ><input  style="color:#000000"; type="text" font-weight:bold;" name="firstname" maxlength="15" value=""></td></tr>

            <tr><td style="background-color:#bf00ff">Last Name:</td><td style="background-color:#bf00ff"><input style="color:#000000";  type="text" font-weight:bold;" name="lastname" maxlength="15" value=""></td></tr>

            <tr><td style="background-color:#0000ff" >Email Address:</td><td style="background-color:#0000ff"><input style="color:#000000";  type="text" font-weight:bold;" name="email" maxlength="100" value=""></td></tr>

            <tr><td style="background-color:#bf00ff" >Voter Id:</td><td style="background-color:#bf00ff"><input  style="color:#000000";  type="text"  font-weight:bold;" name="voter_id" maxlength="100" value=""></td></tr>

            <tr><td style="background-color:#0000ff" >New Password:</td><td style="background-color:#0000ff" ><input  style="color:#000000";  type="password" font-weight:bold;" name="password" maxlength="15" value=""></td></tr>

            <tr><td style="background-color:#bf00ff" >Confirm New Password:</td><td style="background-color:#bf00ff" ><input   style="color:#000000";  type="password"  font-weight:bold;" name="ConfirmPassword" maxlength="15" value=""></td></tr>

            <tr><td style="background-color:#0000ff" >&nbsp;</td></td><td style="background-color:#0000ff" ><input style="color:#ff0000";  type="submit" name="update" value="Update Profile"></td></tr>

            </table>
            </form>
            </table>
        </blockquote> 
      -->
   
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>