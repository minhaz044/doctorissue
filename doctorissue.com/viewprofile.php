<?php
include("session.php");
include("DBcon.php");
if(isset($_POST['appointment']))
{
  $sid=mysqli_real_escape_string($con,$_POST['serial_id']);
//  echo"$sid";
  date_default_timezone_set('Asia/Dhaka');
  $date_time=date('y-m-d h:i:s');
  $var="active";
  $query="INSERT INTO serialno(sid,patientid,date_time,status) values ('$sid','$login_session','$date_time','$var')";
  $execute=mysqli_query($con,$query) or die(mysqli_error($con));
  if(!$execute){
    echo"Something Went Wrong";
  }
}
$id=mysqli_real_escape_string($con,$_GET["id"]);
$query="SELECT *  from serialinfo where did='$id' and status='1'";
$execute=mysqli_query($con,$query) or die(mysqli_error($con));
?>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 80%;
	border: 3px solid #dddddd;

}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;

}
th{

	text-align:center;
}


tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<div align="center" >

<table >
  <tr>
    <th><strong>Date</strong></th>
	   <th ><strong>Time</strong></th>
    <th><strong>Address</strong></th>
	   <th ><strong>Make An Appointment</strong></th>
  </tr>

 <?php

 if(mysqli_num_rows($execute)>0){


	 while($row = mysqli_fetch_assoc($execute)){
?>

<tr>
	<td><?php echo $row["s_date"]; ?></td>
  <td><?php echo "$row[s_from] -- $row[s_to]";?></td>
	<td><?php echo $row["address"];?></td>
	<td>
    Java script Use kora lagbe 
    <form action="viewprofile.php?id=<?php echo"$id"?>" method="POST">
      <input type="hidden" name="serial_id"value="<?php echo $row["sid"];?>">
    <input type="submit" value="Appointment" name="appointment">
  <td>
</tr>
<?php
  }
}
?>
</table>
</div>
</body>
</html>
