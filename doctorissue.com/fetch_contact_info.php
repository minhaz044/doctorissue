<?php
include("session.php");
include("DBcon.php");
$doctors_id=mysqli_real_escape_string($con,$_POST['doctors_id']);
if($_POST['doctors_id']!="" && $_POST['doctors_id']==$login_session){

$contact_info_query="SELECT * FROM contact_table
WHERE  account_no=$doctors_id AND status=1 ";

$contact_info_query_result=mysqli_query($con,$contact_info_query) or die(mysqli_error($con));
?>
<h4><strong>Contact Number:</strong>
<?php
if(mysqli_num_rows($contact_info_query_result)>0){
   $i =1;
      while($contact_info_query_result_row = mysqli_fetch_assoc($contact_info_query_result)) {
        if(($i % 3)==0){

          ?>
        </br>
          <?php
        }
  echo $contact_info_query_result_row['contact_no'];$i++;?>
  <button class="btn btn-danger remove_academic_info_and_visiting_slot_info"type="button"id="<?php
  echo $contact_info_query_result_row['sid'];?>" name="contact_no">x</button>,
<?php
      }

}
?>

<button class="btn btn-success add_contact_info"type="button" name="button">+</button>
</h5>
<?php
}
else if($_POST['doctors_id']!=""){
  $contact_info_query="SELECT * FROM contact_table
  WHERE  account_no=$doctors_id AND status=1 ";

  $contact_info_query_result=mysqli_query($con,$contact_info_query) or die(mysqli_error($con));
  ?>
  <h4><strong>Contact Number:</strong>
  <?php
  if(mysqli_num_rows($contact_info_query_result)>0){
     $i =1;
        while($contact_info_query_result_row = mysqli_fetch_assoc($contact_info_query_result)) {
          if($i%3==0){?>
          </br>
            <?php
          }
          echo $contact_info_query_result_row['contact_no']; $i++;?>,


  <?php
        }

  }
  ?>
  </h5>
  <?php
}
?>
