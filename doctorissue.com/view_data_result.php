<?php
include("DBcon.php");
include("session.php");
if(isset($_POST["prescription_id"])){
$prescription_id=(int)mysqli_real_escape_string($con,$_POST["prescription_id"]);



$query1="SELECT * FROM prescription WHERE prescription_id ='$prescription_id'";
$execute1=mysqli_query($con,$query1) or die(mysqli_error($con));
$row1 = mysqli_fetch_assoc($execute1);


$output="<h4><strong>PROBLEMS:</strong></h4>".nl2br($row1['problems'])."<h4><strong>Rx:</strong></h4>".nl2br($row1['medicine'])."<h4><strong>Primary Test:</strong></h4>".nl2br($row1['primary_test'])."<h4><strong>Investigation TEST:</strong></h4>".nl2br($row1['test'])."<h4><strong>Sugesition:</strong></h4>".nl2br($row1['comment']);
echo $output;
}
