<?php
include('session.php');
include('DBcon.php');
include("sidenav.php");
 ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

      <title> Family Member Of Mine </title>
   </head>

   <body >
<?php
//Check if they are connected to each other(if they are family Check)
$f_m_id=mysqli_real_escape_string($con,$_GET['f_m_id']);

if(family_status($login_session,$f_m_id)==1){

  $query="SELECT fname,lname,accountno  from users where accountno='$f_m_id'";
  $execute=mysqli_query($con,$query) or die(mysqli_error($con));
  $row = mysqli_fetch_assoc($execute);
  $loginname= $row["fname"]." ".$row["lname"];
  ?>
  <h1 align="center"><?php echo $loginname; ?></br>#ID:<?php echo $f_m_id; ?></h1></br>

  	  <p align="center" style=" margin-left: 50px;margin-top: -30px;"> </p>
  		<div align="center">
  		<ul >
  		<li ><a href="finddoctor.php?id=<?php echo $row['accountno'];?>"><span>Find A Doctor</span></a></li>
      <li><a href="prescriptionlist.php?id=<?php echo $row['accountno'];?>"><span>Medical History</span></a></li>
      <li><a href="reportlist.php?id=<?php echo $row['accountno'];?>"><span>Medical Report </span></a></li>
      <li><a href="serial.php?id=<?php echo $row['accountno'];?>"><span>Sereal</span></a></li>
  		</ul>
  		</div>
  <?php
}
else{
	echo" :):):):):):):):):):):):)Invalid request:):):):):):):):):)";
}
?>

   </body>

</html>
