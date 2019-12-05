<?php
    session_start();
    require('../connection.php');
    if(empty($_SESSION['admin_id'])){
      header("location:access-denied.php");
    } 
    $mysqli = new mysqli("localhost", "root", "", "poll3");
    $result = $mysqli->query("SELECT * FROM tbmembers");
    //or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result)<1){
        $result = null;
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
      <h1><a href="index.php">ONLINE VOTING</a></h1>
    </div>
    
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li><a href="admin.php">Home</a></li>
        <li class="active"><a class="drop" href="#">Admin Panel Pages</a>
          <ul>
           <!--  <li><a href="manage-admins.php">Manage Admin</a></li>
            <li><a href="positions.php">Manage Positions</a></li> -->
			<li><a href="manage-members.php">Manage Members</a></li>
            <li><a href="elections.php">Elections</a></li>
            <li><a href="candidates.php">Approve Users</a></li>
            <li class="active"><a href="results.php">Results</a></li>
          </ul>
        </li>
        
        <!-- <li><a href="http://localhost/online_voting/index.php">Voter Panel</a></li> -->
        <li><a href="logout.php">Logout</a></li>

      </ul>
    </nav>
    
  </header>
</div>

<div >
<hr>
<table border="0" width="620" align="center">
<CAPTION><h3>AVAILABLE VOTERS </h3></CAPTION>
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
    while ($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['voter_id']."</td>";
    echo "<td>" . $row['first_name']."</td>";
    echo "<td>" . $row['last_name']."</td>";
    echo "<td>" . $row['email']."</td>";
    echo "<td>" . $row['is_candidate']."</td>";
    //echo '<td><a href="manage-members.php?id=' . $row['member_id'] .'" >Delete Voter</a></td>';
    echo "<td><a href=\"manage-members.php?id=$row[member_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete Voter</a></td>";
	echo "</tr>";
	$inc++;
    }
?>

</table>

<hr>

<hr>
</div>

<?php include 'footer.php'; ?>