<?php
include("session.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="")
    {
      include("DBcon.php");
      $prescription_id=mysqli_real_escape_string($con,$_POST['select_btn_val']);
      $chk_query="SELECT prescription_id,access from  prescription WHERE prescription_id='$prescription_id'";
      $chk_execute=mysqli_query($con,$chk_query) or die(mysqli_error($con));
      $chk_row = mysqli_fetch_assoc($chk_execute);
      if($chk_row['access']==0){
              $query="UPDATE prescription SET access=1  WHERE prescription_id='$prescription_id'";
      }
       if($chk_row['access']==1){
              $query="UPDATE prescription SET access=0  WHERE prescription_id='$prescription_id'";
            }

      $execute=mysqli_query($con,$query) or die(mysqli_error($con));

    }
    else{
      echo "Something Went Wrong";
    }
?>
