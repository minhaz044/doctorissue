<?php

include("DBcon.php");
include("session.php");

$output="3";
if(isset($_POST['select_btn_val'])){
  if($_POST['select_btn_val']!=""){




    $verification_code=mysqli_real_escape_string($con,$_POST['select_btn_val']);
    $query="SELECT * from verification_code WHERE accountno='$login_session' AND status=1 AND code='$verification_code' ";
    $execute=mysqli_query($con,$query);
    $count = mysqli_num_rows($execute);
    if($count == 1) {
      $query1="UPDATE users SET  verification_status= 1 WHERE accountno='$login_session'";
      $execute1=mysqli_query($con,$query1);
      $query2="UPDATE verification_code SET  status= 0 WHERE accountno='$login_session'";
      $execute2=mysqli_query($con,$query2);

      $output="1";



    }
    else{
      $output="0";

    }


  }

}
  echo $output
?>
