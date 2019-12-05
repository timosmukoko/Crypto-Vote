<?php
	require('connection.php');

	session_start();
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
        <li class="active"><a href="voter.php">Home</a></li>
        <li><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li><a href="reg-verification.php">Vote</a></li>
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
	<h2 class="font-x3 uppercase btmspace-80 underlined"> View <a href="#">Candidates</a></h2>
    </center>
	<ul class="nospace group">
      <li class="one_half first">
        
      </li>
      
    </ul>
    <!-- ################################################################################################ -->
	

	<table border="0" width="620" align="center">
	<CAPTION><h3>CANDIDATES</h3></CAPTION>
	<tr>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Milestones</th>
	<th>Party</th>
	
	</tr>

	<?php
		//loop through all table rows
		//$mysqli = new mysqli("localhost", "root", "", "poll3");
		$mysqli = new mysqli("localhost", "root", "", "poll3");
		$result = $mysqli->query("SELECT * FROM tbmembers WHERE is_candidate = '1' and candi_status = '1'");
		//or die("There are no records to display ... \n" . mysqli_error()); 
		if (mysqli_num_rows($result)<1){
        $result = null;
		}
		
				
		// $sql = "SELECT * FROM tbmembers WHERE is_candidate = '1' and candi_status = '1'";
		// $result = $mysqli->query($sql);
		// $count=mysqli_num_rows($result);
		// if($count > 0)
		// {
			// while ($row = mysqli_fetch_array($result)){
				// $curr_member = $row['member_id'];
				// $sql2 = "SELECT p.party_name FROM party p, tbmembers t, candidate c WHERE p.party_id = c.party_id AND c.member_id = t.member_id AND t.member_id = '$curr_member'";
	
				// $result2 = $mysqli->query($sql2);
				// $count2=mysqli_num_rows($result2);
				// if($count2 > 0)
				// {
					// $user = mysqli_fetch_assoc($result2);
					// $curr_party_name = $user['party_name'];
					// $sql3 = "SELECT c.milestones FROM tbmembers t, candidate c WHERE c.member_id = t.member_id AND c.member_id = '$curr_member'";
					// $result3 = $mysqli->query($sql3);
					// $user2 = mysqli_fetch_assoc($result3);
					// $curr_milestones = $user2['milestones'];
					
					// echo "<tr>";
					// echo "<td style='color:#000000'>" . $row['first_name']."</td>";
					// echo "<td style='color:#000000'>" . $row['last_name']."</td>";
					// echo "<td style='color:#000000'>" . $row['email']."</td>";
					// echo "<td style='color:#000000'>" . $curr_party_name."</td>";
					// echo "<td style='color:#000000'>" . $curr_milestones."</td>";
					// echo "</tr>";
						
				// }
				
				
				
			// }
			
			
			
		// }
		
	?>
	
	<?php
$inc=1;
    //loop through all table rows
    while ($row = mysqli_fetch_array($result)){
    echo "<tr>";
	echo "<td style='color:#000000'>" . $row['first_name']."</td>";
	echo "<td style='color:#000000'>" . $row['last_name']."</td>";
	echo "<td style='color:#000000'>" . $row['email']."</td>";
	//echo "<td style='color:#000000'>" . $curr_party_name."</td>";
	echo "<td style='color:#000000'>" . $row['milestones']."</td>";
	echo "</tr>";
	$inc++;
    }
?>

	</table>
	
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>