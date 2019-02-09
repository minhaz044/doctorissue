<?php
include("session.php");
include("sidenav.php");
?>
<html>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery.js" ></script>
    <script src="jquery.min.js" ></script>
  <script src="css/js/bootstrap.min.js" ></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: center;
}

</style>
</head>
<body>


<div class="container-p">
  <div>
  <h2>My Appointment</h2>
  </div>
    <div class="row">
      <div class="col-75">

<?php
include("DBcon.php");
$todays_date=date('Y-m-d');












if(isset($_GET['id'])){
    $user_id=(int)mysqli_real_escape_string($con,$_GET["id"]);
    if(family_status($login_session,$user_id)==1){
    $user_id=(int)mysqli_real_escape_string($con,$_GET["id"]);
  }
  else {
    $user_id=$login_session;
  }
}else {
$user_id=$login_session;
}












$optin_query=" SELECT * from serialno where patientid='$user_id' AND sereal_date>= '$todays_date' order by sereal_date";
$optin_result=mysqli_query($con,$optin_query) or die(mysqli_error($con));
$final_string="No Appointment Found";
?>
<div class="form-group">
        <select class="form-control" name="select_slot_name" id="select_slot_name">
        <option value="">select A Schedule to view position</option>
<?php
      if(mysqli_num_rows($optin_result)>=0){
      			while($optin_row = mysqli_fetch_assoc($optin_result)) {
              $query2=" SELECT did,s_from,s_to from serialinfo where sid='$optin_row[sid]'";
              $result2=mysqli_query($con,$query2) or die(mysqli_error($con));
              $row2 = mysqli_fetch_assoc($result2);
              $query3="SELECT fname,lname  from users where accountno='$row2[did]'";
              $result3=mysqli_query($con,$query3) or die(mysqli_error($con));
              $row3 = mysqli_fetch_assoc($result3);
              $final_string="";
              $final_string=$row3[fname]."        ".$row3[lname]."     ".$optin_row[sereal_date]." "."(".$row2[s_from]."--".$row2[s_to].")";
      ?>

          <option value="<?php echo $optin_row['sid']."|".$optin_row['sereal_date'];?>"> <?php echo "$final_string"; ?></option>
      <?php
      	}
}
else {
?>
      <option value=""> No Element to Show</option>
<?php
}
 ?>
</select></br>

      </div>
        <div class="col-25">
                      <button type="button" name="search_btn" id="search_btn">SEARCH</button>


</div>
      </div>
    </div>

</div>
<div class="col-75" id="result">

</div>
</body>
</html>
<script >


  $(document).ready(function(){

    $("#search_btn").click(function(){
         fetchuser();

    });
  function fetchuser(){
    var select_slot_name =$("#select_slot_name").val();
    var patient_id =<?php echo "$user_id"; ?>;
    $.ajax({
    	url: "serial_result.php",
      type:"POST",
    	data:{"select_slot_name":select_slot_name,patient_id:patient_id},
      success:function(data){
        $('#result').html(data);
      }
    })

  }
  });
</script>
