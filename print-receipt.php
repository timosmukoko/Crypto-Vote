<?php
  session_start();
    require('connection.php');
	//require("rsa.class");
 $mysqli = new mysqli("localhost", "root", "", "poll3");
    //If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['member_id'])){
      header("location:access-denied.php");
    } 
//$date = date("Y/m/d");//
$date = date("d/m/Y");
$voter_id = $_SESSION['member_id'];

//$ses = $_SESSION[member_id];
////retrive voter details from the tbmembers table
//    //$result= $mysqli->query("SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'")
//   $result= $mysqli->query("SELECT m.member_id, m.first_name, m.last_name, m.email, m.voter_id, v.election_id, v.candidate_id FROM tbmembers m INNER JOIN tbcandidates v ON m.member_id = v.candidate_id ")
//   //$result= $mysqli->query("SELECT * FROM tbvote WHERE voter_id = '$ses'")
//    or die("There are no records to display ... \n" . mysqli_error()); 
//    if (mysqli_num_rows($result)<1){
//        $result = null;
//    }
//    $row = mysqli_fetch_array($result);
//    if($row)
//     {
//         // get data from db
//         $stdId = $row['member_id'];
//         $firstName = $row['first_name'];
//         $lastName = $row['last_name'];
//         $email = $row['email'];
//         $voter_id = $row['voter_id'];
//         $voter_pin = $row['voter_pin'];
//         $is_candidate = $row['is_candidate'];
//         $candi_status = $row['candi_status'];
//         $infos = $row['infos'];
//         $candidateId = $row['candidate_id'];
//         $electionId = $row['election_id'];
//     }
 
    $result = $mysqli->query("SELECT * FROM tbvote WHERE voter_id='$voter_id'") 
    or die("There are no records to display ... \n" . mysqli_error()); 
    if (mysqli_num_rows($result)<1){
       $result = null;
   }
    $row = mysqli_fetch_array($result);
    if($row)
    {
    $candidateId = $row['candidate_id'];
    $electionId = $row['election_id'];
}
//call the FPDF library
require('fpdf17/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('P','mm','A4');
//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'ELECTION COMMISSION',0,0);
$pdf->Cell(59 ,5,'VOTE RECEIPT',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Molish',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Limerick, Ireland, V94 EC5T',0,0);
$pdf->Cell(25 ,5,'Date: ',0,0);
$pdf->Cell(34 ,5,"{$date}",0,1);//end of line

$pdf->Cell(130 ,5,'Phone: +353- 61- 293000',0,0);
$pdf->Cell(25 ,5,'Voter #',0,0);
$pdf->Cell(34 ,5,"{$stdId}",0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Details:',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(25 ,5,'First Name:',0,0);
$pdf->Cell(34 ,5,"{$firstName}",0,1);

$pdf->Cell(25 ,5,'Last Name',0,0);
$pdf->Cell(34 ,5,"{$lastName}",0,1);

$pdf->Cell(25 ,5,'Email:',0,0);
$pdf->Cell(34 ,5,"{$email}",0,1);

$pdf->Cell(25 ,5,'Voter id:',0,0);
$pdf->Cell(34 ,5,"{$voter_id}",0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Election Description',1,0);
$pdf->Cell(25 ,5,'Candidate',1,0);
$pdf->Cell(34 ,5,'candi No',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130 ,5,"{$electionId}",1,0);
$pdf->Cell(25 ,5,"{$lastName}",1,0);
$pdf->Cell(34 ,5,"{$candidateId}",1,1,'R');//end of line

 
////summary
//$pdf->Cell(130 ,5,'',0,0);
//$pdf->Cell(25 ,5,'Subtotal',0,0);
//$pdf->Cell(4 ,5,'$',1,0);
//$pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line
//
//$pdf->Cell(130 ,5,'',0,0);
//$pdf->Cell(25 ,5,'Taxable',0,0);
//$pdf->Cell(4 ,5,'$',1,0);
//$pdf->Cell(30 ,5,'0',1,1,'R');//end of line
//
//$pdf->Cell(130 ,5,'',0,0);
//$pdf->Cell(25 ,5,'Tax Rate',0,0);
//$pdf->Cell(4 ,5,'$',1,0);
//$pdf->Cell(30 ,5,'10%',1,1,'R');//end of line
//
//$pdf->Cell(130 ,5,'',0,0);
//$pdf->Cell(25 ,5,'Total Due',0,0);
//$pdf->Cell(4 ,5,'$',1,0);
//$pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line

//output the result
$pdf->Output();


?>