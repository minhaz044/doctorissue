<?php


include("session.php");
include("DBcon.php");


if ($_POST['program']!="" && $_POST['institute']!="" && $_POST['pass_year']!="") {
	$program=mysqli_real_escape_string($con,$_POST['program']);
	$institute=mysqli_real_escape_string($con,$_POST['institute']);
	$pass_year=mysqli_real_escape_string($con,$_POST['pass_year']);

	$info_insert_query="INSERT INTO  doctors_educational_qualification (did,code_of_degree,institute,passing_year,status) VALUES('$login_session','$program','$institute','$pass_year',1) ";
	$info_insert_query_execute=mysqli_query($con,$info_insert_query);
	if($info_insert_query_execute){
		echo"Sucessfuly Added To your Academic Information";
	}else{
		echo"Wrong";
	}




}



?>
