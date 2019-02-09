<?php
include("session.php");





if(isset($_POST['submit_blood_request'])  && $_POST["token"]==$_SESSION["token"])
{

  $blood_group=mysqli_real_escape_string($con,$_POST['ud_blood_group']);
  $district_code=mysqli_real_escape_string($con,$_POST['district']);
  $token=$_POST["token"];
  $contact_number=mysqli_real_escape_string($con,$_POST['contact_number']);
  $n_body=mysqli_real_escape_string($con,$_POST['n_body']);
  $n_title="Need"." ".$blood_group." "."Blood For"." ".$contact_number;
  if($blood_group!="" && $district_code!="" && $contact_number!="" && $n_body!="" && $n_title!="" ){
    include("DBcon.php");
    $insert_query1="INSERT INTO notification (sender,title,body,notification_type,status) VALUES('$login_session','$n_title','$n_body','1',1)";
   $insert_query_result1=mysqli_query($con,$insert_query1) or die(mysqli_error($con));
   $notification_id = mysqli_insert_id($con);
   $trigger_point=0;
   if($insert_query_result1){

     $fetch_reciver="SELECT accountno,dob,blood_group,last_donation_date,last_blood_notification,current_location,verification_status
      FROM users
      WHERE blood_group='$blood_group'AND  verification_status=1 AND current_location=$district_code AND DATEDIFF(CURRENT_TIMESTAMP,dob)/360 >=16
      AND DATEDIFF(CURRENT_TIMESTAMP,last_donation_date)>=90 ORDER BY last_blood_notification ASC LIMIT 50";
    $fetch_reciver_result=mysqli_query($con,$fetch_reciver) or die(mysqli_error($con));

   $trigger_point=0;
    if(mysqli_num_rows($fetch_reciver_result)>0){

      while($fetch_reciver_optin_row = mysqli_fetch_assoc($fetch_reciver_result)) {
        $trigger_point++;

        $temp_reciver=$fetch_reciver_optin_row['accountno'];
     $insert_query2="INSERT INTO notification_for (reciver_id,notification_id,status) VALUES('$temp_reciver','$notification_id',1)";
    $insert_query_result2=mysqli_query($con,$insert_query2) or die(mysqli_error($con));
    if($insert_query_result2){
      $update_query="UPDATE users SET last_blood_notification=CURRENT_TIMESTAMP WHERE accountno=$temp_reciver ";
      $update_query_result=mysqli_query($con,$update_query) or die(mysqli_error($con));

    }

}
}
echo "Notefication Sent To ".$trigger_point." People in this Area";

     $_SESSION["token"] = rand(10000,99999);
   }
   else{

       echo "Data INSERT Failed";

   }




    mysqli_close($con);

  }


}
else{
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blood Donation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>

</style>
</head>
<body>
  <?php  include("sidenav.php"); ?>

<div class="container">
  <h2 ></h2>
  <form method="POST"class="form-horizontal" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="area">Location:</label>
      <div class="col-sm-10">
        <select name="district" id="district" class="form-control Responsive dts" required>
            <option value="">Select District</option>
            <?php echo fetch_district(); ?>
           </select>
      </div>
    </div>





    <div class="form-group">
      <label class="control-label col-sm-2" for="blood group">Blood Group:*</label>
      <div class="col-sm-10">
        <select id="ud_blood_group" class="form-control Responsive dts"name="ud_blood_group"required>
          <option value="">Select Blood Group+</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
       </select></br>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contact_number">Contact Number:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="contact_number" placeholder="Phone Number " name="contact_number" required>
      </div>
    </div>




    <div class="form-group">
      <label class="control-label col-sm-2" for="n_body">Detail Information:</label>
      <div class="col-sm-10">
        <textarea rows="4" class="form-control"  cols="50" id="n_body" name="n_body" required ></textarea>

      </div>
    </div>
    <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
     echo  $_SESSION["token"] ;?>">

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" name="submit_blood_request">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
<?php } ?>
