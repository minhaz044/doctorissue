<?php
include("session.php");
include("DBcon.php");
if(isset($_POST['ud_button']) && $_POST['ud_button']=="update_info"){

	$fname=mysqli_real_escape_string($con,$_POST['fname']);
	$lname=mysqli_real_escape_string($con,$_POST['lname']);
	$gender=mysqli_real_escape_string($con,$_POST['gender']);
	$dob=mysqli_real_escape_string($con,$_POST['dob']);
	$blood_group=mysqli_real_escape_string($con,$_POST['blood_group']);

	$blood_donation_date=mysqli_real_escape_string($con,$_POST['blood_donation_date']);
	$current_location=mysqli_real_escape_string($con,$_POST['current_location']);
	$query="UPDATE users SET fname='$fname',lname='$lname',gender='$gender',dob='$dob',blood_group='$blood_group',last_donation_date='$blood_donation_date', current_location='$current_location' WHERE accountno=$login_session ";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));

	if($login_role=="doctor"){
	$speciality=mysqli_real_escape_string($con,$_POST['ud_speciality']);
	$designation=mysqli_real_escape_string($con,$_POST['ud_designation']);
	$institution=mysqli_real_escape_string($con,$_POST['ud_institution']);

		$query2="UPDATE doctors_basic_info SET speciality='$speciality', designation='$designation',institution='$institution'  WHERE did=$login_session";
		$result=mysqli_query($con,$query2) or die(mysqli_error($con));

	}
	echo"Data Update Sucesfully";

}
else if(isset($_POST['ud_button']) && $_POST['ud_button']=="update_pass"){


	$opassword=mysqli_real_escape_string($con,$_POST['opassword']);
	$npassword=mysqli_real_escape_string($con,$_POST['npassword']);
	if($opassword==$login_password){
	$query="UPDATE users SET password='$npassword' WHERE accountno=$login_session AND password='$opassword'";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));
	$_SESSION['login_password']=$npassword;
	echo"Password Updated Sucesfully";
	}else{
		echo"Wrong Password ";
	}



}else{

}




?>
