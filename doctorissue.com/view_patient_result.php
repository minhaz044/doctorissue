<?php
include("session.php");
include("DBcon.php");
$output="";
$count=1;

    if(isset($_POST['search_id']) && $_POST['search_id']!="")
    {
      $output.='<table class=" table table-Responsive table-hover table-condensed">
      <th></th>
      <th></th>';
      $patientid=mysqli_real_escape_string($con,$_POST['search_id']);
        $search_query="SELECT accountno,id  FROM  users WHERE accountno ='$patientid'";
        $search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
        if($search_execute && mysqli_num_rows($search_execute)>0){
          while($search_row = mysqli_fetch_assoc($search_execute)) {
            $serial_info_query="SELECT *  FROM users WHERE accountno='$search_row[accountno]'";
            $serial_info_execute=mysqli_query($con,$serial_info_query) or die(mysqli_error($con));
        if(mysqli_num_rows($serial_info_execute)>0){
          $serial_info_row = mysqli_fetch_assoc($serial_info_execute);
            $output.='<tr>
                       <td class="greenclr" width="50%" >'.$serial_info_row['fname']."&nbsp".$serial_info_row['lname'].'</td>
                       <td width="20%"><a href="viewpatientprofile.php?id='.$search_row['accountno'].'&&sid=0" target="_blank"><button class="btn btn-warning" type="button" name="visit_patient" id="">Visit</button></a>
                     </tr>';
          }

            }
          }
        else{
          $output.="<th>No Data Found</th>";
        }

}

$output.='<td></td></table>';
  echo $output;
