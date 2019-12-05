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
            <li><a href="votecandidate.php">Vote</a></li>
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

<?php 
  if (isset($_GET['id']))
  {
      $id = $_GET['id'];
      $voter_id =$_SESSION['member_id'];
      $candidate_id = $_GET['candidate_id'];
      $mysqli->query( "INSERT INTO tbvote(voter_ppsn,election_id,candidate_id) VALUES ('$voter_id','$id', '$candidate_id')")
      or die("The candidate does not exist ... \n"); 
      echo '<script>Voted Successfully</script>';
      header("Location: votecandidate.php");
  }

?>

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <center>
	<h2 class="font-x3 uppercase btmspace-70 underlined"> <a href="#">Vote</a></h2>
    </center>
	<ul class="nospace group">
      <li class="" style="margin-right: 300px">
            <table border="0" width="100%" align="center" style="margin-left: 100px;margin-top: 50px">
            <CAPTION><h3>ONGOING ELECTIONS</h3></CAPTION>
            <th>Election ID</th>
            <th>Election Name</th>
            <th>Election Registration End Date</th>
            <th>Election Start Date</th>
            <th>Election End Date</th>
            </tr>
            <?php
            $result = $mysqli->query("SELECT * FROM tbelections WHERE status = 'S'");
                while ($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td style='color:#0000ff'>" . $row['election_id']."</td>";
                    echo "<td style='color:#0000ff'>" . $row['election_name']."</td>";
                    echo "<td style='color:#0000ff'>" . $row['reg_date']."</td>";
                    echo "<td style='color:#0000ff'>" . $row['start_date']."</td>";
                    echo "<td style='color:#0000ff'>" . $row['end_date']."</td>";
                    echo '<td style="color:#0000ff"><a href="votecandidate.php?election_id=' . $row['election_id'] . '">Vote in this election</a></td>';
                    echo "</tr>";
                
                }
            ?>
            </table>
    <?php
    // check if the 'id' variable is set in URL
     if (isset($_GET['election_id']))
     {
       // get id value
       $id = $_GET['election_id'];
       $voter_id = $_SESSION['member_id'];
       $result = $mysqli->query("SELECT * FROM tbvote WHERE election_id = '$id' AND voter_ppsn=' $voter_id'");
       $count=mysqli_num_rows($result);
       if($count!=0){
          echo '<script>alert("You have already voted in this election");</script>';
          die();
       }
       $result = $mysqli->query("SELECT * FROM tbcandidates WHERE election_id = '$id'");
       $count=mysqli_num_rows($result);
       if($count==0){
          echo '<script>alert("There are no registered candidates this election");</script>';
          die();
       }
       ?>
       <table border="0" width="100%" align="center" style="margin-left: 100px;margin-top: 50px">
            <CAPTION><h3>CANDIDATES IN THE ELECTION</h3></CAPTION>
            <th>Election ID</th>
            <th>Candidate ID</th>
            <th>Voter Name</th>
            <th>Voter Milestones</th>
            </tr>

            <?php
                //loop through all table rows
                while ($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td style='color:#0000ff'>" . $row['election_id']."</td>";
                    echo "<td style='color:#0000ff'>" . $row['candidate_id']."</td>";
                    $candid =$row['candidate_id'];
                    $res = $mysqli->query("SELECT * FROM tbmembers WHERE member_id = '$candid'");
                    while ($r = mysqli_fetch_array($res)){
                          echo "<td style='color:#0000ff'>" . $r['first_name'].' '. $r['last_name']."</td>";
                          echo "<td style='color:#0000ff;white-space: pre-line'>" . $r['milestones']."</td>";
                    }
                    echo '<td style="color:#0000ff"><a href="votecandidate.php?id='. $row['election_id'] . '&candidate_id='.$row['candidate_id'].'">Vote</a></td>';
                    echo "</tr>";
                }
            ?>
            </table>
         <?php
         $result =  $mysqli->query("UPDATE tbmembers SET is_candidate = '1' WHERE member_id='$id'")
         or die("The candidate does not exist ... \n"); 
         // redirect back to candidates
         //header("Location: manage-profile-candidate.php");
     
     }
     else
     // do nothing   
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