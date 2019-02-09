
<?php
include("DBcon.php");
include("session.php");
include("gblfun.php");
  $output="";


if(isset($_POST["start"])&&isset($_POST["limit"]) && $login_role=='doctor'){

  $limit=(int)mysqli_real_escape_string($con,$_POST["limit"]);
  $start=(int)mysqli_real_escape_string($con,$_POST["start"]);




$search_query="SELECT *  FROM prescription WHERE doctors_id =$login_session  Order by submisson_date DESC LIMIT $start,$limit";
$search_execute=mysqli_query($con,$search_query) or die(mysqli_error($con));
if($search_execute && mysqli_num_rows($search_execute)>0){
  $output='<table class="table table-Responsive table-hover table-condensed">';

  while($search_row = mysqli_fetch_assoc($search_execute)) {
  $info_query="SELECT fname,lname,accountno  FROM users WHERE accountno ='$search_row[user_id]'";
  $info_execute=mysqli_query($con,$info_query) or die(mysqli_error($con));
  if(mysqli_num_rows($info_execute)>0){
    $info_row = mysqli_fetch_assoc($info_execute);
    //

$output.='
<tr>
        <td >'.$info_row['fname']." ".$info_row['lname'].'(#ID:'.$info_row['accountno'].')'."</br><small>".$search_row['submisson_date']."</small>".'</td>
        <td ><button  class="view_data btn btn-warning " type="button" name="view_data" id="'.$search_row['prescription_id'].'">View</button></td>
</tr>';

}

    }
  }

echo $output;
}

?>
