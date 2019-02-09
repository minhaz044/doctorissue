
<?php
include("DBcon.php");
include("session.php");
include("gblfun.php");
$output='<table class="table table-Responsive table-hover table-condensed">';


if(isset($_POST["start"])&&isset($_POST["limit"])){

  $limit=(int)mysqli_real_escape_string($con,$_POST["limit"]);
  $start=(int)mysqli_real_escape_string($con,$_POST["start"]);


  $notifier_query="SELECT * FROM notification_for WHERE reciver_id=$login_session ORDER BY up_time DESC limit $start,$limit";
  $notifier_query_result= mysqli_query($con,$notifier_query) or die(mysqli_error($con));
  $output.='<tr><td><a disabled ><span>All Notification:</span></a></td></tr>';
  if($notifier_query_result && mysqli_num_rows($notifier_query_result)>0){
    while($notifier_query_result_search_row = mysqli_fetch_assoc($notifier_query_result)) {
      $temp_noti=$notifier_query_result_search_row['notification_id'];
      $notification_title_query="SELECT id,title,status FROM notification WHERE id=$temp_noti AND status=1";
      $notification_title_query_result= mysqli_query($con,$notification_title_query) or die(mysqli_error($con));
  $notification_title_query_result_row=mysqli_fetch_assoc($notification_title_query_result);

  if($notifier_query_result_search_row['status']==1 || $notifier_query_result_search_row['status']==2){
  $output.='<tr><td><a style="color:DodgerBlue;" href="notification.php?id='.$notifier_query_result_search_row['notification_id'].'"><span>'.$notification_title_query_result_row['title'].'</span></a></br>';
  if($notifier_query_result_search_row['status']==1){

  /*$update_new_id=$notifier_query_result_search_row['notification_id'];
  $update_new_query="UPDATE notification_for SET status=2 WHERE id='$update_new_id'";
  $update_new_query_result= mysqli_query($con,$update_new_query) or die(mysqli_error($con));
  */
  }
  }
  else{
  $output.='<tr><td><a style="color:black;" href="notification.php?id='.$notifier_query_result_search_row['notification_id'].'"><span>'.$notification_title_query_result_row['title'].'</span></a></td></tr>';

  }


    }

    }

echo $output;
}

?>
