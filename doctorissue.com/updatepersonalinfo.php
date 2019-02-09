<?php

include("session.php");
include("DBcon.php");
include("sidenav.php");
//if($role_check=="basic"){
$query="select * from users where accountno='$login_session'";
$result=mysqli_query($con,$query) or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

 ?>



<html>

<head>
  <title>Edit Your Personal Info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>

  <style>
  * {
      box-sizing: border-box;
  }

  input[type=text],  input[type=password], select, textarea,date {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      resize: vertical;
  }

  input[type=date] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      resize: vertical;
  }
  input[type=time] {
      width: 47%;
      padding: 12px;
      border: 1p solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      resize: vertical;
  }
  label {
      padding: 12px 12px 12px 0;
      display: inline-block;
  }

  input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
  }
  input[type=button] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
  }
  input[type=submit]:hover {
      background-color: #45a049;
  }

  .container-p {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      align:center;
  }

  .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
  }

  .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
  }

  /* Clear floats after the columns */
  .row:after {
      content: "";
      display: table;
      clear: both;
  }

  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
  @media (max-width: 600px) {
      .col-25, .col-75, input[type=submit] {
          width: 100%;
          margin-top: 0;
      }
      input[type=time] {
          width: 43%;

      }
  }
  </style>
</head>
<body>
 <Div class="container">
   <Div class="container-p">
     <!---------------------Update Profile Information------------------->
<!--
     <h1>UpDate Your Personal Information:</h1>

--->

             <div class="row">
               <div class="col-25">
                 <label for="fname">Name:*</label>
               </div>
               <div class="col-25">
                   <input type="text" id="ud_fname" name="fname"  value ="<?php echo $row['fname']; ?>"placeholder="First name" required>
                   <input type="text" id="ud_lname" name="lname" value ="<?php echo $row['lname']; ?>" placeholder="Last name"></br>
               </div>
             </div>



             <div class="row">
               <div class="col-25">
                 <label for="gender">Gender:*</label>
               </div>
               <div class="col-25">
                 <select id="ud_gender" name="gender"required>
                   <?php
                   if($row['gender']==1){?>
                      <option value="1" Selected>Male</option>
                      <option value="2">Female</option>
                      <option value="3">Other</option>
                   <?php }elseif($row['gender']==2){?>
                     <option value="1" >Male</option>
                     <option value="2" Selected>Female</option>
                     <option value="3">Other</option>
                   <?php }else{?>
                     <option value="1" >Male</option>
                     <option value="2">Female</option>
                     <option value="3"Selected>Other</option>
                  <?php }
                   ?>



               	</select></br>
               </div>
             </div>




             <div class="row">
               <div class="col-25">
                 <label for="Date of birth"> Date Of Birth*:</label>
               </div>
               <div class="col-25">
                 <input type="date" id="ud_bdate"name="bdate"value ="<?php echo $row["dob"]; ?>" required ></br>
               </div>
             </div>





             <div class="row">
               <div class="col-25">
                 <label for="blood group">Current Location:*</label>
               </div>
               <div class="col-25">

                              <select name="current_location" id="current_location" class="form-control Responsive dts" required>
                                  <option value="">Select District</option>
                                  <?php echo fetch_district_with_parameter($row["current_location"]); ?>
                                 </select></br>


               </div>
             </div>















             <div class="row">
               <div class="col-25">
                 <label for="blood group">Blood Group:*</label>
               </div>
               <div class="col-25">
                 <select id="ud_blood_group" name="ud_blood_group"required>
                   <option value="A+"  <?php if($row['blood_group']=="A+"){echo ' selected="selected"';}?> >A+</option>
                   <option value="A-"  <?php if($row['blood_group']=="A-"){echo ' selected="selected"';}?>>A-</option>
                   <option value="B+"  <?php if($row['blood_group']=="B+"){echo ' selected="selected"';}?> >B+</option>
                   <option value="B-"  <?php if($row['blood_group']=="B-"){echo ' selected="selected"';}?> >B-</option>
                   <option value="AB+"  <?php if($row['blood_group']=="AB+"){echo ' selected="selected"';}?> >AB+</option>
                   <option value="AB-" <?php if($row['blood_group']=="AB-"){echo ' selected="selected"';}?>>AB-</option>
                   <option value="O+"  <?php if($row['blood_group']=="O-"){echo ' selected="selected"';}?>>O+</option>
                   <option value="O-"  <?php if($row['blood_group']=="O-"){echo ' selected="selected"';}?>>O-</option>

               	</select></br>
               </div>
             </div>


             <div class="row">
               <div class="col-25">
                 <label for="Last date of blood donation">Last Date Of Blood Donation*:</label>
               </div>
               <div class="col-25">
                 <input type="date" id="ud_b_donation_date"name="bdate"value ="<?php echo $row["last_donation_date"]; ?>" required ></br>
               </div>
             </div>

