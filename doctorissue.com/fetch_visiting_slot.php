<?php
include("DBcon.php");
include("session.php");
include("gblfun.php");
  $output="";
$is_family=family_status($login_session,$_POST["patient_id"]);
if(isset($_POST["patient_id"]) && isset($_POST["doctors_id"]) && ($is_family==0 || $is_family==1) && $_POST["doctors_id"]!=$login_session){
    $output.='
      <table class="table " align="center">
    <tr align="center">
        <th align="center"><strong>Day & Time</strong></th><th><strong>Detail Information </strong><strong>Status </strong></th>
    </tr>
    ';

$today=date("Y-m-d") ;
$doctors_id=mysqli_real_escape_string($con,$_POST["doctors_id"]);
$patient_id=mysqli_real_escape_string($con,$_POST["patient_id"]);
$slot_search_query="SELECT *
FROM serialinfo
WHERE did=$doctors_id AND status=1 AND slot_type=1 OR (slot_type=0 AND s_date>= CURDATE())  ";



$slot_search_query_result=mysqli_query($con,$slot_search_query) or die(mysqli_error($con));


if(mysqli_num_rows($slot_search_query_result)>0){
    while($slot_search_query_result_row = mysqli_fetch_assoc($slot_search_query_result)) {
      $dt = strtotime($slot_search_query_result_row['s_date']);
      $day = date("l", $dt);

      $time_start = date( 'g:i A', strtotime( $slot_search_query_result_row['s_from'] ) );
      $time_end = date( 'g:i A', strtotime( $slot_search_query_result_row['s_to'] ) );






    $today=date('l', strtotime('today'));
    if($today==$day){
     $apointment_date=date('Y-m-d', strtotime('today'));
    }
    else{
      $tempday="next"." ".$day;
      $apointment_date=date('Y-m-d', strtotime($tempday));
    }

    $output.='

<tr>
  <td>'.$day.' ('.date('d-m-Y', strtotime($apointment_date)).')</br>'.$time_start.'--'.$time_end.
  '</td><td>'.nl2br($slot_search_query_result_row['address'])
  .'</br><strong>New Patient :</strong>'.$slot_search_query_result_row['fees'].
  '</br><strong>Old Patient :</strong>'.$slot_search_query_result_row['fees_old'].

  '</td>';



$visiting_slot_id=$slot_search_query_result_row['sid'];

$TotalAppliedPatientQuery="SELECT  COUNT(sid) as TotalAppliedPatient FROM serialno WHERE sid ='$visiting_slot_id' AND sereal_date ='$apointment_date' ";
$TotalAppliedPatientQueryResult=mysqli_query($con,$TotalAppliedPatientQuery) or die(mysqli_error($con));
$TotalAppliedPatientQueryResultRow = mysqli_fetch_assoc($TotalAppliedPatientQueryResult);

    if(is_applied_for_serial($visiting_slot_id ,$apointment_date,$patient_id)){

      $output.='
    <td><button type="button" name="'.$day.'" id="'.$slot_search_query_result_row['sid'].'"class="btn btn-success appointment_handaler">Cancel</button>'.$TotalAppliedPatientQueryResultRow['TotalAppliedPatient'].'</td>
</tr>
';


    }

elseif($doctors_id==$patient_id){
	  $output.='
<td><button type="button" name="'.$day.'" id="'.$slot_search_query_result_row['sid'].'"class="btn btn-success disabled">Apply</button>'.$TotalAppliedPatientQueryResultRow['TotalAppliedPatient'].'</td>
</tr>
';

}
else {


  $output.='
<td><button type="button" name="'.$day.'" id="'.$slot_search_query_result_row['sid'].'"class="btn btn-success appointment_handaler">Apply</button>'.$TotalAppliedPatientQueryResultRow['TotalAppliedPatient'].'</td>
</tr>
';
}




    }

}

$output.='</table>';
echo $output;
}
elseif (isset($_POST["patient_id"]) && isset($_POST["doctors_id"]) && ($is_family==0 || $is_family==1) && $_POST["doctors_id"]==$login_session){












  $output.='
    <table class="table " align="center">
  <tr align="center">
      <th align="center"><strong>Day & Time </strong></th><th><strong>Detail Information </strong></th><th><strong>Status </strong></th>
  </tr>
  ';

$today=date("Y-m-d") ;
$doctors_id=mysqli_real_escape_string($con,$_POST["patient_id"]);
$patient_id=mysqli_real_escape_string($con,$_POST["patient_id"]);
$slot_search_query="SELECT *
FROM serialinfo
WHERE did=$doctors_id AND status=1 AND slot_type=1 OR (slot_type=0 AND s_date>= CURDATE())  ";



$slot_search_query_result=mysqli_query($con,$slot_search_query) or die(mysqli_error($con));


if(mysqli_num_rows($slot_search_query_result)>=0){
  while($slot_search_query_result_row = mysqli_fetch_assoc($slot_search_query_result)) {
    $dt = strtotime($slot_search_query_result_row['s_date']);
    $day = date("l", $dt);

    $time_start = date( 'g:i A', strtotime( $slot_search_query_result_row['s_from'] ) );
    $time_end = date( 'g:i A', strtotime( $slot_search_query_result_row['s_to'] ) );





  $today=date('l', strtotime('today'));
  if($today==$day){
   $apointment_date=date('Y-m-d', strtotime('today'));
  }
  else{
    $tempday="next"." ".$day;
    $apointment_date=date('Y-m-d', strtotime($tempday));
  }



      $output.='

  <tr>
    <td>'.$day.' ('.date('d-m-Y', strtotime($apointment_date)).')</br>'.$time_start.'--'.$time_end.
    '</td><td>'.nl2br($slot_search_query_result_row['address'])
    .'</br><strong>New Patient :</strong>'.$slot_search_query_result_row['fees'].
    '</br><strong>Old Patient :</strong>'.$slot_search_query_result_row['fees_old'].

    '</td>';


$visiting_slot_id=$slot_search_query_result_row['sid'];


$TotalAppliedPatientQuery="SELECT  COUNT(sid) as TotalAppliedPatient FROM serialno WHERE sid ='$visiting_slot_id' AND sereal_date ='$apointment_date' ";
$TotalAppliedPatientQueryResult=mysqli_query($con,$TotalAppliedPatientQuery) or die(mysqli_error($con));
$TotalAppliedPatientQueryResultRow = mysqli_fetch_assoc($TotalAppliedPatientQueryResult);



$output.='

<td><button type="button" name="visiting_slot" id="'.$slot_search_query_result_row['sid'].'"class="btn btn-danger remove_academic_info_and_visiting_slot_info">X</button>'.$TotalAppliedPatientQueryResultRow['TotalAppliedPatient'].'</td>
</tr>
';





  }

}

$output.='<tr>
    <td></td><td></td>
    <td><a href="creatslot.php"> <button type="button" class="btn btn-success add_degree" name="button"><strong>+</strong></button></a></td>
</tr>
</table>';
echo $output;

















}
else {
 echo "Unauthorized User";
}





?>
