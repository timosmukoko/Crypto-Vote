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
	<h2 class="font-x3 uppercase btmspace-80 underlined"> View <a href="#">Parties</a></h2>
    </center>
	<ul class="nospace group">
      <li class="one_half first">
        
      </li>
      
    </ul>
    <!-- ################################################################################################ -->
	

	<table border="0" width="620" align="center">
	<CAPTION><h3>PARTIES</h3></CAPTION>
	<tr>
	<th>Party Name</th>
	<th>Party Founder</th>
	<th>Party Date of Foundation</th>
	</tr>

	<?php
		//loop through all table rows
		$sql = "SELECT * FROM party";
		$result = $mysqli->query($sql);
		$count=mysqli_num_rows($result);
		if($count > 0)
		{
			while ($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td style='color:#000000'>" . $row['party_name']."</td>";
				echo "<td style='color:#000000'>" . $row['founder']."</td>";
				echo "<td style='color:#000000'>" . $row['date_of_foundation']."</td>";
				echo "</tr>";
				
			
				
			}
			
		}
		
	?>

	</table>
	
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>