<?php
 include('session.php');
 include('DBcon.php');
 include("sidenav.php");

 ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>
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

      <title> Welcome to E-Health </title>
   </head>

   <body >
<?php
if($_GET['id']!="" && $_GET['sid']!=""){


$id=mysqli_real_escape_string($con,$_GET['id']);
$sid=mysqli_real_escape_string($con,$_GET['sid']);
$query="SELECT fname,lname,dob  from users where accountno='$id'";
$execute=mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($execute);
$loginname= $row["fname"]." ".$row["lname"];
$age=intval(date('Y', time() - strtotime($row['dob']))) - 1970;
?>
    <p align="center" style=" margin-left: 50px;margin-top: 50px;"></p>
    <h1 align="center"><?php echo "$loginname";?></h1>
	  <p align="center" style="">Age :<?php echo $age; ?></p>
		<div align="center">
		<ul >
    <li><a href="prescription.php?id=<?php echo"$id"?>&sid=<?php echo$sid?>"><span>New Prescription</span></a></li>
    <li><a href="prescriptionlist.php?id=<?php echo"$id";?>"><span>Previous Prescription</span></a></li>
    <li><a href="uploadreport.php?id=<?php echo"$id";?>&sid=<?php echo$sid?>"><span>New Report</span></a></li>
    <li><a href="reportlist.php?id=<?php echo"$id";?>"><span>Previous Report</span></a></li>

		</ul>
		</div>
   </body>
<?php } ?>


</html>
