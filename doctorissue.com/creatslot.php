<!DOCTYPE html>
<?php
include("session.php");
include("DBcon.php");
include("sidenav.php");

    if(isset($_POST['s_submition_butun']) && $_POST["token"]==$_SESSION["token"] )
    {
      $did=$login_session;
      $slot_type=mysqli_real_escape_string($con,$_POST["s_type"]);
      $s_date=mysqli_real_escape_string($con,$_POST["s_date"]);
      $s_s_time=mysqli_real_escape_string($con,$_POST["s_s_time"]);
      $s_e_time=mysqli_real_escape_string($con,$_POST["s_e_time"]);
      $address=mysqli_real_escape_string($con,$_POST["Detail_address"]);
      $district_code=mysqli_real_escape_string($con,$_POST["district"]);
      $hospital=mysqli_real_escape_string($con,$_POST["hospital"]);
      $fees=mysqli_real_escape_string($con,$_POST["fees"]);
      $fees_old=mysqli_real_escape_string($con,$_POST["fees_old"]);
      $status="1";

      $query="INSERT INTO serialinfo( did, district_id, hospital_id, slot_type, s_date, s_from, s_to, fees, fees_old,address ,status) values ('$did','$district_code','$hospital','$slot_type','$s_date','$s_s_time','$s_e_time','$fees','$fees_old','$address','$status')";
      $execute=mysqli_query($con,$query);
      if($execute){
        ?>
        <script type="text/javascript">
            alert("A Visiting Slot is Created Sucessfuly.\n It is appear on your My cember Options And Your Profile ");window.location.href='doctorsrole.php';
          </script>
    <?php
      }
      else {
        echo " Data insertion failed! </br> Try Again!";}
             $_SESSION["token"] = rand(10000,99999);
      }
    else
    {

?>

<html>
<head>

  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="css/js/bootstrap.min.js" ></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
* {
    box-sizing: border-box;
}

input[type=text], select, textarea,date {
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

input[type=submit]:hover {
    background-color: #45a049;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
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




<div class="container">
  <h2>Available time for Patient</h2></br>
  <form action="" method="POST">

    <div class="row">
      <div class="col-25">
        <label for="slot_type">Type of Slot*</label>
      </div>
      <div class="col-75">
        <select name="s_type" required>
          <option value=""> Select Slote Type </option>
          <option value="0">One time(Never Repeat)</option>
          <option value="1">Weekly(This will active again in next week)</option>
        </select>
      </div>
    </div></br>
    <div class="row">
      <div class="col-25">
        <label for="date">Date/Day*</label>
      </div>
      <div class="col-75">
      <input type="date" name="s_date" required>
      </div>
    </div></br>
    <div class="row">
      <div class="col-25">
        <label for="time">Time(from-to) *</label>
      </div>
      <div class="col-75">
        <input id="s_s_time" name="s_s_time"type="time" required>  &nbsp;---&nbsp;
        <input id="s_e_time" name="s_e_time" type="time" required>
      </div>
</div></br>

      <div class="row">
        <div class="col-25">
          <label for="district">Location(District)*</label>
        </div>
        <div class="col-75">
              <select name="district" id="district" class=" district" required>
              <option value="">Select District</option>
              <?php echo fetch_district(); ?>
             </select>
        </div>
      </div></br>



      <div class="row">
        <div class="col-25">
          <label for="hospital">Hospital*</label>
        </div>
        <div class="col-75">
          <select name="hospital" id="hospital" class="form-control hospital" required>
           <option value="">Select Option</option>
          </select>
        </div>
      </div></br>




      <div class="row">
        <div class="col-25">
          <label for="Fees">Fees(Old Patient)*:</label>
        </div>
        <div class="col-75">
          <input id="fees" name="fees"type="Number"min="0"  required>
        </div>
      </div></br>


      <div class="row">
        <div class="col-25">
          <label for="Fees">Fees(New Patient)*:</label>
        </div>
        <div class="col-75">
          <input id="fees_old" name="fees_old"type="Number" min="0"equired>
        </div>
      </div></br>

      <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
       echo  $_SESSION["token"] ;?>">
      <div class="row">
        <div class="col-25">
          <label for="address">Detail Address*</label>
        </div>
        <div class="col-75">
          <textarea id="Detail_address" name="Detail_address"
placeholder="X Medical College
Road Number ,House Number
Room number 403
Dhaka,Bangladesh" style="height:200px" required></textarea>
        </div>
      </div></br>
      <div class="row">
        <input type="submit" value="Submit" name="s_submition_butun">
      </div></br>

</body>
</html>
<?php
}
?>






<script>



$(document).ready(function(){




 $('.district').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var choice = 1;
   var district_code = $('#district').val();
   var result = '';

   $.ajax({
    url:"fetch_option.php",
    method:"POST",
    data:{action:action, choice:choice, district_code:district_code},
    success:function(data){
      data+='<option value="0">Other</option>';
     $('#hospital').html(data);

    }
   })
  }
 });
});
</script>
