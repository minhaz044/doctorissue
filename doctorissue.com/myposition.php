
<?php
include("session.php");
?>
<html>
<head>
  <link rel="stylesheet" href="css\bootstrap.min.css">
  <link rel="stylesheet" href="css/res.css">
  <script src="jquery_latest.js" ></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

<style>
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    align: center;
}
</style>
</head>
<body>


<div class="container-p ">
  <h2>My Appointment</h2>
    <div class="row">
      <div class="col-75">

<?php
include("DBcon.php");
$optin_query=" SELECT * from serialinfo where did='$login_session' AND status='0'";
$optin_result=mysqli_query($con,$optin_query) or die(mysqli_error($con));
?>

        <select name="select_slot_name" id="select_slot_name">
        <option value="">Select a slot to view patient </option>

<?php
      if(mysqli_num_rows($optin_result)>=0){
      			while($optin_row = mysqli_fetch_assoc($optin_result)) {
              $day=date('l',strtotime($optin_row['s_date']));
      ?>
          <option value="<?php echo $optin_row['sid']."|".$day;?>"> <?php echo $day." (".$optin_row['s_from']."--".$optin_row['s_to'].")"; ?></option>

      <?php
      	  $day="";}
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
<div class="col-75" id="result">

</div>
</body>
</html>
<script >


  $(document).ready(function(){

    $("#search_btn").click(function(){
         fetchpatient();
    });


  function fetchpatient(){
    var select_slot_name =$("#select_slot_name").val();

    $.ajax({
    	url: "patient_result.php",
      type:"POST",
    	data:{"select_slot_name":select_slot_name},
      success:function(data){
        $('#result').html(data);
      }
    })

  }


  $(document).on("click",".is_visited_btn",function(){

          var select_btn_val =$(this).attr("id");
          $.ajax({
            url: "checked_result.php",
            type:"POST",
            data:{"select_btn_val":select_btn_val},
            success:function(data){

            }
          })
          fetchpatient();
          });
  });



</script>
