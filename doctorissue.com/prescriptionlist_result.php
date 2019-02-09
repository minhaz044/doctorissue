
<?php
include("DBcon.php");
include("session.php");
include("gblfun.php");
  $output="";


if(isset($_POST["id"])){

  $output.='<table class="table table-Responsive table-hover table-condensed">';
  $user_id=(int)mysqli_real_escape_string($con,$_POST["id"]);
	  $is_family=family_status($login_session,$_POST["id"]);
	  $is_doctor=user_identity($login_session);


if($is_family==0){

  $output.='<tr>
            <th width="30%" align="center"><strong>prescription</strong></th>
            <th width="10%"align="left"><strong>Detail</strong></th>
            <th width="10%"align="left"><strong>Save</strong></th>
            <th width="10%"align="left"><strong>Visibility</strong></th>
          </tr>';
          $search_query="SELECT *  FROM prescription WHERE user_id =$user_id  Order by submisson_date DESC ";

}
elseif($is_family==1) {
#Family mood need to add here
  $output.='<tr>
            <th width="50%" align="center"><strong>prescription</strong></th>
            <th width="30%"align="left"><strong>Detail</strong></th>
          </tr>';
          $search_query="SELECT *  FROM prescription WHERE user_id =$user_id AND access=1 Order by submisson_date DESC ";
  }
 elseif($is_doctor==1 && account_visiblity($user_id)) {
#Family mood need to add here
  $output.='<tr>
            <th width="50%" align="center"><strong>prescription</strong></th>
            <th width="30%"align="left"><strong>Detail</strong></th>
          </tr>';
          $search_query="SELECT *  FROM prescription WHERE user_id =$user_id AND access=1 Order by submisson_date DESC ";
  }





  else {

              $search_query="SELECT *  FROM prescription WHERE user_id =$login_session AND access=1 AND access=0 Order by submisson_date DESC ";
  }

$search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
if($search_execute && mysqli_num_rows($search_execute)>0){
  while($search_row = mysqli_fetch_assoc($search_execute)) {
  $info_query="SELECT fname,lname  FROM users WHERE accountno ='$search_row[doctors_id]'";
  $info_execute=mysqli_query($con,$info_query) or die(mysqli_error($con));
  if(mysqli_num_rows($info_execute)>0){
    $info_row = mysqli_fetch_assoc($info_execute);
    //code reduce korte hobe
if($user_id==$login_session ){
$output.='<tr class="">
            <td class="">'.$info_row['fname']." ".$info_row['lname']."</br><small>".$search_row['submisson_date']."</small>".'</td>
            <td ><button  class="view_data btn btn-warning " type="button" name="view_data" id="'.$search_row['prescription_id'].'">View</button></td>
            <td ><a href="pdf_prescription.php?p_id='.$search_row['prescription_id'].'" target="_blank"><button  class="download_btn btn btn-success" type="button" name="download_btn" id="'.$search_row['prescription_id'].'"><span class="glyphicon glyphicon-save"></span></button></a></td>';

  if ($search_row['access']==1) {
  $output.='<td ><button  class="visibility_btn btn btn-success " type="button" name="" id="'.$search_row['prescription_id'].'">ON</button></td>';
}else {
$output.='<td ><button  class="visibility_btn btn btn-danger " type="button" name="" id="'.$search_row['prescription_id'].'">OFF</button></td>
</tr>';
}

}
else if($is_family==1 || $is_doctor==1){

  $output.='<tr class=""><td>'.$info_row['fname']." ".$info_row['lname']."</br><small>".$search_row['submisson_date']."</small>".'</td>
            <td ><button  class="view_data btn btn-success " type="button" name="view_data" id="'.$search_row['prescription_id'].'">View</button></td>
            </tr>';

}
else {
  # code...
}
}
}
}
$output.='<tr></tr></table>';
echo $output;
}
?>
