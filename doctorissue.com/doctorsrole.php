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

button {
    background-color: #4CbF50;
    color: white;
    padding: 12px 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: center;
}
ul {
  list-style-type: none;

}
li a {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 5px 2px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 6px 4px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.3s;
    cursor: pointer;
	height:45px;
  	width:250px;
  	background-color: white;
    color: black;
    border: 2px solid #4CAF50;


}


li a:hover {
     background-color: #4CAF50;
    color: white;
}

</style>
      <title> I Am A Doctor </title>
   </head>

   <body >
<?php


$query="SELECT fname,lname  from users where accountno='$login_session'";
$execute=mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($execute);
$loginname= $row["fname"]." ".$row["lname"];
if($login_role =="doctor"){

?>
</br>  <h1 align="center"><?php echo $loginname; ?></br> #ID:<?php echo $login_session ?></h1>

  	  <p align="center" style=" margin-left: 50px;margin-top: -30px;"> <?php #echo $login_role ; ?></p>
      </br>
  		<div align="center">
  		<ul >
        <li><a href="doctorscember.php"><span>My Chamber </span></a></li>
  		  <li><a href="view_patient.php"><span>Search Patient</span></a></li>
        <li><a href="Prescriptionhistory.php"><span>Prescription Histry</span></a></li>
        <li><a href="creatslot.php"><span>Create Visiting Slot</span></a></li>

  		</ul>
  		</div>
<?php
}
else{
  header("location:index.php");
}

?>
   </body>

</html>
