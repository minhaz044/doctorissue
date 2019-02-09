<?php
 include('session.php');
 include('DBcon.php');
 include('sidenav.php');



 ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>

ul {
  list-style-type: none;

}
li a {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 25px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.3s;
    cursor: pointer;
  	height:18px;
  	width:220px;
  	background-color: white;
    color: black;
    border: 2px solid #4CAF50;

}


li a:hover {
     background-color: #4CAF50;
    color: white;
}

</style>

      <title>DoctorIssue - Your Digital Health Assistant. </title>
   </head>

   <body >
<?php


$query="SELECT fname,lname  from users where accountno='$login_session'";
$execute=mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($execute);
$loginname= $row["fname"]." ".$row["lname"];

switch ($login_role) {
    case "basic":



?>
        <h1 align="center"><?php echo $loginname; ?></br>#ID:<?php echo $login_session; ?></h1>

	  <p align="center" style=" margin-left: 50px;margin-top: -30px;"> </p>
</br>
		<div align="center">

		<ul >

		<li ><a href="finddoctor.php?id=<?php echo"$login_session";?>"><span>Find Doctor</span></a></li>
    <li><a href="serial.php"><span>My Serial</span></a></li>
    <li><a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical History</span></a></li>
    <li><a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a></li>
    <li><a href="family_member.php"><span>Family Member </span></a></li>
    <li><a href="blooddonation.php"><span>Blood Bank </span></a></li>
    <li><a href="updatepersonalinfo.php"><span>Update Info</span></a></li>
		</ul>
		</div>
      <h5 align="center" text-color="red"><a href = "apply.php">Apply For DoctorShip</a></h5>
<?php

        break;
    case "doctor":


?>
      <h1 align="center"><?php echo $loginname; ?></br>#ID:<?php echo $login_session; ?></h1>
      <p align="center" style=" margin-left: 50px;margin-top: -30px;"> <?php #echo $login_role ; ?></p>
      </br>

		<div align="center">
		<ul >

		  <li><a href="doctorsrole.php"><span>As Doctor </span></a></li>
      <li ><a href="finddoctor.php?id=<?php echo"$login_session";?>"><span>Find Doctor</span></a></li>
      <li><a href="serial.php"><span>My Serial</span></a></li>
      <li><a href="prescriptionlist.php?id=<?php echo"$login_session";?>"><span>Medical History</span></a></li>
      <li><a href="reportlist.php?id=<?php echo"$login_session";?>"><span>Medical Report </span></a></li>
      <li><a href="family_member.php"><span>Family Member </span></a></li>
      <li><a href="blooddonation.php" ><span>Blood Bank </span></a></li>
      <li><a href="updatepersonalinfo.php"><span>Update Info</span></a></li>
		</ul>
		</div>

<?php
        break;
    case "hospital":

?>
      <h1 align="center"><?php echo $loginname; ?></h1>
	  <p align="center" style=" margin-left: 50px;margin-top: -30px;"> <?php echo $login_role ; ?></p>



		<div align="center">
		<ul >
		<li><a href=".php"><span>Edit hospital Info </span></a></li>
		<li ><a href=".php"><span>Add Doctor/Staff </span></a></li>
		<li ><a href=".php"><span>Create Visiting Slot</span></a></li>
		<li><a href=".php"><span>Add Service(Pricing)</span></a></li>
		<!-- <li><a href=""><span>Remove Teacher/Clark </span></a></li>
		<li ><a href="#"><span>Remove Subject </span></a></li>
		<li ><a href="#"><span>Remove  Fees Type</span></a></li> -->



		</ul>
		</div>

<?php
        break;
case "pharmacy":
?>
      <h1 align="center"><?php echo $loginname; ?></h1>
	  <p align="center" style=" margin-left: 50px;margin-top: -30px;"> <?php echo $login_role ; ?></p>

		<div align="center">
		<ul >
		<li><a href="#.php"><span>Edit Your Info </span></a></li>
		<li ><a href="#.php"><span>Customers Prescription </span></a></li>
		<li><a href="#.php"><span> </span></a></li>
		</ul>
		</div>


<?php
        break;
    default:

?>


<?php
}

?>


    <h5 align="center" text-color="red"><a href = "logout.php">Sign Out</a></h5>
   </body>

</html>
