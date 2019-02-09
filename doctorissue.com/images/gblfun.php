<?php
include("session.php");
include("DBcon.php");
function family_status($me,$member){
  include("DBcon.php");
  if ($member==$me) {
    return 0;
  }
  $member_check_query1="SELECT * FROM family_member WHERE ( sender='$me' AND reciver='$member') or ( sender='$member' AND reciver='$me') ";
  $member_check_result1=mysqli_query($con,$member_check_query1) or die(mysqli_error($con));
  if(mysqli_num_rows($member_check_result1)>0){
    $row = mysqli_fetch_array($member_check_result1,MYSQLI_ASSOC);
    if ($row['sender']==$me && $row['reciver']==$member && $row['status']==0) {
      return 2;
    }
    elseif ($row['sender']==$member && $row['reciver']==$me && $row['status']==0) {
      return 3;
    }
    elseif (($row['sender']==$member && $row['reciver']==$me && $row['status']==1) || ($row['sender']==$me && $row['reciver']==$member && $row['status']==1)) {
    return 1;
    }
    else {
      return 5;
    }

}
else {
  return 4;
}
}

function fetch_district(){
  include("DBcon.php");
    $option_string="";
  $query="SELECT * FROM district_code";
    $result=mysqli_query($con,$query) or die(mysqli_error($con));

    if(mysqli_num_rows($result)>=0){
          while($row = mysqli_fetch_assoc($result)) {
        $option_string.='<option value="'.$row['dis_id'].'">'.$row['dis_name'].'</option>';

      }
}
else {

        $option_string.='<option value=""> No Element to Show</option>';

  }

return $option_string;
}

function is_applied_for_serial( $visiting_slot_id,$apointment_date,$patient_id){
  include("DBcon.php");
      $squery="SELECT *
      FROM serialno
      WHERE sid=$visiting_slot_id AND  	patientid=$patient_id AND DATE(sereal_date)='$apointment_date'  AND is_visited=0 ";

      $squery_result=mysqli_query($con,$squery) or die(mysqli_error($con));


      if(mysqli_num_rows($squery_result)){
        return 1;
      }
      else {
        return 0;
      }

}


?>
