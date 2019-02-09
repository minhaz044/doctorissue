<?php
include("session.php");
include("DBcon.php");




if($_POST['request_id']!="" && $_POST['action_type']!="" && $login_role='admin'){


if($_POST['action_type']="accept"){



$request_id=mysqli_real_escape_string($con,$_POST['request_id']);
$action_type=mysqli_real_escape_string($con,$_POST['action_type']);

$query0="SELECT * FROM temp_doctors_basic_info WHERE sid='$request_id'";
$execute0=mysqli_query($con,$query0);
$result_row0 = mysqli_fetch_assoc($execute0);
$pic_link={$result_row0['picture'];
$user_id=$result_row0['user_id'];
$govt_id=$result_row0['govt_doc_id'];
$query1="UPDATE users SET role='doctor',profile_picture='$pic_link' where accountno='$user_id' AND role='basic'";
$execute1=mysqli_query($con,$query1);

	if(mysqli_affected_rows($con)==1){


	$query2="INSERT INTO doctors_basic_info(did,speciality,designation,institution,govt_reg_id) VALUES($login_session,0,'','','$govt_id') ";
	$execute2=mysqli_query($con,$query2);
	if(mysqli_affected_rows($con)==1){

?>


<script type="text/javascript">

	alert("Sucessfull. \nPlease Login");
</script>

<?php
		header("location:logout.php");


	}
}
	else{
		echo"Error Code:bad-2";

	}
















}elseif($_POST['action_type']="reject"){


	$request_id=mysqli_real_escape_string($con,$_POST['request_id']);
	$action_type=mysqli_real_escape_string($con,$_POST['action_type']);
	$query0="SELECT * FROM temp_doctors_basic_info WHERE sid='$request_id'";
	$execute0=mysqli_query($con,$query0);
	$result_row0 = mysqli_fetch_assoc($execute0);
	$user_id=$result_row0['user_id'];

		$query1="UPDATE temp_doctors_basic_info SET rejected=1 WHERE sid='$request_id' ";
		$execute1=mysqli_query($con,$query1);

		$insert_query2="INSERT INTO notification_for (reciver_id,notification_id,status) VALUES('$user_id',14,1)";
	 	$insert_query_result2=mysqli_query($con,$insert_query2) or die(mysqli_error($con));











}else{


}
$request_id=mysqli_real_escape_string($con,$_POST['request_id']);
$action_type=mysqli_real_escape_string($con,$_POST['action_type']);

$query0="SELECT * FROM temp_doctors_basic_info WHERE sid='$request_id'";
$execute0=mysqli_query($con,$query0);
$result_row0 = mysqli_fetch_assoc($execute0);


	$query1="UPDATE users SET role='doctor' profile_picture='$result_row0['picture']' where accountno='$result_row0['user_id']' AND role='basic'";
	$execute1=mysqli_query($con,$query1);

	if(mysqli_affected_rows($con)==1){


	$query2="INSERT INTO doctors_basic_info(did,speciality,designation,institution,govt_reg_id) VALUES($login_session,0,'','','$result_row0['govt_doc_id']') ";
	$execute2=mysqli_query($con,$query2);
	if(mysqli_affected_rows($con)==1){

?>


<script type="text/javascript">

	alert("Sucessfull. \nPlease Login");
</script>

<?php
		header("location:logout.php");


	}
}
	else{
		echo"Error Code:bad-2";

	}



}













?>
