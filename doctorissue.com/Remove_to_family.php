<?php
include("session.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="")
    {
      include("DBcon.php");
      $member_id=mysqli_real_escape_string($con,$_POST['select_btn_val']);

      $query="DELETE FROM family_member WHERE  (sender='$member_id' AND reciver='$login_session' AND status=1) OR ( sender='$login_session'AND  reciver='$member_id') ";

      $execute=mysqli_query($con,$query) or die(mysqli_error($con));


      if($execute){
        echo "Sucessfuly Done";
      }
      else {
        ?>
        <script type="text/javascript">
        alert("A Visiting Slot is Created Sucessfuly.\n To see the slot Go to ");window.location.href='doctorsrole.php';
        </script>
    <?php
      }

    }
    else{
      echo "Something Went Wrong";
    }
?>
