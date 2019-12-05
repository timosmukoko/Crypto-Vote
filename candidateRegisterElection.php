<?php
    session_start();
    require('connection.php');
 $mysqli = new mysqli("localhost", "root", "", "poll3");
    //If your session isn't valid, it returns you to the login screen for protection
    // if(empty($_SESSION['candidate_id']) || empty($_SESSION['member_id'])){
	 	// header("location:access-denied.php");
	//}
	if(empty($_SESSION['member_id'])){
		header("location:access-denied.php");
	}
    //retrive voter details from the tbmembers table
    $result= $mysqli->query("SELECT * FROM tbmembers WHERE member_id = '$_SESSION[member_id]'")
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
         $is_candidate = $row['is_candidate'];
         $candi_status = $row['candi_status'];
		 $result2= $mysqli->query("SELECT * FROM tbcandidate c, tbmembers t WHERE c.member_id = '$_SESSION[member_id]' and c.member_id = t.member_id'");
		 $row2 = mysqli_fetch_array($result2);
		 if($row2)
		 {
			$milestones = $row2['milestones'];
		 }
     }
?>

<?php
    // updating sql query
    if (isset($_POST['update'])){
        $myId = addslashes( $_GET[id]);
        $myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
        $myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
        $myEmail = $_POST['email'];
        $myPassword = $_POST['password'];
        $myVoterid = $_POST['voter_id'];

        $newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

        $sql = $mysqli->query( "UPDATE tbMembers SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail', voter_id = '$myVoterid', password='$newpass' WHERE member_id = '$myId'" )
                or die( mysqli_error() );

        // redirect back to profile
         header("Location: manage-profile-candidate.php");
    }
?>



<?php
    // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {

       // get id value
       $id = $_GET['id'];
  
         $result =  $mysqli->query("UPDATE tbmembers SET is_candidate = '1' WHERE member_id='$id'")
         or die("The candidate does not exist ... \n"); 
         // redirect back to candidates
         header("Location: manage-profile-candidate.php");
     
     }
     else if (isset($_GET['milestones']))
     {

       // get id value
       $milestones = $_GET['milestones'];
  
         $result =  $mysqli->query("UPDATE tbcandidate SET milestones='$milestones' WHERE member_id = '$_SESSION[member_id]'")
         or die("The candidate does not exist ... \n"); 
         // redirect back to candidates
         header("Location: manage-profile-candidate.php");
     
     }
     else if (isset($_GET['election_id']))
     {

       // get id value
       $election_id = $_GET['election_id'];
  
         $result =   $mysqli->query( "INSERT INTO tbcandidates(candidate_id, election_id) VALUES ('$_SESSION[member_id]','$election_id')" )
         or die("The candidate does not exist ... \n"); 
         // redirect back to candidates
         header("Location: manage-profile-candidate.php");
     
     }
     else
     // do nothing   
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
        <li class="active"><a href="candidate.php">Home</a></li>
        <li><a class="drop" href="#">Candidate Panel</a>
          <ul>
            <li><a href="manage-profile-candidate.php">Update Milestones</a></li>
			<li><a href="electionResultsCandidate.php">Election Results</a></li>
			<li><a href="candidateRegisterElection.php">Register in Election</a></li>
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
	<h2 class="font-x3 uppercase btmspace-80 underlined"> Register in <a href="#">Election</a></h2>
    <ul class="nospace group">
      <li class="one_half">
      <?php if($candi_status == 1){ ?>
<table border="0" width="620" align="center" style="margin-left: 100px;margin-top: 50px">
<CAPTION><h3>ELECTIONS YOU CAN REGISTER FOR</h3></CAPTION>
<th>Election ID</th>
<th>Election Name</th>
<th>Election Registration End Date</th>
<th>Election Start Date</th>
<th>Election End Date</th>
</tr>

<?php
    //loop through all table rows
$result = $mysqli->query("SELECT * FROM tbelections WHERE status = 'S'");
$alreadyreg = $mysqli->query("SELECT * FROM tbcandidates WHERE candidate_id = '$_SESSION[member_id]'");
$arr = [];
$i=0;
while ($row = mysqli_fetch_array($alreadyreg)) {
  $arr[$i++]=$row['election_id'];
}
    while ($row = mysqli_fetch_array($result)){
        if(!in_array($row['election_id'], $arr)){
        echo "<tr>";
        echo "<td style='color:#0000ff'>" . $row['election_id']."</td>";
        echo "<td style='color:#0000ff'>" . $row['election_name']."</td>";
        echo "<td style='color:#0000ff'>" . $row['reg_date']."</td>";
        echo "<td style='color:#0000ff'>" . $row['start_date']."</td>";
        echo "<td style='color:#0000ff'>" . $row['end_date']."</td>";
        echo '<td style="color:#0000ff"><a href="candidateRegisterElection.php?election_id=' . $row['election_id'] . '&to=F">Register</a></td>';
        echo "</tr>";
      }
    }
?>

</table>

<table border="0" width="620" align="center" style="margin-left: 100px;margin-top: 50px">
<CAPTION><h3>ELECTIONS YOU HAVE REGISTERED FOR</h3></CAPTION>
<th>Election ID</th>
<th>Election Name</th>
<th>Election Registration End Date</th>
<th>Election Start Date</th>
<th>Election End Date</th>
</tr>

<?php
    //loop through all table rows
$result = $mysqli->query("SELECT * FROM tbelections WHERE status = 'S'");
$alreadyreg = $mysqli->query("SELECT * FROM tbcandidates WHERE candidate_id = '$_SESSION[member_id]'");
$arr = [];
$i=0;
while ($row = mysqli_fetch_array($alreadyreg)) {
  $arr[$i++]=$row['election_id'];
}
    while ($row = mysqli_fetch_array($result)){
      if(in_array($row['election_id'], $arr)){
        echo "<tr>";
        echo "<td style='color:#0000ff'>" . $row['election_id']."</td>";
        echo "<td style='color:#0000ff'>" . $row['election_name']."</td>";
        echo "<td style='color:#0000ff'>" . $row['reg_date']."</td>";
        echo "<td style='color:#0000ff'>" . $row['start_date']."</td>";
        echo "<td style='color:#0000ff'>" . $row['end_date']."</td>";
        echo "</tr>";
      }
    }
?>

</table>
</center>
	

<?php } ?>

        <!-- <blockquote>
            <table  border="0" width="620" align="center">
            <CAPTION><h3>UPDATE PROFILE</h3></CAPTION>
            <form action="manage-profile-candidate.php?id=<?php echo $_SESSION['member_id']; ?>" method="post" onsubmit="return updateProfile(this)">
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



        </blockquote> -->
      
      </li>

    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>