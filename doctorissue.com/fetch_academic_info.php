
<?php
include("session.php");
include("DBcon.php");

$output='<h3> <strong>Acamedic Information:</strong> </h3>
<table class="table " align="center">
  <tr align="center">
      <th align="center"><strong>Degree</strong></th><th><strong>Institution</strong></th>
  </tr>';
  $doctors_id=mysqli_real_escape_string($con,$_POST['doctors_id']);
if($_POST['doctors_id']!="" && $_POST['doctors_id']==$login_session){

//**************Fetch basic Info *********************************//
$academic_info_query="SELECT sid,code_of_degree,institute
                  FROM doctors_educational_qualification
                  WHERE did=$doctors_id AND status=1";
                $academic_info_query_result=mysqli_query($con,$academic_info_query) or die(mysqli_error($con));


                  if(mysqli_num_rows($academic_info_query_result)>0){
                        while($academic_info_query_result_row = mysqli_fetch_assoc($academic_info_query_result)) {

$output.='<tr>
      <td>'.$academic_info_query_result_row['code_of_degree'].'</td>
      <td>'.$academic_info_query_result_row['institute'].'</td>
      <td><button type="button" class="btn btn-danger remove_academic_info_and_visiting_slot_info" id="'.$academic_info_query_result_row['sid'].'" name="academic_info">X</button></td>
</tr>';

                        }

                  }
                  else {

                  }




$output.='<tr>
    <td></td><td></td>
    <td><button type="button" class="btn btn-success add_academic_info" name="button"><strong>+</strong></button></td>
</tr>
</table>
';





























  echo "$output";
}



else if ($_POST['doctors_id']!="" && $_POST['doctors_id']!=$login_session) {


  $academic_info_query="SELECT code_of_degree,institute
                    FROM doctors_educational_qualification
                    WHERE did=$doctors_id AND status=1";


                  $academic_info_query_result=mysqli_query($con,$academic_info_query) or die(mysqli_error($con));


                    if(mysqli_num_rows($academic_info_query_result)>=0){
                          while($academic_info_query_result_row = mysqli_fetch_assoc($academic_info_query_result)) {

  $output.='<tr>
        <td>'.$academic_info_query_result_row['code_of_degree'].'</td>
        <td>'.$academic_info_query_result_row['institute'].'</td>
  </tr>';

                          }

                    }
                    else {

                    }




  $output.='
  </table>
  ';

  echo "$output";

}else {

}
