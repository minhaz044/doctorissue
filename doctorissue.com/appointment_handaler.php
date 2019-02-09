<?php
      include("DBcon.php");
      include("session.php");
      include("gblfun.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="" && $_POST['btn_state']!="" && $_POST['patient_id']!="" && $_POST['day']!="" )
    {

      $serial_info_no=mysqli_real_escape_string($con,$_POST['select_btn_val']);
      $btn_state=mysqli_real_escape_string($con,$_POST['btn_state']);
      $patient_id=mysqli_real_escape_string($con,$_POST['patient_id']);
      $is_family=family_status($login_session,$patient_id);
       $current_date_time = date('Y-m-d H:i:s');
       $day=mysqli_real_escape_string($con,$_POST['day']);
       $today=date('l', strtotime('today'));
       if($today==$day){
        $apointment_date=date('Y-m-d', strtotime('today'));

       }
       else{
         $day="next"." ".$day;
         $apointment_date=date('Y-m-d', strtotime($day));
       }


    echo $apointment_date;
      if($btn_state=="Apply" && ($is_family==0 || $is_family==1 )){





          $query="INSERT INTO serialno(sid, patientid, sereal_date, p_rank, is_visited) VALUES ('$serial_info_no','$patient_id', '$apointment_date', '$current_date_time',0)";
          $execute=mysqli_query($con,$query) or die(mysqli_error($con));





        }
        else if($btn_state=="Cancel" && ($is_family==0 || $is_family==1 )){





                              $del_query="DELETE  FROM serialno
                               WHERE  sid=$serial_info_no
                              AND patientid=$patient_id AND date(sereal_date)='$apointment_date'  AND is_visited=0 "  ;
                              $execute=mysqli_query($con,$del_query) or die(mysqli_error($con));




        }
        else{

        }


      }

    else{
      echo "Something Went Wrong";
    }
?>
