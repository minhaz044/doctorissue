<?php


include("session.php");
include("DBcon.php");


if ($_POST['contact_no']!="") {

	$contact_no=mysqli_real_escape_string($con,$_POST['contact_no']);

	$info_insert_query="INSERT INTO  contact_table (account_no,contact_no,status) VALUES('$login_session','$contact_no',1) ";
	$info_insert_query_execute=mysqli_query($con,$info_insert_query);
	if($info_insert_query_execute){
		echo"Sucessfuly Added To your Academic Information";
	}else{
		echo"Wrong";
	}




}




?>
