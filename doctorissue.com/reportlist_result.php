
<?php
include("DBcon.php");
include("session.php");
  $output="";
  $is_family=0;
  $is_doctor=0;
if(isset($_POST["id"])){
  $output.='<table class="table table-Responsive table-hover table-condensed">';
  $user_id=(int)mysqli_real_escape_string($con,$_POST["id"]);
//family Check Function
$member_check_query1="SELECT * FROM family_member WHERE ( sender='$login_session' AND reciver='$user_id' ) OR (sender='$user_id' AND reciver='$login_session') AND status=1";
$member_check_result1=mysqli_query($con,$member_check_query1) or die(mysqli_error($con));
    if(mysqli_num_rows($member_check_result1)>0){
  $is_family=1;
}else if($role_check='doctor'){
$is_doctor=1;

}else {
$is_family=0;
$is_doctor=0;
}

if($user_id==$login_session){

  $output.='<tr>
            <th width="30%" align="center"><strong>Report</strong></th>
            <th width="10%"align="left"><strong>Detail</strong></th>
            <th width="10%"align="left"><strong>Visibility</strong></th>
          </tr>';
          $search_query="SELECT *  FROM report WHERE user_id =$user_id  Order by submisson_date DESC ";

}
elseif($is_family==1 || $is_doctor==1) {
#Family mood need to add here
  $output.='<tr>
            <th width="50%" align="center"><strong>Report</strong></th>
            <th width="30%"align="left"><strong>Detail</strong></th>
          </tr>';
          $search_query="SELECT *  FROM report WHERE user_id =$user_id AND access=0 Order by submisson_date DESC ";
  }
  else {

    #Nothing Will Happend
  }

$search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
if($search_execute && mysqli_num_rows($search_execute)>0){
  while($search_row = mysqli_fetch_assoc($search_execute)) {
  $info_query="SELECT fname,lname  FROM users WHERE accountno ='$search_row[doctors_id]'";
  $info_execute=mysqli_query($con,$info_query) or die(mysqli_error($con));
  if(mysqli_num_rows($info_execute)>0){
    $info_row = mysqli_fetch_assoc($info_execute);
if($user_id==$login_session ){
$output.='<tr class="">
            <td class="">'.$info_row['fname'].$info_row['lname']."(".$search_row['submisson_date'].")".'</td>
            <td ><a href="uploads/'.$search_row['file'].'" target="_blank"> <button  class="view_data btn btn-success " type="button">View</button></a></td>
            ';

  if ($search_row['access']==0) {
  $output.='<td ><button  class="visibility_btn btn btn-success " type="button" name="" id="'.$search_row['report_id'].'">ON</button></td>';
}else {
$output.='<td ><button  class="visibility_btn btn btn-danger " type="button" name="" id="'.$search_row['report_id'].'">OFF</button></td>
</tr>';
}

}
else if($is_family==1 || $is_doctor==1){

  $output.='<tr class=""><td>'.$info_row['fname'].$info_row['lname']."(".$search_row['submisson_date'].")".'</td>
            <td ><a href="uploads/'.$search_row['file'].'" target="_blank"> <button  class="view_data btn btn-success " type="button">View</button></a></td>
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
