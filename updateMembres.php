<?php
    session_start();
    require('connection.php');
 $mysqli = new mysqli("localhost", "root", "", "poll3");
?>

<?php
    // updating sql query
    if (isset($_POST['update'])){
        //$myId = addslashes( $_GET[id]);
        $myId = $_POST['member_id'];
        $myFirstName = $_POST['last_name']; //prevents types of SQL injection
        $myLastName = $_POST['last_name']; //prevents types of SQL injection
        $myEmail = $_POST['email'];
        $myVoterid = $_POST['voter_id'];

        $sql = $mysqli->query( "UPDATE tbmembers SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail', voter_id = '$myVoterid' WHERE member_id = $myId" )
                or die( mysqli_error() );

        // redirect
         header("Location: updateMembres.php");
    }
?>

<?php
    //getting id from url
    $id = $_GET[id];
    
    //selecting data associated with this particular id
    $result = $mysqli->query("SELECT * FROM members WHERE member_id=$id");
    
    while($row = mysqli_fetch_array($result))
    {
        $myFirstName = $row['first_name'];
        $myLastName = $row ['last_name']; 
        $myEmail = $row ['email'];
        $myVoterid = $row ['voter_id'];
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
      <h1><a href="index.php">CRYPTO-VOTES</a></h1>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="authority-manage.php">Home</a></li>
            <li><a href="registeracc.php">Register voter/Candidate</a>
            <li><a href="manage-members.php">Manage Members</a>    
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
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Mention those Awesome <a href="#">Infos</a></h2>
    <ul class="nospace group">
        <blockquote> 
         <form action="updateMembres.php" method="GET">
            <table border="0" width="620" align="center">
            <CAPTION><h3>UPDATE MEMBER</h3></CAPTION>
            <br>
             <tr>
                <td style="color:#000000"; ><input type="hidden" name="member-id" value="<?php echo $_GET[id];?>" ></td>
            </tr>
            <tr>
                <td style="color:#000000" >Voter Id:</td>
                <td style="color:#000000"; ><input type="text" name="voter_id" value="<?php echo $myVoterid; ?>" ></td>
            </tr>
            <tr>

                <td style="color:#000000"; >First Name:</td>
                <td style="color:#000000"; ><input type="text" name="first_name" value="<?php echo $myFirstName; ?>"></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Last Name:</td>
                <td style="color:#000000"; ><input type="text" name="last_name" value="<?php echo $myLastName; ?>"></td>
            </tr>
            <tr>
                <td style="color:#000000"; >Email:</td>
                <td style="color:#000000"; ><input type="text" name="email" value="<?php echo $myEmail; ?>"></td>
            </tr> 
            <tr>
                <td style="color:#000000"; ></td>
                <td style="color:#000000"; ><input type="submit" name="update" value="Update"></td>
            </tr>  
            </table>
         </form>
             <hr>

        </blockquote>
      
      
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>