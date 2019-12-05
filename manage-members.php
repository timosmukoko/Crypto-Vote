<?php
    session_start();
    require('connection.php');
    if(empty($_SESSION['admin_id'])){
      header("location:access-denied.php");
    } 
    $mysqli = new mysqli("localhost", "root", "", "poll3");
    $result = $mysqli->query("SELECT * FROM tbmembers WHERE voter_status=1 AND candi_status = 0");
    //or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result)<1){
        $result = null;
    }
?>

<?php
    
    $mysqli = new mysqli("localhost", "root", "", "poll3");
    $result2 = $mysqli->query("SELECT * FROM tbmembers WHERE voter_status=0");
    //or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result2)<1){
        $result2 = null;
    }
?>

<?php
    
    $mysqli = new mysqli("localhost", "root", "", "poll3");
    $result3 = $mysqli->query("SELECT * FROM tbmembers WHERE candi_status=1");
    //or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result3)<1){
        $result3 = null;
    }
?>

<?php
// deleting sql query
// check if the 'id' variable is set in URL
 if (isset($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $mysqli = new mysqli("localhost", "root", "", "poll3");
 $result = $mysqli->query("DELETE FROM tbmembers WHERE member_id='$id'");
 //$result = mysqli_query($con, "DELETE FROM tbmembers WHERE member_id='$id'");
 
 // redirect back to candidates
 header("Location: manage-members.php");
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

<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">


<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    
    <div id="logo" class="fl_left">
      <h1><a href="index.php">CRYPTO-VOTES</a></h1>
    </div>
    
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="authority-manage.php">Home</a></li>
		<li><a href="registeracc.php">Register voter/Candidate</a>
                <li><a href="manage-members.php">Manage Members</a>    
		
        <!-- <li><a href="http://localhost/online_voting/index.php">Voter Panel</a></li> -->
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    
  </header>
</div>

<div >
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE APPROVED VOTERS </h3></CAPTION>
<tr>
<th>Voter ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Voter Email</th>
<th>Voter Status</th>
<th>Action</th>
</tr>

<?php
$inc=1;
    //loop through all table rows
    while ($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['voter_id']."</td>";
    echo "<td>" . $row['first_name']."</td>";
    echo "<td>" . $row['last_name']."</td>";
    echo "<td>" . $row['email']."</td>";
    echo "<td>" . $row['voter_status']."</td>";
	echo '<td><a href="updateMembres.php?id='.$row['member_id'].'" >Edit</a></td>';
	echo "</tr>";
	$inc++;
    }
?>

</table>
<hr>
<hr>
</div>
    
  <div >
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE APPROVED CANDIDATES </h3></CAPTION>
<tr>
<th>Voter ID</th>
<th>First Name</th>
<th>Lastname</th>
<th>Voter Email</th>
<th>Is Candidate</th>
<th>Action</th>
</tr>

<?php
$inc=1;
    //loop through all table rows
    while ($row = mysqli_fetch_array($result3)){
    echo "<tr>";
    echo "<td>" . $row['voter_id']."</td>";
    echo "<td>" . $row['first_name']."</td>";
    echo "<td>" . $row['last_name']."</td>";
    echo "<td>" . $row['email']."</td>";
    echo "<td>" . $row['is_candidate']."</td>";
    echo '<td><a href="updateMembres.php?id='.$row['member_id'].'" >Edit</a></td>';
    echo "</tr>";
    $inc++;
    }
?>

</table>
<hr>
<hr>
</div>
    
  <div >
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>NOT APPROVED VOTERS/CANDIDATE </h3></CAPTION>
<tr>
<th>Voter ID</th>
<th>First Name</th>
<th>Lastname</th>
<th>Voter Email</th>
<th>Voter Status</th>
<th>Is Candidate</th>
<th>Action</th>
</tr>

<?php
$inc=1;
    //loop through all table rows
    while ($row = mysqli_fetch_array($result2)){
    echo "<tr>";
    echo "<td>" . $row['voter_id']."</td>";
    echo "<td>" . $row['first_name']."</td>";
    echo "<td>" . $row['last_name']."</td>";
    echo "<td>" . $row['email']."</td>";
    echo "<td>" . $row['voter_status']."</td>";
    echo "<td>" . $row['is_candidate']."</td>";
    echo '<td><a href="updateMembres.php?id='.$row['member_id'].'" >Edit</a></td>';
    echo "</tr>";
    $inc++;
    }
?>

</table>
<hr>
<hr>
</div>

<?php include 'footer.php'; ?>