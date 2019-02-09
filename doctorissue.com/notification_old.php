<?php
  include("session.php");
  include("DBcon.php");
  $update_noti_query="UPDATE notification_for SET status=2  WHERE reciver_id='$login_session'  AND up_time < CURRENT_TIMESTAMP 	  AND status=1" ;
  $update_noti_query_result = mysqli_query($con,$update_noti_query);





 ?>
