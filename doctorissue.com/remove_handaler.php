<?php
include("session.php");
include("DBcon.php");


if (isset($_POST['slot_id']) && $_POST['action']=="visiting_slot") {
$slot_id=mysqli_real_escape_string($con,$_POST['slot_id']);

$delete_query="UPDATE serialinfo SET status=0 WHERE sid='$slot_id' AND did='$login_session'";
$result=mysqli_query($con,$delete_query) or die(mysqli_error($con));

    $basic_info_query="SELECT CONCAT(users.fname,' ',users.lname) AS name
    FROM users
    WHERE  accountno='$login_session'";
    $basic_info_query_result=mysqli_query($con,$basic_info_query) or die(mysqli_error($con));
    $basic_info_query_result_row = mysqli_fetch_assoc($basic_info_query_result);
    $n_title=$basic_info_query_result_row["name"].'(#ID:'.$login_session.')'.' Canceled Your visiting Slot';
    $slot_search_query="SELECT *
    FROM serialinfo
    WHERE sid='$slot_id' AND did='$login_session'";
    $slot_search_query_result=mysqli_query($con,$slot_search_query) or die(mysqli_error($con));
    if(mysqli_num_rows($slot_search_query_result)==1){
      $slot_search_query_result_row = mysqli_fetch_assoc($slot_search_query_result);
      $dt = strtotime($slot_search_query_result_row['s_date']);
      $day = date("l", $dt);
      $time_start = date( 'g:i A', strtotime( $slot_search_query_result_row['s_from'] ) );
      $time_end = date( 'g:i A', strtotime( $slot_search_query_result_row['s_to'] ) );
      $today=date('l', strtotime('today'));
      if($today==$day){
     $delete_query="UPDATE serialinfo SET status=0 WHERE sid='$slot_id' AND did='$login_session'";
     $result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
     $apointment_date=date('Y-m-d', strtotime('today'));
      }else{
      $tempday="next"." ".$day;
      $apointment_date=date('Y-m-d', strtotime($tempday));
      }
    $n_body='Date:'.$apointment_date.'('.$day.')'
    .'</br>Time:'.$time_start.'----'.$time_end.'</br>:'.$slot_search_query_result_row['address'];
    $insert_query1="INSERT INTO notification (sender,title,body,notification_type,status) VALUES('$login_session','$n_title','$n_body','1',1)";
    $insert_query_result1=mysqli_query($con,$insert_query1) or die(mysqli_error($con));
    $notification_id = mysqli_insert_id($con);

    $fetch_reciver="SELECT *  FROM serialno WHERE sid ='$slot_id' AND sereal_date ='$apointment_date' ";
    $fetch_reciver_result=mysqli_query($con,$fetch_reciver) or die(mysqli_error($con));

$trigger_point=0;
if(mysqli_num_rows($fetch_reciver_result)>0){

  while($fetch_reciver_optin_row = mysqli_fetch_assoc($fetch_reciver_result)) {
    $temp_reciver=$fetch_reciver_optin_row['patientid'];
 $insert_query2="INSERT INTO notification_for (reciver_id,notification_id,status) VALUES('$temp_reciver','$notification_id',1)";
$insert_query_result2=mysqli_query($con,$insert_query2) or die(mysqli_error($con));

          }
      }



  $output='visiting_slot';
 echo "$output";

}else {

}




}
else if (isset($_POST['slot_id']) && $_POST['action']=="academic_info") {
$slot_id=mysqli_real_escape_string($con,$_POST['slot_id']);
$delete_query="UPDATE doctors_educational_qualification SET status=0 WHERE sid='$slot_id' AND did='$login_session'";
$result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
if ($result) {
  $output='academic_info';
 echo "$output";
}else {

}




}
else if (isset($_POST['slot_id']) && $_POST['action']=="contact_no") {
$slot_id=mysqli_real_escape_string($con,$_POST['slot_id']);
$delete_query="UPDATE contact_table SET status=0 WHERE sid='$slot_id' AND status=1 ";
$result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
if ($result) {
  $output='Contact_no';
 echo "$output";
}else {

}




}
else{

}

 ?>
