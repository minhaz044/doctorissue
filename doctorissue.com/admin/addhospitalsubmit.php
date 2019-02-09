<?php

include("../DBcon.php");
include("../session.php");
include("../gblfun.php");
if ($_POST['name_of_hospital']!="" && $_POST['hospital_address']!="" && $_POST['district_code']!="" ) {


$name_of_hospital=$_POST["name_of_hospital"];
$hospital_address=$_POST["hospital_address"];
$district_code=(int)$_POST["district_code"];
$output="Data Insertion Failed";

$query="SELECT * FROM hospital_by_district WHERE hospital_name='$name_of_hospital' AND dis_id='$district_code'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$num_of_row=mysqli_num_rows($result);

if($num_of_row==0){


  $query="INSERT INTO hospital_by_district(dis_id, hospital_name, address, status) VALUES ('$district_code','$name_of_hospital','$hospital_address',1)";
$result=mysqli_query($con,$query) or die(mysqli_error($con));

if($result){
$output="Hospital Added Sucessfuly";
}

}else {
  $output="Hospital Already Is In DataBase\n Duplicate Data Makes Confusion ";
}

echo $output;
}
else{

  $output="Input Field Is Empty";
  echo $output;

}

 ?>
