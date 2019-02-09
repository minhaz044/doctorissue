<?php
include("session.php");
if(isset($_POST['notification_id']) ){
  include("DBcon.php");
  $notification_id=mysqli_real_escape_string($con,$_POST['notification_id']);
  $update_noti_query="UPDATE notification_for SET status=3  WHERE notification_id='$notification_id' AND reciver_id='$login_session' ";
  $update_noti_query_result = mysqli_query($con,$update_noti_query);




}




 ?>
