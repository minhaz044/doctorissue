<?php
include("session.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="")
    {
      include("DBcon.php");
      $report_id=mysqli_real_escape_string($con,$_POST['select_btn_val']);
      $chk_query="SELECT report_id,access from  report WHERE report_id='$report_id'";
      $chk_execute=mysqli_query($con,$chk_query) or die(mysqli_error($con));
      $chk_row = mysqli_fetch_assoc($chk_execute);
      if($chk_row['access']==0){
              $query="UPDATE report SET access=1  WHERE report_id='$report_id'";
      }
       if($chk_row['access']==1){
              $query="UPDATE report SET access=0  WHERE report_id='$report_id'";
            }

      $execute=mysqli_query($con,$query) or die(mysqli_error($con));

    }
    else{
      echo "Something Went Wrong";
    }
?>