<?php
if($login_role=="doctor"){
$query1="select * from doctors_basic_info where did='$login_session'";
$result1=mysqli_query($con,$query1) or die(mysqli_error($con));
$row1 = mysqli_fetch_assoc($result1);

?>

             <div class="row">
               <div class="col-25">
                 <label for="speciality">speciality:*</label>
               </div>
               <div class="col-25">
                 <select id="ud_speciality" value=""name="ud_speciality" required>
                     <option value="">Select Speciality</option>
                 <?php echo fetch_specialist_with_parameter($row1["speciality"]) ;?>
               	</select></br>

               </div>
             </div>






  <div class="row">
    <div class="col-25">
      <label for="designation">Designation:</label>
    </div>
    <div class="col-25">
        <input type="text" value="<?php echo $row1["designation"]; ?>"id="ud_designation" name="ud_designation" required></br>
    </div>
  </div>



  <div class="row">
    <div class="col-25">
      <label for="institution">Institution:</label>
    </div>
    <div class="col-25">
         <input type="text"  value="<?php echo $row1["institution"]; ?>" id="ud_institution" name="ud_institution" required></br>
    </div>
  </div>



  <?php
}
?>
                     <div class="row">
                         <div class="col-25">
                             <label for=""></label>
                             </div>
                            <div class="col-25">
                            <input class="btn btn-sucess update_info_btn"type="button" value="Update" id="ud_info_btn" name="update_info">
                        </div>
                     </div>




                     <div class="row">
                       <div class="col-25">
                         <label for="fname">Current Password*:</label>
                       </div>
                       <div class="col-25">
                           <input type="password" id="ud_opassword" name="opassword" required ></br>
                       </div>
                     </div>



                     <div class="row">
                       <div class="col-25">
                         <label for="fname">New Password*:</label>
                       </div>
                       <div class="col-25">
                            <input type="password" id="ud_npassword" name="npassword" required></br>
                       </div>
                     </div>


                      <div class="row">
                        <div class="col-25">
                          <label for="confarm-password">Confirm Password*:</label>
                              </div>
                                <div class="col-25">
                                  <input type="password" id="ud_copassword" name="copassword" required></br><span class="" id="divCheckPasswordMatch" style="color:red;"></span>
                                </div>
                          </div>



                                    <div class="row">
                                      <div class="col-25">
                                        <label for=""></label>
                                      </div>
                                      <div class="col-25">
                                        <input class=" btn btn-sucess ud_pass_btn"type="button" value="Change Password" id="ud_pass_btn" name="update_pass">
                                      </div>
                                    </div>


   </div>
</div>
</body>
</html>


<script >


function checkPasswordMatch() {
 var password = $("#ud_npassword").val();
   var confirmPassword = $("#ud_copassword").val();
  if (password != confirmPassword){
      $("#divCheckPasswordMatch").text("Password Do Not Match");
  }else{
  $("#divCheckPasswordMatch").text("");
  }
}





  $(document).ready(function(){


 $("#ud_copassword").keyup(checkPasswordMatch);


    $(document).on("click",".update_info_btn",function(){
			var role="<?php echo $login_role;?>";
            var fname =$('#ud_fname').val();
            var lname =$('#ud_lname').val();
            var gender=$('#ud_gender').val();
            var dob=$('#ud_bdate').val();
            var blood_group =$('#ud_blood_group').val();
            var blood_donation_date =$('#ud_b_donation_date').val();

            var current_location=$('#current_location').val();
            var opassword=$('#ud_opassword').val();
            var npassword =$('#ud_npassword').val();
            var copassword=$('#ud_copassword').val();
            var ud_button=$('#ud_info_btn').attr('Name');
			if(role=="doctor"){
			var ud_speciality=$('#ud_speciality').val();
            var ud_designation =$('#ud_designation').val();
            var ud_institution=$('#ud_institution').val();
			$.ajax({
              url: "update_info_result.php",
              type:"POST",
              data:{fname:fname,lname:lname,gender:gender,dob:dob,blood_group:blood_group,current_location:current_location,
              blood_donation_date:blood_donation_date,ud_speciality:ud_speciality,ud_designation:ud_designation,ud_institution:ud_institution,ud_button:ud_button},
              success:function(data){
				alert(data);
              }
            })
			}
			else if(role=="basic"){

            $.ajax({
              url: "update_info_result.php",
              type:"POST",
              data:{fname:fname,lname:lname,gender:gender,dob:dob,current_location:current_location,blood_group:blood_group,
              blood_donation_date:blood_donation_date,ud_button:ud_button},
              success:function(data){
				alert(data);
              }
            })


			}else{}
            });






		    $(document).on("click",".ud_pass_btn",function(){

            var opassword=$('#ud_opassword').val();
            var npassword =$('#ud_npassword').val();
            var copassword=$('#ud_copassword').val();
            var ud_button=$('#ud_pass_btn').attr('Name');
			if(opassword=="" | npassword=="" | copassword==""){
				alert("Empty Field");
			}else{

			if(npassword==copassword){

            $.ajax({
              url: "update_info_result.php",
              type:"POST",
              data:{opassword:opassword,npassword:npassword,ud_button:ud_button},
              success:function(data){
				  alert(data);
            $('#ud_opassword').val("");
            $('#ud_npassword').val("");
            $('#ud_copassword').val("");
              }
            })
			}
			else{
				alert("Password does not match");
			}
			}
            });






  });








</script>
