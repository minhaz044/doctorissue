<!DOCTYPE html>
<?php
/***************submit the form *****************/
include("session.php");
include("sidenav.php");
include("DBcon.php");

if (isset($_FILES['profile_picture']) && $_POST["token"]==$_SESSION["token"] ) {

if(empty($_FILES['profile_picture']['name'])===true){
  echo"Please Select A File to upload";
}else{
  $allowed=array('jpg', 'jpeg', 'gif', 'png');
  $file_name=$_FILES['profile_picture']['name'];
  $file_extn=explode('.',$file_name);
  $file_extn=end($file_extn);
  $file_extn=strtolower($file_extn);
  $file_temp=$_FILES['profile_picture']['tmp_name'];
  $file_size = $_FILES['profile_picture']['size'];
  $new_size = $file_size/1024;
  if(in_array($file_extn,$allowed)){
    if($new_size <2000){
      change_profile_picture($login_session,$file_extn,$file_temp);

    }else{
          echo"Upload a File with in 2MB ";
    }




  }else{
    echo"Incorrect File Type.Allowed ";
    echo implode(',',$allowed);
  }



}




$_SESSION["token"] = rand(10000,99999);


}
 ?>
<?php


if($_GET['d_id']!="" && $_GET['d_id']!=$login_session){
  $doctors_id=$_GET['d_id'];
  $basic_info_query="SELECT users.accountno, users.id,users.profile_picture, CONCAT(users.fname,' ',users.lname) AS name, users.gender,doctors_basic_info.speciality,doctors_basic_info.designation,doctors_basic_info.institution
  FROM users,doctors_basic_info
  WHERE  accountno=$doctors_id
  AND did=accountno
  ";


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
      <img class ="img"src="<?php if(!empty($basic_info_query_result_row['profile_picture'])){
        echo $basic_info_query_result_row['profile_picture'];
      }
        else{
          if($basic_info_query_result_row['gender']==1){
              echo"Defined Default male";
          }elseif ($basic_info_query_result_row['gender']==2) {
                echo"Defined Default Female";
          }else{
                echo"Defined Default Image for other";
          }

        } ?>" alt="<?php echo $basic_info_query_result_row['name']; ?>" height="200px" width="200px" border-radius="50%">
    </div>
  <div class="info" align="center">
    <h2>  <strong></strong> </h2>
    <h2>  <strong>#ID:<?php echo $basic_info_query_result_row['accountno']; ?></br><?php echo $basic_info_query_result_row['name']; ?></strong> </h2>
    <h4><?php echo return_specialist_type($basic_info_query_result_row['speciality']); ?></h4>
    <h4><?php echo $basic_info_query_result_row['designation']; ?></h4>
    <h4><?php echo $basic_info_query_result_row['institution']; ?></h4>
    <div class="" id="contact_info">

    </div>



        <p><?php if($basic_info_query_result_row['gender']==1){echo "Male";}elseif ($basic_info_query_result_row['gender']==2) {
          echo "Female";}else{echo "Other";} ?></p>
  </div>

  <div class="" align="center">
    <button type="button" name="button" id="<?php echo $doctors_id ?>" class="btn btn-success">Follow</button> <button type="button" class="btn btn-success" name="button"> Review</button>
  </div>
  </br>
  </div>
  <div class="table-Responsive"  >
    <div class="" id="academic_info">

    </div>
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
elseif ($_GET['d_id']!="" && $_GET['d_id']==$login_session && $login_role="doctor") {
/********************************Show My Profile**********************/
$doctors_id=$_GET['d_id'];
$basic_info_query="SELECT users.accountno, users.id,users.profile_picture, CONCAT(users.fname,' ',users.lname) AS name, users.gender,doctors_basic_info.speciality,doctors_basic_info.designation,doctors_basic_info.institution
FROM users,doctors_basic_info
WHERE  accountno=$doctors_id
AND did=accountno
";

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
    <img class ="img"src="<?php if(!empty($basic_info_query_result_row['profile_picture'])){
      echo $basic_info_query_result_row['profile_picture'];
    }
      else{
        if($basic_info_query_result_row['gender']==1){
            echo"Defined Default male";
        }elseif ($basic_info_query_result_row['gender']==2) {
              echo"Defined Default Female";
        }else{
              echo"Defined Default Image for other";
        }

      } ?>" alt="<?php echo $basic_info_query_result_row['name']; ?>" height="200px" width="200px" border-radius="50%">
        <form class="" action="" method="post" enctype="multipart/form-data" >
          <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
           echo  $_SESSION["token"] ;?>">
          <input class="" type="file" name="profile_picture" value="" ><button type="submit">Upload</button>


        </form>

  </div>
<div class="info" align="center">

  <h2>  <strong><?php echo $basic_info_query_result_row['name']; ?></strong> </h2>
  <h4><?php echo return_specialist_type($basic_info_query_result_row['speciality']); ?></h4>
  <h4><?php echo $basic_info_query_result_row['designation']; ?></h4>
  <h4><?php echo $basic_info_query_result_row['institution']; ?></h4>
  <h4><?php echo $basic_info_query_result_row['id']; ?></h4>
  <div class="" id="contact_info">

  </div>


