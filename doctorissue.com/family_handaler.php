<?php
      include("DBcon.php");
      include("session.php");

    if(isset($_POST['select_btn_val']) && $_POST['select_btn_val']!="")
    {

      $member_id=mysqli_real_escape_string($con,$_POST['select_btn_val']);
      $btn_text="";
      include("gblfun.php");
      $is_family=family_status($login_session,$member_id);
      if ($is_family==0) {
        $query="";
        $btn_text="";
      }
      elseif ($is_family==1) {
        $query="DELETE FROM family_member WHERE  (sender='$member_id' AND reciver='$login_session' AND status=1) OR ( sender='$login_session'AND  reciver='$member_id' AND status=1) ";
        $btn_text="Add Family";
      }
      elseif ($is_family==2) {
        $query="DELETE FROM family_member WHERE  sender='$login_session'AND  reciver='$member_id' AND status=0 ";
        $btn_text="Add Family";
      }
      elseif ($is_family==3) {
        $query="UPDATE family_member SET  status=1 WHERE reciver='$login_session'AND  sender='$member_id' AND status=0 ";
        $btn_text="Family";
      }
      else {
        $query="INSERT INTO family_member (sender,reciver,status,action_id)
        VALUES ('$login_session','$member_id',0,0); ";
        $btn_text="Cancel";
      }

      $execute=mysqli_query($con,$query) or die(mysqli_error($con));


      if($execute){
            echo $btn_text;
      }
      else {
        ?>
        <script type="text/javascript">
        alert("A Visiting Slot is Created Sucessfuly.\n To see the slot Go to ");
        </script>
    <?php
      }

    }
    else{
      echo "Something Went Wrong";
    }
?>
