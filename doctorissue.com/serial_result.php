<?php
include("session.php");
include("DBcon.php");
include("gblfun.php");
$output="";
$count=1;
$output.='<table class="table table-Responsive table-hover table-condensed">';
    if(isset($_POST['select_slot_name']) && $_POST['select_slot_name']!="" && (family_status($login_session,$_POST['patient_id'])==1 || family_status($login_session,$_POST['patient_id'])==0) )
    {
      list($serialid,$date)=explode("|",mysqli_real_escape_string($con,$_POST['select_slot_name']));
        $patient_id=mysqli_real_escape_string($con,$_POST['patient_id']);
        $search_query="SELECT *  FROM serialno WHERE sid ='$serialid' AND sereal_date ='$date' Order by p_rank ";
        $search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
        if($search_execute && mysqli_num_rows($search_execute)>0){
          while($search_row = mysqli_fetch_assoc($search_execute)) {
            $serial_info_query="SELECT *  FROM users WHERE accountno='$search_row[patientid]'";
            $serial_info_execute=mysqli_query($con,$serial_info_query) or die(mysqli_error($con));
        if(mysqli_num_rows($serial_info_execute)>0){
          $serial_info_row = mysqli_fetch_assoc($serial_info_execute);
          if ($search_row['is_visited']=="0" && (family_status($login_session,$search_row['patientid'])==1 || family_status($login_session,$search_row['patientid'])==0)) {
            $find_doctors_id="SELECT did  FROM serialinfo WHERE sid ='$serialid'";
            $find_doctors_id_execute=mysqli_query($con,$find_doctors_id) or die(mysqli_error($con));
          $find_doctors_id_execute_row = mysqli_fetch_assoc($find_doctors_id_execute);

            $output.='<tr>
             <td><div class="linkab greenclr" align="center" >'.$count." .  ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</div></td>



             <td width="50%"><a href="doctorsprofile.php?d_id='.$find_doctors_id_execute_row['did'].'&id='.$patient_id.'" target="_blank"><button class="btn " type="button" >Visit</button></a></td>





           </tr>';
          }
          else if($search_row['is_visited']=="0"){
            $output.='<tr>select
             <td><div class="linkab greenclr" align="center" >'.$count." .  ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</div></td>
           </tr>';
          }
          else{
            $output.='<tr>
             <td><div class="linkab redclr" align="center"  >'.$count." .  ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</div></td>
           </tr>';
          }

            }
            $count++;
          }
        }


}
else {
  $output.="<th>No Data Found</th>";
}
$output.='<td></td></table>';
  echo $output;
