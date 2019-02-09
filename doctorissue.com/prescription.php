<!DOCTYPE html>
<?php
include("session.php");



    if(isset($_POST['Prescription_submition_btn'])&& $_POST["token"]==$_SESSION["token"])
    {
      include("DBcon.php");
      $user_id=mysqli_real_escape_string($con,$_GET["id"]);
      date_default_timezone_set('Asia/Dhaka');
      $date=date('Y-m-d H:i:s');
      $did=$login_session;
      $Problems=mysqli_real_escape_string($con,$_POST["p_Problems"]);
      $medicine=mysqli_real_escape_string($con,$_POST["p_medicine"]);
      $medicaltest=mysqli_real_escape_string($con,$_POST["p_medicaltest"]);
      $primary_test=mysqli_real_escape_string($con,$_POST['primary_test']);
      $comment=mysqli_real_escape_string($con,$_POST["p_comment"]);
      $serial_info_id=mysqli_real_escape_string($con,$_GET["sid"]);



$query="INSERT INTO prescription(serial_info_id, user_id, doctors_id, submisson_date, problems, medicine, primary_test, test, comment, access)
VALUES ('$serial_info_id','$user_id','$did','$date','$Problems','$medicine','$primary_test','$medicaltest','$comment',1)";

      $execute=mysqli_query($con,$query);

      if($execute){
        ?>
        <script type="text/javascript">
            alert("Prescription Submited Sucessfuly.\nGo Back to Patient Profile ");window.location.href='viewpatientprofile.php?id=<?php echo"$user_id";?>&sid=<?php echo$serial_info_id?>';
          </script>
    <?php
      }
      else {
        echo $execute." Data insertion failed! </br> Try Again!";
      }
           $_SESSION["token"] = rand(10000,99999);
      }

    else
    {

?>

<html>
<head>
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

<h2>Prescription</h2>


<div class="container">
  <form action="" method="POST">

    <div class="row">
      <div class="col-25">
        <label for="slot_type">Problems*:</label>
      </div>
      <div class="col-75">
        <textarea id="p_Problems" name="p_Problems" placeholder="1.Problems-1
2.problem-2
3.problem-3" style="height:150px" ></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="Rx">Rx*</label>
      </div>
      <div class="col-75">
    <textarea id="p_medicine" name="p_medicine"placeholder="1.Rx-1
2.Rx-2
3.Rx-3"style="height:150px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="primary_test">Primary Test(O/E):</label>
      </div>
      <div class="col-75">
        <textarea id="primary_test" name="primary_test"placeholder="B.P:12
C.P:25
D.P:35

"style="height:150px"></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="time">Investigation Test:</label>
      </div>
      <div class="col-75">
          <textarea id="p_medicaltest" name="p_medicaltest"placeholder="1.X-Ray
2.ECG
3.Rx-3"style="height:150px"></textarea>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="Sugesition">Sugesition:</label>
        </div>
        <div class="col-75">
          <textarea id="p_comment" name="p_comment"placeholder="1.Sugesition-1
2.Sugesition-2
3.Sugesition-3"style="height:150px"></textarea>
        </div>
      </div>
      <input type="hidden" name="token" value="<?php $_SESSION["token"] = rand(10000,99999);
       echo  $_SESSION["token"] ;?>">
      <div class="row">
  <input type="submit" name="Prescription_submition_btn" value="SUBMIT">
      </div>
</form>
</body>
</html>
<?php
}
?>
