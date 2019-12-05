
<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<!--<script language="JavaScript" src="js/user.js"> -->
<script language="JavaScript" src="js/user-1.js">
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
        <li class="active"><a href="index.php">Home</a></li>
		<li><a class="drop" href="#">Authority Panel</a>
		  <ul>
            <li><a href="admin/index.php">Election Authority</a></li>
            <li><a href="authority-login.php">Registration Authority</a></li>
            
          </ul>
		</li>
        <li><a class="drop" href="#">Voter Panel</a>
          <ul>
            <li><a href="login.php">Login</a></li>            
          </ul>
        </li>
        
		<li><a class="drop" href="#">Candidate Panel</a>
          <ul>
            <li><a href="candidatelogin.php">Login</a></li>
          </ul>
        </li>
		
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
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Voter <a href="#">Login</a></h2>
    <ul class="nospace group">
      <li class="one_half">
        <blockquote>

		
<table style="background-color:powderblue;" width="300" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" action="checklogin.php" onSubmit="return loginValidate(this)">
<td>
<table style="background-color:powderblue;" width="100%" border="0" cellpadding="3" cellspacing="1" >
<tr>
<td style="color:#000000"; width="78" >Voter ID Number</td>
<td style="color:#000000"; width="6">:</td>
<td style="color:#000000"; width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td style="color:#000000"; >Password</td>
<td style="color:#000000"; >:</td>
<td style="color:#000000"; ><input name="mypassword" type="password" id="mypassword"></td>
</tr>
  
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td style="color:#000000";><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<center>
<br>Not yet registered? <a href="registeracc.php"><b>Register Here</b></a>
</center>

        </blockquote>
      
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<?php include 'footer.php'; ?>