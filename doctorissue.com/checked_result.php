<?php
include("session.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="")
    {
      include("DBcon.php");
      list($serialid,$patientid,$date)=explode("|",mysqli_real_escape_string($con,$_POST['select_btn_val']));
      $query="UPDATE serialno SET is_visited=1  WHERE sid='$serialid' AND patientid='$patientid' AND sereal_date='$date'";
      $execute=mysqli_query($con,$query) or die(mysqli_error($con));
      echo $execute."Done";
    }
    else{
      echo "Something Went Wrong";
    }
?>