<p><?php if($basic_info_query_result_row['gender']==1){echo "Male";}elseif ($basic_info_query_result_row['gender']==2) {
  echo "Female";}else{echo "Other";} ?></p>
</div>

<div class="" align="center">
  <button type="button" name="button" id="<?php echo $doctors_id ?>" class="btn btn-success"><i>Save</i></button> <button type="button" class="btn btn-success" name="button"> Review</button>
</div>
</br>
</div>
<div class="table-Responsive"  >
  <div class="" id="academic_info">

  </div>


<!----------------->
<div id="dataModal" class="modal fade">

  <div  class="modal-dialog">
    <div  class="modal-content">
      <div  class="modal-header">
        <button type="button" name="button" class="close" data-dismiss="modal">X</button>
          <h4 class="modal-title">Academic Information</h4>
      </div>

      <div class="modal-body" id="academic_info">



<form></br>
      <p>Name Of Degree</p>
      <input  type="text" name="select_edu_program" id="select_edu_program" class="form-control"required>
      </br>
      <p>Institution:</p>
      <input  type="text" name="edu_ins" id="edu_ins" class="form-control">
      </br>
      <p>Passing Year:
      <input  name="edu_passing_year" id="edu_passing_year" type="year" class="form-control" required> </p></br></br>
       <input type="button" class="btn btn-success add_academic_info_button" data-dismiss="modal" value="Submit" name="">
</form>
      </div>

      <div class="modal-footer">
          <button type="button" name="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!---------------------------->
<div id="contactdatamodal" class="modal fade">

  <div  class="modal-dialog">
    <div  class="modal-content">
      <div  class="modal-header">
        <button type="button" name="button" class="close" data-dismiss="modal">X</button>
          <h4 class="modal-title">Add Contact Number</h4>
      </div>

      <div class="modal-body" id="addcontact">



<form>
</br>
      <p>Contact Number</p>
      <input  type="text" name="contact_info_field" id="contact_info_field" class="form-control"required>
      </br>
       <input type="button" class="btn btn-success add_contact_info_button" data-dismiss="modal" value="Submit" name="">
</form>
      </div>

      <div class="modal-footer">
          <button type="button" name="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>














<!----------------------------End-------------------------->

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
/****************************End*************************************/
}
else{echo "No Access";}
 ?>






<script>
var fetch_aca_info_status=0;
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
function fetch_academic_info(){
  var doctors_id=<?php echo $_GET['d_id'];?>;
  $.ajax({
    url: "fetch_academic_info.php",
    type:"POST",
    data:{doctors_id:doctors_id },
    success:function(data){

      $('#academic_info').html(data);



    }
  })
}
function fetch_contact_info(){
  var doctors_id=<?php echo $_GET['d_id'];?>;
  $.ajax({
    url: "fetch_contact_info.php",
    type:"POST",
    data:{doctors_id:doctors_id },
    success:function(data){

      $('#contact_info').html(data);



    }
  })
}
fetch_contact_info();
fetch_academic_info();
fetch_visiting_slot();


     $(document).on("click",".remove_academic_info_and_visiting_slot_info",function(){

              if(confirm("Do You Really Want To Remove This ? ")){

             var slot_id =$(this).attr("id");
             var action =$(this).attr("name");
             var sereal_date=$(this).attr("name");

             $.ajax({
               url: "remove_handaler.php",
               type:"POST",
               data:{slot_id:slot_id,action:action},
               success:function(data){

                 if(data=="visiting_slot"){
                   fetch_visiting_slot();
                 }else if (data=="academic_info") {
                    fetch_academic_info();
                 }else if (data=="Contact_no") {
                    fetch_contact_info();
                 }
                 else {

                 }


               }
             })

}else {

  return false;
}
             });


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








             $(document).on("click",".add_academic_info",function(){
             $('#dataModal').modal('show');
           });


              $(document).on("click",".add_contact_info",function(){
                $('#contactdatamodal').modal('show');
              });


           $(document).on("click",".add_academic_info_button",function(){


            var  program=$('#select_edu_program').val();
              var institute=$('#edu_ins').val();
              var pass_year=$('#edu_passing_year').val();
                $('#dataModal').modal('hide');

                     $.ajax({
                       url: "insert_academic_info.php",
                       type:"POST",
                       data:{program:program,institute:institute,pass_year:pass_year },
                       success:function(data){
                         fetch_academic_info();


                       }
                     })


               });


/********************Add Contact Info*********************/



$(document).on("click",".add_contact_info_button",function(){

   var contact_no=$('#contact_info_field').val();
   if( $('#contact_info_field').val().length != 0){


     $('#dataModal').modal('hide');

          $.ajax({
            url: "insert_contact_info.php",
            type:"POST",
            data:{contact_no:contact_no},
            success:function(data){

              fetch_contact_info();

            }
          })



   }
});

    /******************************************************/




   });



 </script>
