<!DOCTYPE html>
<?php
include("session.php");
include("DBcon.php");
if($_GET['d_id']!=""){
  $doctors_id=mysqli_real_escape_string($con,$_GET['d_id']);
  $basic_info_query="SELECT accountno, id, CONCAT(fname,' ',lname) AS name, gender
  FROM users
  WHERE  accountno=$doctors_id ";

  $basic_info_query_result=mysqli_query($con,$basic_info_query) or die(mysqli_error($con));
  $basic_info_query_result_row = mysqli_fetch_assoc($basic_info_query_result);




 ?>
<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/res.css">
    <script src="jquery.js" ></script>
      <script src="jquery.min.js" ></script>
    <script src="css/js/bootstrap.min.js" ></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Doctors Profile</title>
    <style media="screen">
      img{
        border-radius: 50%;
      }
    </style>
  </head>
  <body bgcolor="red" >
<div class="container Responsive">

  <div class="" name="">
    <div class="" align="center">
      <img class ="img"src="propic\DSC_0181.JPG" alt="<?php echo $basic_info_query_result_row['name']; ?>" height="200px" width="200px" border-radius="50%">
    </div>
  <div class="info" align="center">

        <h2>  <strong><?php echo $basic_info_query_result_row['name']; ?></strong> </h2>
        <h3><?php echo $basic_info_query_result_row['id']; ?></h3>
<?php

$contact_info_query="SELECT * FROM contact_table
WHERE  account_no=$doctors_id";

$contact_info_query_result=mysqli_query($con,$basic_info_query) or die(mysqli_error($con));


if(mysqli_num_rows($contact_info_query_result)>=0){
      while($contact_info_query_result_row = mysqli_fetch_assoc($basic_info_query_result)) {
?>
        <h3><?php  echo $contact_info_query_result_row['contact_no']?>,</h3>
<?php
      }

}
else {

}


?>


        <p><?php echo $basic_info_query_result_row['gender']; ?></p>
  </div>

  <div class="" align="center">
    <button type="button" name="button" class="btn btn-success">Follow</button> <button type="button" class="btn btn-success" name="button"> Review</button>
  </div>
  </br>
  </div>
  <div class="table-Responsive"  >
    <h3> <strong>Acamedic Information:</strong> </h3>
    <table class="table " align="center">
      <tr align="center">
          <th align="center"><strong>Degree</strong></th><th><strong>Institution</strong></th>
      </tr>
<?php
//********************************************Fetch basic Info *****************************************************//
$academic_info_query="SELECT code_of_degree,institute
                      FROM doctors_educational_qualification
                      WHERE did=$doctors_id";


                    $academic_info_query_result=mysqli_query($con,$academic_info_query) or die(mysqli_error($con));


                      if(mysqli_num_rows($academic_info_query_result)>=0){
                            while($academic_info_query_result_row = mysqli_fetch_assoc($academic_info_query_result)) {
                      ?>

                          <tr>
                                <td><?php echo $academic_info_query_result_row['code_of_degree'];?></td>
                                <td>  <?php echo $academic_info_query_result_row['institute'];?></td>
                          </tr>


                      <?php
                            }

                      }
                      else {

                      }



?>


</table>
</div>
<div class="table-Responsive" >

  <h3> <strong>Available Time For Patient:</strong>  </h3>
<div class="" id="avi_time">

</div>
</div>
<div class="Review Section" align="center">
  <h1>Patient Review</h1>
<p>  <strong>Name Of Reviewer:</strong>  Patient Review </p>
</div>
</div>
  </body>
</html>
<?php
}
else{echo "No Access";}
 ?>






<script>

   $(document).ready(function(){


function fetch_visiting_slot(){
  var patient_id=<?php echo $_GET['id'];?>;
  var doctors_id=<?php echo $_GET['d_id'];?>;
  $.ajax({
    url: "fetch_visiting_slot.php",
    type:"POST",
    data:{patient_id:patient_id, doctors_id:doctors_id },
    success:function(data){
      $('#avi_time').html(data);

    }
  })
}
fetch_visiting_slot();

     $(document).on("click",".appointment_handaler",function(){

             var select_btn_val =$(this).attr("id");
             var day =$(this).attr("name");
             var btn_state=$(this).text();
             var patient_id=<?php echo $_GET['id'];?>;
             $.ajax({
               url: "appointment_handaler.php",
               type:"POST",
               data:{select_btn_val:select_btn_val, btn_state:btn_state, patient_id:patient_id ,day:day },
               success:function(data){
               fetch_visiting_slot();

               }
             })

             });





   });



 </script>
