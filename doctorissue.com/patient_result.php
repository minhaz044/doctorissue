<?php
include("session.php");
include("DBcon.php");
$output="";
$count=1;

    if(isset($_POST['select_slot_name']) && $_POST['select_slot_name']!="")
    {
      $output.='<table class=" table table-Responsive table-hover table-condensed">';
      list($serialid,$day)=explode("|",mysqli_real_escape_string($con,$_POST['select_slot_name']));
      $temp="next ".$day;
      if(date('l')==$day)
      {
        $date=date('Y-m-d');

      }
      else {
      $date=date('Y-m-d',strtotime($temp));
      }

        $search_query="SELECT *  FROM serialno WHERE sid ='$serialid' AND sereal_date ='$date' Order by p_rank ";
        $search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
        if($search_execute && mysqli_num_rows($search_execute)>0){
          while($search_row = mysqli_fetch_assoc($search_execute)) {
            $serial_info_query="SELECT *  FROM users WHERE accountno='$search_row[patientid]'";
            $serial_info_execute=mysqli_query($con,$serial_info_query) or die(mysqli_error($con));
        if(mysqli_num_rows($serial_info_execute)>0){
          $serial_info_row = mysqli_fetch_assoc($serial_info_execute);
          if ($search_row['is_visited']=="0" && $search_row['patientid']==$login_session) {
            $output.='<tr>
             <td class="greenclr" width="50%" >'.$count." . &nbsp&nbsp ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</td>
             <td width="50%"><a href="viewpatientprofile.php?id='.$search_row['patientid'].'&sid='.$serialid.'" target="_blank"><button class="btn " type="button" name="visit_patient" id="" value="">Visit</button></a>
             <button  class="is_visited_btn btn  active" type="button" name="is_visited_btn" id="'.$serialid."|".$search_row['patientid']."|".$date.'">Check</button></td>
           </tr>';
          }
          else if($search_row['is_visited']=="0"){
            $output.='<tr>
             <td class="success"  width="50%">'.$count." .&nbsp&nbsp  ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</td>
             <td width="50%"><a href="viewpatientprofile.php?id='.$search_row['patientid'].'&sid='.$serialid.'" target="_blank"><button class="btn " type="button" name="visit_patient" id="">Visit</button></a>
             <button  class="is_visited_btn btn  active" type="button" name="is_visited_btn" id="'.$serialid."|".$search_row['patientid']."|".$date.'">Check</button></td>
           </tr>';
          }
          else{
            $output.='<tr>
             <td class="redclr" width="50%">'.$count." .&nbsp&nbsp  ".$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</std>
             <td width="50%"><a href="viewpatientprofile.php?id='.$search_row['patientid'].'&sid='.$serialid.'" target="_blank"><button class="btn btn-warning" type="button" name="visit_patient" id="">Visit</button></a>
             <button  class=" btn btn-warning  disabled" type="button" name="btn_no_need" id="'.$serialid."|".$search_row['patientid']."|".$date.'">Checked</button></td>
           </tr>';
          }

            }
            $count++;
          }
        }else{
          $output.="<th>No Data Found</th>";
        }


}
else {
  $output.="<th>No Data Found</th>";
}
$output.='<td></td></table>';
  echo $output;
