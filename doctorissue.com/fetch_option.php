<?php
include("session.php");
if(isset($_POST["action"] ))
{
include("DBcon.php");
 $output = '';
 if($_POST["choice"] =="1")
 {
  $query = "SELECT *  FROM hospital_by_district WHERE dis_id ='".mysqli_real_escape_string($con,$_POST["district_code"])."'";
  $result = mysqli_query($con, $query);
   $output = ' <option value="">Select Hospital</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["hospital_id"].'">'.$row["hospital_name"].'</option>';
  }
   echo $output;
 }




else if($_POST["choice"] =="0")
{
 $query = "SELECT *  FROM specialist_type WHERE status=1";
 $result = mysqli_query($con, $query);
  $output = ' <option value="">Select specialist</option>';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '<option value="'.$row["s_id"].'">'.$row["type_name"].'</option>';
 }
    echo $output;
}
else {

      echo $output;
}
}
?>
